@extends('layouts.public')

@section('title', 'Properties - Home Konnect')

@section('content')
<section class="relative min-h-[70vh] flex items-center bg-cover bg-center bg-no-repeat"
    style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070');">
    <!-- Subtle overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/40 to-black/30"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-background leading-tight mb-8">
                Find Your Perfect <span class="text-primary">Property</span>
            </h1>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20 max-w-6xl mx-auto relative overflow-hidden">
            <!-- Subtle inner glow effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-white/5 to-transparent rounded-2xl"></div>

            <form class="grid md:grid-cols-5 gap-6 relative z-10">
                <!-- Property Type -->
                <div>
                    <label class="block text-sm font-semibold text-white mb-3 drop-shadow-sm">Property Type</label>
                    <select class="w-full px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 focus:border-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 text-white placeholder-white/70 transition-all duration-300 shadow-lg">
                        <option value="" class="text-gray-800">All Types</option>
                        <option value="apartment" class="text-gray-800">Apartment</option>
                        <option value="house" class="text-gray-800">House</option>
                        <option value="condo" class="text-gray-800">Condo</option>
                        <option value="townhouse" class="text-gray-800">Townhouse</option>
                        <option value="villa" class="text-gray-800">Villa</option>
                    </select>
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-semibold text-white mb-3 drop-shadow-sm">Location</label>
                    <select class="w-full px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 focus:border-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 text-white placeholder-white/70 transition-all duration-300 shadow-lg">
                        <option value="" class="text-gray-800">All Locations</option>
                        <option value="new-york" class="text-gray-800">New York</option>
                        <option value="los-angeles" class="text-gray-800">Los Angeles</option>
                        <option value="chicago" class="text-gray-800">Chicago</option>
                        <option value="houston" class="text-gray-800">Houston</option>
                        <option value="phoenix" class="text-gray-800">Phoenix</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-semibold text-white mb-3 drop-shadow-sm">Price Range</label>
                    <select class="w-full px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 focus:border-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 text-white placeholder-white/70 transition-all duration-300 shadow-lg">
                        <option value="" class="text-gray-800">Any Price</option>
                        <option value="0-100000" class="text-gray-800">$0 - $100,000</option>
                        <option value="100000-250000" class="text-gray-800">$100,000 - $250,000</option>
                        <option value="250000-500000" class="text-gray-800">$250,000 - $500,000</option>
                        <option value="500000-1000000" class="text-gray-800">$500,000 - $1,000,000</option>
                        <option value="1000000+" class="text-gray-800">$1,000,000+</option>
                    </select>
                </div>

                <!-- Bedrooms -->
                <div>
                    <label class="block text-sm font-semibold text-white mb-3 drop-shadow-sm">Bedrooms</label>
                    <select class="w-full px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 focus:border-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 text-white placeholder-white/70 transition-all duration-300 shadow-lg">
                        <option value="" class="text-gray-800">Any</option>
                        <option value="1" class="text-gray-800">1+</option>
                        <option value="2" class="text-gray-800">2+</option>
                        <option value="3" class="text-gray-800">3+</option>
                        <option value="4" class="text-gray-800">4+</option>
                        <option value="5" class="text-gray-800">5+</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-white/90 hover:bg-white text-gray-800 hover:text-gray-900 py-2 px-6 rounded-xl font-semibold transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 flex items-center justify-center backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="pt-20 pb-16 bg-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Results Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-text-primary mb-2">Available Properties</h2>
                <p class="text-text-secondary">Showing {{ $properties->count() }} properties</p>
            </div>
            <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                <select class="px-3 py-2 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="popular">Most Popular</option>
                </select>
            </div>
        </div>

        <!-- Properties Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($properties as $property)
            <x-property-card :property="$property" />
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-text-secondary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="text-xl font-semibold text-text-primary mb-2">No Properties Found</h3>
                <p class="text-text-secondary">There are currently no properties available. Please check back later.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($properties->hasPages())
        <div class="flex justify-center">
            <div class="flex items-center space-x-2">
                @if($properties->onFirstPage())
                    <button class="px-3 py-2 rounded-lg border-2 border-border text-text-secondary cursor-not-allowed" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                @else
                    <a href="{{ $properties->previousPageUrl() }}" class="px-3 py-2 rounded-lg border-2 border-border text-text-secondary hover:border-primary hover:text-primary transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                @endif

                @foreach($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
                    @if($page == $properties->currentPage())
                        <span class="px-3 py-2 rounded-lg bg-primary text-background font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-lg border-2 border-border text-text-secondary hover:border-primary hover:text-primary transition-colors duration-200">{{ $page }}</a>
                    @endif
                @endforeach

                @if($properties->hasMorePages())
                    <a href="{{ $properties->nextPageUrl() }}" class="px-3 py-2 rounded-lg border-2 border-border text-text-secondary hover:border-primary hover:text-primary transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <button class="px-3 py-2 rounded-lg border-2 border-border text-text-secondary cursor-not-allowed" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>


@endsection