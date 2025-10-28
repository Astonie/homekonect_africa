<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $property->title }} - HomeKonnect</title>
    <meta name="description" content="{{ Str::limit($property->description, 160) }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xl">H</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">HomeKonnect</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900 font-medium transition">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Home
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Sign in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">Home</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('properties.index') }}" class="text-gray-500 hover:text-gray-700">Properties</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-gray-900 font-medium">{{ Str::limit($property->title, 50) }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden" x-data="{ selectedImage: 0 }">
                        @if($property->images && count($property->images) > 0)
                            <!-- Main Image -->
                            <div class="relative h-96 bg-gray-900">
                                @foreach($property->images as $index => $image)
                                    @php
                                        if (filter_var($image, FILTER_VALIDATE_URL)) {
                                            $imageUrl = $image;
                                        } elseif (Str::startsWith($image, 'http')) {
                                            $imageUrl = $image;
                                        } elseif (Str::startsWith($image, 'uploads/')) {
                                            $imageUrl = asset($image);
                                        } else {
                                            $imageUrl = Storage::url($image);
                                        }
                                    @endphp
                                    <img x-show="selectedImage === {{ $index }}" 
                                         src="{{ $imageUrl }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover"
                                         onerror="this.src='https://via.placeholder.com/800x600?text=Image+Not+Available'">
                                @endforeach
                                
                                <!-- Image Counter -->
                                <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    <span x-text="selectedImage + 1"></span> / {{ count($property->images) }}
                                </div>

                                <!-- Navigation Arrows -->
                                @if(count($property->images) > 1)
                                    <button @click="selectedImage = selectedImage > 0 ? selectedImage - 1 : {{ count($property->images) - 1 }}" 
                                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition">
                                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button @click="selectedImage = selectedImage < {{ count($property->images) - 1 }} ? selectedImage + 1 : 0" 
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition">
                                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            <!-- Thumbnail Gallery -->
                            @if(count($property->images) > 1)
                                <div class="p-4 bg-gray-50">
                                    <div class="grid grid-cols-5 gap-3">
                                        @foreach($property->images as $index => $image)
                                            @php
                                                if (filter_var($image, FILTER_VALIDATE_URL)) {
                                                    $thumbUrl = $image;
                                                } elseif (Str::startsWith($image, 'http')) {
                                                    $thumbUrl = $image;
                                                } elseif (Str::startsWith($image, 'uploads/')) {
                                                    $thumbUrl = asset($image);
                                                } else {
                                                    $thumbUrl = Storage::url($image);
                                                }
                                            @endphp
                                            <button @click="selectedImage = {{ $index }}" 
                                                    :class="selectedImage === {{ $index }} ? 'ring-4 ring-blue-500' : 'ring-2 ring-gray-200'"
                                                    class="relative h-20 rounded-lg overflow-hidden hover:ring-4 hover:ring-blue-400 transition">
                                                <img src="{{ $thumbUrl }}" 
                                                     alt="Thumbnail {{ $index + 1 }}" 
                                                     class="w-full h-full object-cover"
                                                     onerror="this.src='https://via.placeholder.com/150?text={{ $index + 1 }}'">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="h-96 bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500">No images available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="inline-flex px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                        {{ ucfirst($property->type) }}
                                    </span>
                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                        For {{ ucfirst($property->listing_type) }}
                                    </span>
                                    @if($property->is_featured)
                                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">
                                            ⭐ Featured
                                        </span>
                                    @endif
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
                                <p class="text-lg text-gray-600 mt-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-blue-600">{{ $property->formatted_price }}</div>
                                @if($property->listing_type === 'rent')
                                    <p class="text-sm text-gray-500">per month</p>
                                @endif
                            </div>
                        </div>

                        <!-- Key Features -->
                        <div class="grid grid-cols-4 gap-4 py-6 border-y border-gray-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $property->bedrooms }}</div>
                                <div class="text-sm text-gray-600 mt-1">Bedrooms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $property->bathrooms }}</div>
                                <div class="text-sm text-gray-600 mt-1">Bathrooms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($property->square_feet) }}</div>
                                <div class="text-sm text-gray-600 mt-1">Sq Ft</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $property->year_built ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-600 mt-1">Year Built</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-3">Description</h2>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $property->description }}</p>
                        </div>

                        <!-- Amenities -->
                        @if($property->amenities && count($property->amenities) > 0)
                            <div class="mt-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-3">Amenities</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($property->amenities as $amenity)
                                        <div class="flex items-center space-x-2 text-gray-700">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $amenity }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Additional Details -->
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            @if($property->floors)
                                <div>
                                    <span class="text-sm text-gray-600">Number of Floors:</span>
                                    <span class="ml-2 font-semibold text-gray-900">{{ $property->floors }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-sm text-gray-600">Furnished:</span>
                                <span class="ml-2 font-semibold text-gray-900">{{ $property->furnished ? 'Yes' : 'No' }}</span>
                            </div>
                            @if($property->security_deposit)
                                <div>
                                    <span class="text-sm text-gray-600">Security Deposit:</span>
                                    <span class="ml-2 font-semibold text-gray-900">${{ number_format($property->security_deposit, 2) }}</span>
                                </div>
                            @endif
                            @if($property->available_from)
                                <div>
                                    <span class="text-sm text-gray-600">Available From:</span>
                                    <span class="ml-2 font-semibold text-gray-900">{{ $property->available_from->format('M d, Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Contact Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Contact Property Owner</h3>
                        
                        <div class="flex items-center space-x-4 mb-6 pb-6 border-b">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                {{ strtoupper(substr($property->owner->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $property->owner->name }}</div>
                                <div class="text-sm text-gray-600">{{ ucfirst($property->owner->role) }}</div>
                            </div>
                        </div>

                        @auth
                            <button class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold mb-3">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Message
                            </button>
                            <button class="w-full bg-white border-2 border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50 transition font-semibold">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Call Now
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-center mb-3">
                                Login to Contact
                            </a>
                            <p class="text-sm text-gray-600 text-center">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Sign up</a>
                            </p>
                        @endauth
                    </div>

                    <!-- Property Stats -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Property Statistics</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Views</span>
                                <span class="font-semibold text-gray-900">{{ number_format($property->views) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Listed</span>
                                <span class="font-semibold text-gray-900">{{ $property->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Status</span>
                                <span class="inline-flex px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Similar Properties -->
            @if($similarProperties->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Similar Properties</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($similarProperties as $similar)
                            <a href="{{ route('properties.show', $similar->slug) }}" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                                <div class="relative h-48">
                                    @php
                                        $firstImage = $similar->images[0] ?? null;
                                        if ($firstImage) {
                                            if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
                                                $imageUrl = $firstImage;
                                            } elseif (Str::startsWith($firstImage, 'http')) {
                                                $imageUrl = $firstImage;
                                            } elseif (Str::startsWith($firstImage, 'uploads/')) {
                                                $imageUrl = asset($firstImage);
                                            } else {
                                                $imageUrl = Storage::url($firstImage);
                                            }
                                        } else {
                                            $imageUrl = 'https://via.placeholder.com/400x300?text=No+Image';
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $similar->title }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                                    <span class="absolute top-3 right-3 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $similar->formatted_price }}
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-2">{{ Str::limit($similar->title, 40) }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ $similar->city }}, {{ $similar->state }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-600">
                                        <span>🛏️ {{ $similar->bedrooms }} Beds</span>
                                        <span>🚿 {{ $similar->bathrooms }} Baths</span>
                                        <span>📏 {{ number_format($similar->square_feet) }} sqft</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2025 HomeKonnect. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
