<div id="property-gallery-{{ $propertyId }}" class="property-gallery-container relative">
    <!-- Main Gallery -->
    <div class="gallery-main swiper">
        <div class="swiper-wrapper">
            @foreach($media as $item)
                @if($item->media_type === 'photo' || $item->media_type === 'drone')
                    <div class="swiper-slide">
                        <a href="{{ Storage::url($item->file_path) }}" 
                           class="glightbox" 
                           data-gallery="property-{{ $propertyId }}"
                           data-title="{{ $item->media_type === 'drone' ? 'Drone View' : '' }}">
                            <img src="{{ Storage::url($item->file_path) }}" 
                                 alt="{{ $property->title }}"
                                 class="w-full h-96 object-cover rounded-lg">
                            @if($item->media_type === 'drone')
                                <span class="absolute top-2 left-2 bg-blue-600 text-white px-2 py-1 rounded text-xs">
                                    <i class="fas fa-drone"></i> Drone View
                                </span>
                            @endif
                        </a>
                    </div>
                @elseif($item->media_type === 'video')
                    <div class="swiper-slide">
                        <a href="{{ Storage::url($item->file_path) }}" 
                           class="glightbox" 
                           data-gallery="property-{{ $propertyId }}">
                            <video class="w-full h-96 object-cover rounded-lg" poster="{{ $item->thumbnail ?? '' }}">
                                <source src="{{ Storage::url($item->file_path) }}" type="video/mp4">
                            </video>
                            <span class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-play-circle text-white text-6xl opacity-80"></i>
                            </span>
                        </a>
                    </div>
                @endif
            @endforeach

            @if($property->virtual_tour_url)
                <div class="swiper-slide">
                    <div class="w-full h-96 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center cursor-pointer"
                         onclick="openVirtualTour('{{ $property->virtual_tour_url }}')">
                        <div class="text-center text-white">
                            <i class="fas fa-vr-cardboard text-6xl mb-4"></i>
                            <h3 class="text-2xl font-bold">360° Virtual Tour</h3>
                            <p class="mt-2">Click to explore</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Thumbnails -->
    @if($showThumbnails ?? true)
        <div class="gallery-thumbs swiper mt-4">
            <div class="swiper-wrapper">
                @foreach($media as $item)
                    <div class="swiper-slide">
                        <img src="{{ Storage::url($item->file_path) }}" 
                             alt="Thumbnail"
                             class="w-full h-20 object-cover rounded cursor-pointer">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Map View Toggle -->
    @if($property->latitude && $property->longitude)
        <div class="mt-4">
            <button onclick="toggleMapView()" 
                    class="w-full bg-gray-100 hover:bg-gray-200 px-4 py-3 rounded-lg flex items-center justify-center">
                <i class="fas fa-map-marked-alt mr-2"></i>
                View on Map
            </button>
        </div>

        <div id="map-container-{{ $propertyId }}" class="hidden mt-4 rounded-lg overflow-hidden shadow-lg">
            <div id="property-map-{{ $propertyId }}" class="h-96"></div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function openVirtualTour(url) {
        window.open(url, '_blank', 'width=1200,height=800');
    }

    function toggleMapView() {
        const mapContainer = document.getElementById('map-container-{{ $propertyId }}');
        mapContainer.classList.toggle('hidden');
        
        if (!mapContainer.classList.contains('hidden') && !window.propertyMap{{ $propertyId }}) {
            window.propertyMap{{ $propertyId }} = new PropertyMap('property-map-{{ $propertyId }}', {
                latitude: {{ $property->latitude }},
                longitude: {{ $property->longitude }},
                apiKey: '{{ config('gis.google_maps.api_key') }}',
                title: '{{ $property->title }}',
                showStreetView: {{ $property->has_street_view ? 'true' : 'false' }}
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.propertyGallery{{ $propertyId }} = new PropertyGallery('property-gallery-{{ $propertyId }}', {
            propertyId: {{ $propertyId }},
            latitude: {{ $property->latitude ?? 'null' }},
            longitude: {{ $property->longitude ?? 'null' }},
            virtualTourUrl: '{{ $property->virtual_tour_url ?? '' }}',
            enableStreetView: {{ $property->has_street_view ? 'true' : 'false' }},
            enableVirtualTour: {{ $property->virtual_tour_url ? 'true' : 'false' }}
        });
    });
</script>
@endpush
