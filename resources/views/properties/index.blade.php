@extends('layouts.home')

@section('title', 'Properties - HomeKonnect')
@section('meta_description', 'Browse our extensive collection of properties')

@section('nav_classes', 'bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300')

@section('body_attributes')
x-data="{ 
    showFilters: true, 
    viewMode: 'grid',
    sortBy: 'newest'
}"
@endsection

@section('nav_links')
    <a href="/" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium">Home</a>
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-600 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Find Your Perfect Property</h1>
                    <p class="text-xl text-blue-100">Explore {{ $properties->total() }} verified properties across Africa</p>
                </div>
                <div class="hidden md:flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $properties->total() }}</div>
                        <div class="text-sm text-blue-100">Properties</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar Filters -->
                <aside class="lg:w-80 flex-shrink-0">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg sticky top-24 transition-colors duration-300">
                        <!-- Filter Header -->
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Filters
                                </h2>
                                <button @click="showFilters = !showFilters" class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @if(request()->hasAny(['type', 'listing_type', 'city', 'state', 'min_price', 'max_price', 'bedrooms', 'bathrooms', 'min_sqft']))
                                <a href="{{ route('properties.index') }}" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Clear All Filters
                                </a>
                            @endif
                        </div>

                        <form method="GET" action="{{ route('properties.index') }}" class="p-6 space-y-6" x-show="showFilters" x-transition>
                            
                            <!-- Listing Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Listing Type</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700 border-2 rounded-lg cursor-pointer transition hover:bg-gray-100 dark:hover:bg-gray-600 {{ request('listing_type') === 'rent' ? 'border-blue-600 dark:border-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-600' }}">
                                        <input type="radio" name="listing_type" value="rent" class="sr-only" {{ request('listing_type') === 'rent' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="text-sm font-medium {{ request('listing_type') === 'rent' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">For Rent</span>
                                    </label>
                                    <label class="relative flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700 border-2 rounded-lg cursor-pointer transition hover:bg-gray-100 dark:hover:bg-gray-600 {{ request('listing_type') === 'sale' ? 'border-blue-600 dark:border-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-600' }}">
                                        <input type="radio" name="listing_type" value="sale" class="sr-only" {{ request('listing_type') === 'sale' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="text-sm font-medium {{ request('listing_type') === 'sale' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">For Sale</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Property Type</label>
                                <select name="type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" onchange="this.form.submit()">
                                    <option value="">All Types</option>
                                    <option value="house" {{ request('type') === 'house' ? 'selected' : '' }}>House</option>
                                    <option value="apartment" {{ request('type') === 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="condo" {{ request('type') === 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="studio" {{ request('type') === 'studio' ? 'selected' : '' }}>Studio</option>
                                    <option value="townhouse" {{ request('type') === 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                    <option value="villa" {{ request('type') === 'villa' ? 'selected' : '' }}>Villa</option>
                                </select>
                            </div>

                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Location</label>
                                <div class="space-y-3">
                                    <input type="text" name="city" value="{{ request('city') }}" placeholder="City" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                                    <input type="text" name="state" value="{{ request('state') }}" placeholder="State/Region" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Price Range</label>
                                <div class="space-y-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">$</span>
                                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" class="w-full pl-8 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">$</span>
                                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" class="w-full pl-8 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                                    </div>
                                </div>
                                <!-- Quick Price Filters -->
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <button type="button" onclick="document.querySelector('[name=min_price]').value=''; document.querySelector('[name=max_price]').value='500000'; this.form.submit();" class="px-3 py-1 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        Under $500K
                                    </button>
                                    <button type="button" onclick="document.querySelector('[name=min_price]').value='500000'; document.querySelector('[name=max_price]').value='1000000'; this.form.submit();" class="px-3 py-1 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        $500K - $1M
                                    </button>
                                    <button type="button" onclick="document.querySelector('[name=min_price]').value='1000000'; document.querySelector('[name=max_price]').value=''; this.form.submit();" class="px-3 py-1 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        Over $1M
                                    </button>
                                </div>
                            </div>

                            <!-- Bedrooms -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Bedrooms</label>
                                <div class="grid grid-cols-4 gap-2">
                                    @for($i = 1; $i <= 4; $i++)
                                        <label class="relative flex items-center justify-center p-3 bg-gray-50 dark:bg-gray-700 border-2 rounded-lg cursor-pointer transition hover:bg-gray-100 dark:hover:bg-gray-600 {{ request('bedrooms') == $i ? 'border-blue-600 dark:border-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-600' }}">
                                            <input type="radio" name="bedrooms" value="{{ $i }}" class="sr-only" {{ request('bedrooms') == $i ? 'checked' : '' }} onchange="this.form.submit()">
                                            <span class="text-sm font-medium {{ request('bedrooms') == $i ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">{{ $i }}{{ $i === 4 ? '+' : '' }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Bathrooms -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Bathrooms</label>
                                <div class="grid grid-cols-4 gap-2">
                                    @for($i = 1; $i <= 4; $i++)
                                        <label class="relative flex items-center justify-center p-3 bg-gray-50 dark:bg-gray-700 border-2 rounded-lg cursor-pointer transition hover:bg-gray-100 dark:hover:bg-gray-600 {{ request('bathrooms') == $i ? 'border-blue-600 dark:border-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-600' }}">
                                            <input type="radio" name="bathrooms" value="{{ $i }}" class="sr-only" {{ request('bathrooms') == $i ? 'checked' : '' }} onchange="this.form.submit()">
                                            <span class="text-sm font-medium {{ request('bathrooms') == $i ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">{{ $i }}{{ $i === 4 ? '+' : '' }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Square Footage -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Square Footage</label>
                                <input type="number" name="min_sqft" value="{{ request('min_sqft') }}" placeholder="Min Sq Ft" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                            </div>

                            <!-- Amenities -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">Amenities</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="furnished" value="1" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 focus:ring-blue-500 dark:bg-gray-700" {{ request('furnished') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Furnished</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="parking" value="1" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 focus:ring-blue-500 dark:bg-gray-700" {{ request('parking') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Parking Available</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="pool" value="1" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 focus:ring-blue-500 dark:bg-gray-700" {{ request('pool') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Swimming Pool</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="gym" value="1" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 focus:ring-blue-500 dark:bg-gray-700" {{ request('gym') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Gym/Fitness Center</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Apply Filters Button -->
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold shadow-lg">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </aside>

                </aside>

                <!-- Results Section -->
                <div class="flex-1 min-w-0">
                    
                    <!-- Results Header -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 mb-6 transition-colors duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex items-center space-x-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $properties->total() }}</span> properties found
                                </p>
                                
                                <!-- Active Filters -->
                                <div class="flex flex-wrap gap-2">
                                    @if(request('type'))
                                        <span class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                                            {{ ucfirst(request('type')) }}
                                            <a href="{{ request()->fullUrlWithQuery(['type' => null]) }}" class="ml-2 hover:text-blue-900 dark:hover:text-blue-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('listing_type'))
                                        <span class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                                            For {{ ucfirst(request('listing_type')) }}
                                            <a href="{{ request()->fullUrlWithQuery(['listing_type' => null]) }}" class="ml-2 hover:text-green-900 dark:hover:text-green-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('city'))
                                        <span class="inline-flex items-center px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-full">
                                            📍 {{ request('city') }}
                                            <a href="{{ request()->fullUrlWithQuery(['city' => null]) }}" class="ml-2 hover:text-purple-900 dark:hover:text-purple-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <!-- View Mode Toggle -->
                                <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                                    <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-white dark:bg-gray-600 shadow-sm' : ''" class="p-2 rounded-md transition">
                                        <svg class="w-5 h-5" :class="viewMode === 'grid' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                    </button>
                                    <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-white dark:bg-gray-600 shadow-sm' : ''" class="p-2 rounded-md transition">
                                        <svg class="w-5 h-5" :class="viewMode === 'list' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Sort Dropdown -->
                                <select class="rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm" onchange="window.location.href = this.value">
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'sqft_large']) }}" {{ request('sort') === 'sqft_large' ? 'selected' : '' }}>Largest First</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Results Grid/List -->
                    @if($properties->count() > 0)
                        <!-- Grid View -->
                        <div x-show="viewMode === 'grid'" class="grid md:grid-cols-2 gap-6 mb-8">
                            @foreach($properties as $property)
                                <a href="{{ route('properties.show', $property->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group border border-gray-100 dark:border-gray-700">
                                    <div class="relative h-64 overflow-hidden">
                                        @php
                                            $imageData = $property->images[0] ?? null;
                                            // Extract path from array or use string directly
                                            $firstImage = is_array($imageData) ? ($imageData['path'] ?? '') : $imageData;
                                            
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
                                                $imageUrl = 'https://via.placeholder.com/800x600?text=No+Image';
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                        
                                        <!-- Badges -->
                                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                                            @if($property->is_featured)
                                                <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full shadow-lg">
                                                    ⭐ Featured
                                                </span>
                                            @endif
                                            <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full shadow-lg">
                                                {{ ucfirst($property->listing_type) }}
                                            </span>
                                        </div>
                                        
                                        <!-- Price Badge -->
                                        <div class="absolute bottom-4 right-4">
                                            <div class="bg-white/95 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg">
                                                <div class="text-2xl font-bold text-blue-600">{{ $property->formatted_price }}</div>
                                                @if($property->listing_type === 'rent')
                                                    <div class="text-xs text-gray-600">/month</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="inline-flex px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                                {{ ucfirst($property->type) }}
                                            </span>
                                            <span class="text-sm text-gray-500 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ number_format($property->views) }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                            {{ $property->title }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $property->city }}, {{ $property->state }}
                                        </p>
                                        <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 border-t dark:border-gray-700 pt-4">
                                            <span class="flex items-center">
                                                <svg class="w-5 h-5 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                {{ $property->bedrooms }} Beds
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-5 h-5 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $property->bathrooms }} Baths
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-5 h-5 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                                </svg>
                                                {{ number_format($property->square_feet) }} sqft
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- List View -->
                        <div x-show="viewMode === 'list'" class="space-y-6 mb-8">
                            @foreach($properties as $property)
                                <a href="{{ route('properties.show', $property->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col md:flex-row border border-gray-100 dark:border-gray-700">
                                    <div class="relative md:w-80 h-64 md:h-auto flex-shrink-0 overflow-hidden">
                                        @php
                                            $imageData = $property->images[0] ?? null;
                                            // Extract path from array or use string directly
                                            $firstImage = is_array($imageData) ? ($imageData['path'] ?? '') : $imageData;
                                            
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
                                                $imageUrl = 'https://via.placeholder.com/800x600?text=No+Image';
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                                        
                                        <!-- Badges -->
                                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                                            @if($property->is_featured)
                                                <span class="inline-flex items-center bg-gradient-to-r from-yellow-500 to-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    Featured
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center bg-blue-600 dark:bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg backdrop-blur-sm">
                                                {{ ucfirst($property->listing_type) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-6">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-lg mb-2">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                    </svg>
                                                    {{ ucfirst($property->type) }}
                                                </span>
                                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                                    {{ $property->title }}
                                                </h3>
                                                <p class="text-gray-600 dark:text-gray-400 mb-3 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $property->city }}, {{ $property->state }}
                                                </p>
                                            </div>
                                            <div class="text-right ml-4">
                                                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $property->formatted_price }}</div>
                                                @if($property->listing_type === 'rent')
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">/month</div>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $property->description }}</p>
                                        <div class="flex items-center justify-between border-t dark:border-gray-700 pt-4">
                                            <div class="flex items-center space-x-6 text-sm text-gray-600 dark:text-gray-400">
                                                <span class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                    </svg>
                                                    {{ $property->bedrooms }} Beds
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                                    </svg>
                                                    {{ $property->bathrooms }} Baths
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                                    </svg>
                                                    {{ number_format($property->square_feet) }} sqft
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ number_format($property->views) }} views
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $properties->links() }}
                        </div>
                    @else
                        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                            <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Properties Found</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Try adjusting your filters or check back later for new listings.</p>
                            <a href="{{ route('properties.index') }}" class="inline-flex items-center bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition font-semibold shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Clear All Filters
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
@endsection
