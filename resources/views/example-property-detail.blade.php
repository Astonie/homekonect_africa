{{-- Example: Property Detail Page with GIS Features --}}
@extends('layouts.app')

@section('title', $property->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Main Content - Left Column --}}
        <div class="lg:col-span-2">
            
            {{-- Property Gallery with GIS Features --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <x-property-gallery 
                    :property="$property" 
                    :media="$property->media()->orderBy('order')->get()"
                    :property-id="$property->id"
                    :show-thumbnails="true"
                />
            </div>

            {{-- Property Details --}}
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h1 class="text-3xl font-bold mb-2">{{ $property->title }}</h1>
                <p class="text-gray-600 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ $property->address }}, {{ $property->city }}, {{ $property->country }}
                </p>

                <div class="flex items-center space-x-4 mb-6">
                    @if($property->has_drone_imagery)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-drone mr-1"></i> Drone Views
                        </span>
                    @endif
                    
                    @if($property->has_street_view)
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-street-view mr-1"></i> Street View
                        </span>
                    @endif
                    
                    @if($property->virtual_tour_url)
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-vr-cardboard mr-1"></i> Virtual Tour
                        </span>
                    @endif
                </div>

                <div class="prose max-w-none">
                    <h2>Description</h2>
                    <p>{{ $property->description }}</p>
                </div>
            </div>

            {{-- Virtual Tour Section --}}
            @if($property->virtual_tour_url)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4">
                        <i class="fas fa-vr-cardboard mr-2"></i> 360° Virtual Tour
                    </h2>
                    <div id="virtual-tour-embed" class="rounded-lg overflow-hidden">
                        {{-- Virtual tour will be embedded here via JavaScript --}}
                    </div>
                </div>
            @endif

            {{-- Location Map --}}
            @if($property->latitude && $property->longitude)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4">
                        <i class="fas fa-map-marked-alt mr-2"></i> Location
                    </h2>
                    
                    {{-- Map Type Selector --}}
                    <div class="flex space-x-2 mb-4">
                        <button onclick="changeMapType('roadmap')" 
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                            Roadmap
                        </button>
                        <button onclick="changeMapType('satellite')" 
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                            Satellite
                        </button>
                        <button onclick="changeMapType('hybrid')" 
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                            Hybrid
                        </button>
                        @if($property->has_street_view)
                            <button onclick="toggleStreetView()" 
                                    class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded">
                                <i class="fas fa-street-view mr-1"></i> Street View
                            </button>
                        @endif
                    </div>

                    <div id="property-location-map" class="h-96 rounded-lg overflow-hidden"></div>
                </div>
            @endif

        </div>

        {{-- Sidebar - Right Column --}}
        <div class="lg:col-span-1">
            
            {{-- Price & Action Card --}}
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4 mb-6">
                <div class="text-3xl font-bold text-blue-600 mb-4">
                    {{ $property->formattedPrice }}
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-bed w-6"></i>
                        <span>{{ $property->bedrooms }} Bedrooms</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-bath w-6"></i>
                        <span>{{ $property->bathrooms }} Bathrooms</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-ruler-combined w-6"></i>
                        <span>{{ number_format($property->square_feet) }} sq ft</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-envelope mr-2"></i> Contact Agent
                    </button>
                    
                    @if($property->virtual_tour_url)
                        <button onclick="openVirtualTour('{{ $property->virtual_tour_url }}')" 
                                class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">
                            <i class="fas fa-vr-cardboard mr-2"></i> Take Virtual Tour
                        </button>
                    @endif
                    
                    <button class="w-full bg-gray-200 text-gray-800 py-3 rounded-lg hover:bg-gray-300">
                        <i class="fas fa-heart mr-2"></i> Save Property
                    </button>
                </div>
            </div>

            {{-- Agent Card --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Listed By</h3>
                <div class="flex items-center mb-4">
                    <img src="{{ $property->owner->avatar ?? '/default-avatar.png' }}" 
                         alt="{{ $property->owner->name }}"
                         class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <div class="font-bold">{{ $property->owner->name }}</div>
                        <div class="text-gray-600 text-sm">Real Estate Agent</div>
                    </div>
                </div>
                <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </button>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    let propertyMap = null;
    let virtualTourService = null;

    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize map if coordinates exist
        @if($property->latitude && $property->longitude)
            initializeMap();
        @endif

        // Initialize virtual tour if URL exists
        @if($property->virtual_tour_url)
            initializeVirtualTour();
        @endif

    });

    function initializeMap() {
        propertyMap = new PropertyMap('property-location-map', {
            latitude: {{ $property->latitude }},
            longitude: {{ $property->longitude }},
            apiKey: '{{ config('gis.google_maps.api_key') }}',
            zoom: {{ config('gis.google_maps.default_zoom', 15) }},
            mapType: '{{ config('gis.google_maps.map_type', 'roadmap') }}',
            showStreetView: {{ $property->has_street_view ? 'true' : 'false' }},
            title: '{{ addslashes($property->title) }}',
            infoContent: `
                <div class="p-2">
                    <h3 class="font-bold">{{ addslashes($property->title) }}</h3>
                    <p class="text-sm">{{ addslashes($property->address) }}</p>
                    <p class="text-blue-600 font-bold mt-2">{{ $property->formattedPrice }}</p>
                </div>
            `
        });
    }

    function initializeVirtualTour() {
        // You can implement custom virtual tour embedding here
        const tourContainer = document.getElementById('virtual-tour-embed');
        if (tourContainer) {
            // Fetch the embed code from VirtualTourService
            fetch('/api/virtual-tour-embed?url={{ urlencode($property->virtual_tour_url) }}')
                .then(response => response.json())
                .then(data => {
                    tourContainer.innerHTML = data.html;
                })
                .catch(error => {
                    console.error('Error loading virtual tour:', error);
                });
        }
    }

    function changeMapType(type) {
        if (propertyMap) {
            propertyMap.setMapType(type);
        }
    }

    function toggleStreetView() {
        if (propertyMap) {
            propertyMap.toggleStreetView();
        }
    }

    function openVirtualTour(url) {
        window.open(url, '_blank', 'width=1200,height=800');
    }
</script>
@endpush

@push('styles')
<style>
    /* Additional custom styles for GIS features */
    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 50%;
    }

    .swiper-pagination-bullet-active {
        background: #2563eb;
    }
</style>
@endpush
