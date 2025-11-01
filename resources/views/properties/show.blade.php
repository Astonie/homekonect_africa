@extends('layouts.home')

@section('title', $property->title . ' - HomeKonnect')
@section('meta_description', Str::limit($property->description, 160))

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="/" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Home</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('properties.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Properties</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-gray-900 dark:text-white font-medium">{{ Str::limit($property->title, 50) }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Image Gallery -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-colors duration-300" x-data="{ selectedImage: 0 }">
                        @if($property->images && count($property->images) > 0)
                            <!-- Main Image -->
                            <div class="relative h-96 bg-gray-900 dark:bg-gray-950">
                                @foreach($property->images as $index => $image)
                                    @php
                                        // Handle both old format (string) and new format (array with path)
                                        $imagePath = is_array($image) ? ($image['path'] ?? $image) : $image;
                                        
                                        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                            $imageUrl = $imagePath;
                                        } elseif (Str::startsWith($imagePath, 'http')) {
                                            $imageUrl = $imagePath;
                                        } elseif (Str::startsWith($imagePath, 'uploads/')) {
                                            $imageUrl = asset($imagePath);
                                        } elseif (Str::startsWith($imagePath, '/storage/')) {
                                            $imageUrl = $imagePath;
                                        } else {
                                            $imageUrl = Storage::url($imagePath);
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
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50">
                                    <div class="grid grid-cols-5 gap-3">
                                        @foreach($property->images as $index => $image)
                                            @php
                                                // Handle both old format (string) and new format (array with path)
                                                $imagePath = is_array($image) ? ($image['path'] ?? $image) : $image;
                                                $isFeatured = is_array($image) && isset($image['is_featured']) && $image['is_featured'];
                                                
                                                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                    $thumbUrl = $imagePath;
                                                } elseif (Str::startsWith($imagePath, 'http')) {
                                                    $thumbUrl = $imagePath;
                                                } elseif (Str::startsWith($imagePath, 'uploads/')) {
                                                    $thumbUrl = asset($imagePath);
                                                } elseif (Str::startsWith($imagePath, '/storage/')) {
                                                    $thumbUrl = $imagePath;
                                                } else {
                                                    $thumbUrl = Storage::url($imagePath);
                                                }
                                            @endphp
                                            <button @click="selectedImage = {{ $index }}" 
                                                    :class="selectedImage === {{ $index }} ? 'ring-4 ring-blue-500' : 'ring-2 ring-gray-200 dark:ring-gray-600'"
                                                    class="relative h-20 rounded-lg overflow-hidden hover:ring-4 hover:ring-blue-400 transition">
                                                @if($isFeatured)
                                                    <div class="absolute top-1 left-1 bg-blue-500 text-white px-1 py-0.5 rounded text-xs font-semibold z-10">
                                                        ★
                                                    </div>
                                                @endif
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
                            <div class="h-96 bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400">No images available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300 mb-4">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="inline-flex px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 text-sm font-semibold rounded-full">
                                        {{ ucfirst($property->type) }}
                                    </span>
                                    <span class="inline-flex px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-sm font-semibold rounded-full">
                                        For {{ ucfirst($property->listing_type) }}
                                    </span>
                                    @if($property->is_featured)
                                        <span class="inline-flex px-3 py-1 bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300 text-sm font-semibold rounded-full">
                                            ⭐ Featured
                                        </span>
                                    @endif
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $property->title }}</h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300 mt-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $property->formatted_price }}</div>
                                @if($property->listing_type === 'rent')
                                    <p class="text-sm text-gray-500 dark:text-gray-400">per month</p>
                                @endif
                            </div>
                        </div>

                        <!-- Key Features -->
                        <div class="grid grid-cols-4 gap-4 py-6 border-y border-gray-200 dark:border-gray-700">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $property->bedrooms }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Bedrooms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $property->bathrooms }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Bathrooms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($property->square_feet) }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Sq Ft</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $property->year_built ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Year Built</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Description</h2>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $property->description }}</p>
                        </div>

                        <!-- Amenities -->
                        @if($property->amenities && count($property->amenities) > 0)
                            <div class="mt-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Amenities</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($property->amenities as $amenity)
                                        <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                                            <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Number of Floors:</span>
                                    <span class="ml-2 font-semibold text-gray-900 dark:text-white">{{ $property->floors }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Furnished:</span>
                                <span class="ml-2 font-semibold text-gray-900 dark:text-white">{{ $property->furnished ? 'Yes' : 'No' }}</span>
                            </div>
                            @if($property->security_deposit)
                                <div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Security Deposit:</span>
                                    <span class="ml-2 font-semibold text-gray-900 dark:text-white">${{ number_format($property->security_deposit, 2) }}</span>
                                </div>
                            @endif
                            @if($property->available_from)
                                <div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Available From:</span>
                                    <span class="ml-2 font-semibold text-gray-900 dark:text-white">{{ $property->available_from->format('M d, Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Contact Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-24 transition-colors duration-300">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contact Property Owner</h3>
                        @if (session('success'))
                            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-800 dark:border-green-900/40 dark:bg-green-900/40 dark:text-green-300">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                {{ strtoupper(substr($property->owner->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">{{ $property->owner->name }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($property->owner->role) }}</div>
                            </div>
                        </div>

                        @auth
                            <form method="POST" action="{{ route('properties.inquiry', $property) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Name</label>
                                    <input name="name" value="{{ old('name', auth()->user()->name) }}" required class="mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone (optional)</label>
                                    <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                                    <textarea name="message" rows="4" required class="mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100" placeholder="I'm interested in {{ $property->title }}. Please contact me.">{{ old('message') }}</textarea>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition font-semibold">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Send Inquiry
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition font-semibold text-center mb-3">
                                Login to Contact
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold">Sign up</a>
                            </p>
                        @endauth
                    </div>

                    <!-- Property Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Property Statistics</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Views</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ number_format($property->views) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Listed</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $property->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Status</span>
                                <span class="inline-flex px-2 py-1 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-xs font-semibold rounded-full">
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
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Similar Properties</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($similarProperties as $similar)
                            <a href="{{ route('properties.show', $similar->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                                <div class="relative h-48">
                                    @php
                                        $firstImage = $similar->images[0] ?? null;
                                        if ($firstImage) {
                                            // Handle both old format (string) and new format (array with path)
                                            $imagePath = is_array($firstImage) ? ($firstImage['path'] ?? $firstImage) : $firstImage;
                                            
                                            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                $imageUrl = $imagePath;
                                            } elseif (Str::startsWith($imagePath, 'http')) {
                                                $imageUrl = $imagePath;
                                            } elseif (Str::startsWith($imagePath, 'uploads/')) {
                                                $imageUrl = asset($imagePath);
                                            } elseif (Str::startsWith($imagePath, '/storage/')) {
                                                $imageUrl = $imagePath;
                                            } else {
                                                $imageUrl = Storage::url($imagePath);
                                            }
                                        } else {
                                            $imageUrl = 'https://via.placeholder.com/400x300?text=No+Image';
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $similar->title }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                                    <span class="absolute top-3 right-3 bg-blue-600 dark:bg-blue-700 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $similar->formatted_price }}
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ Str::limit($similar->title, 40) }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $similar->city }}, {{ $similar->state }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400">
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
</div>
@endsection
