<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Konnect - Find Your Dream Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Theme initialization script (runs before page render to prevent flash)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <nav class="fixed w-full bg-gray-900/95 dark:bg-gray-950/95 backdrop-blur-md shadow-lg z-50 border-b border-gray-800 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <x-logo size="default" class="text-white" />
                        <div class="flex flex-col">
                            <span class="text-xl font-bold text-white">HomeKonnect</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500">Africa's Trusted Real Estate</span>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white font-medium transition duration-200">Home</a>
                    <a href="#properties" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white font-medium transition duration-200">Find Properties</a>
                    <a href="#about" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white font-medium transition duration-200">About Us</a>
                    <a href="#contact" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white font-medium transition duration-200">Contact</a>
                </div>

                <!-- Auth Buttons & Theme Toggle -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" type="button" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white p-2 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-white font-medium transition duration-200">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 text-white px-6 py-2.5 rounded-lg hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 transition duration-200 font-semibold shadow-lg hover:shadow-blue-500/50 flex items-center space-x-2">
                        <span>Get Started</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section with Background Image -->
    <section class="relative pt-24 pb-16 min-h-[90vh] flex items-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2075&q=80" 
                 alt="Modern Luxury Home" 
                 class="w-full h-full object-cover">
            <!-- Gradient Overlay for better text readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/95 via-gray-900/80 to-gray-900/70 dark:from-black/95 dark:via-black/85 dark:to-black/75"></div>
            <!-- Additional gradient from bottom -->
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent dark:from-black/70"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-4xl">
                <div class="space-y-8">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-gray-800/60 backdrop-blur-md text-white px-5 py-2.5 rounded-full text-sm font-medium border border-gray-700/50 shadow-xl">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Africa's Most Trusted Real Estate Platform</span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                        Find Your Dream Home<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Across Africa</span>
                    </h1>
                    
                    <!-- Subheading with Features -->
                    <p class="text-lg md:text-xl text-gray-300 leading-relaxed max-w-3xl">
                        <span class="font-semibold text-white">50,000+ verified users</span> • 
                        <span class="font-semibold text-white">15,000+ properties</span> • 
                        <span class="font-semibold text-white">Secure escrow payments</span> • 
                        <span class="font-semibold text-white">24/7 support in 45+ African cities</span>
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#properties" class="inline-flex items-center justify-center bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold shadow-2xl hover:shadow-blue-500/50 transform hover:scale-105 space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Browse Properties</span>
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-gray-800/60 backdrop-blur-md text-white px-8 py-4 rounded-lg hover:bg-gray-700/60 transition duration-300 font-semibold border-2 border-gray-600/50 shadow-xl">
                            <span>List Your Property</span>
                        </a>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-3 gap-4 pt-8 max-w-2xl">
                        <div class="bg-gray-800/40 backdrop-blur-md rounded-xl p-6 border border-gray-700/50 shadow-xl">
                            <div class="text-4xl font-bold text-white mb-1">50K+</div>
                            <div class="text-sm text-gray-300">Verified Users</div>
                        </div>
                        <div class="bg-gray-800/40 backdrop-blur-md rounded-xl p-6 border border-gray-700/50 shadow-xl">
                            <div class="text-4xl font-bold text-white mb-1">15K+</div>
                            <div class="text-sm text-gray-300">Properties</div>
                        </div>
                        <div class="bg-gray-800/40 backdrop-blur-md rounded-xl p-6 border border-gray-700/50 shadow-xl">
                            <div class="text-4xl font-bold text-white mb-1">98%</div>
                            <div class="text-sm text-gray-300">Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>
    <!-- Quick Search Section -->
    <section class="py-16 bg-white dark:bg-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 rounded-2xl shadow-2xl p-8 md:p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3">Find Your Dream Home</h2>
                    <p class="text-blue-100 dark:text-blue-200 text-lg">Discover thousands of verified properties across Africa</p>
                </div>
                
                <!-- Quick Search CTA -->
                <div class="max-w-3xl mx-auto">
                    <a href="{{ route('properties.index') }}" class="block group">
                        <div class="bg-white rounded-xl p-6 hover:shadow-2xl transition duration-300 transform hover:scale-[1.02]">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span class="text-sm font-semibold text-blue-600">Advanced Search Available</span>
                                        </div>
                                        <div class="flex items-center space-x-2 bg-purple-50 px-4 py-2 rounded-lg">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                            </svg>
                                            <span class="text-sm font-semibold text-purple-600">10+ Filters</span>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Search with Advanced Filters</h3>
                                    <p class="text-gray-600">Filter by property type, price range, location, bedrooms, amenities, and more</p>
                                </div>
                                <div class="ml-6">
                                    <div class="bg-blue-600 text-white rounded-full p-4 group-hover:bg-blue-700 transition">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Search Features -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-6 pt-6 border-t border-gray-100">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">15K+</div>
                                    <div class="text-xs text-gray-600">Properties</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">45+</div>
                                    <div class="text-xs text-gray-600">Cities</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">100%</div>
                                    <div class="text-xs text-gray-600">Verified</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">24/7</div>
                                    <div class="text-xs text-gray-600">Support</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Quick Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 max-w-3xl mx-auto">
                    <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-6 py-3 rounded-lg hover:bg-white/20 transition text-center font-semibold">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        For Rent
                    </a>
                    <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-6 py-3 rounded-lg hover:bg-white/20 transition text-center font-semibold">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        For Sale
                    </a>
                    <a href="{{ route('properties.index', ['listing_type' => 'shortlet']) }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-6 py-3 rounded-lg hover:bg-white/20 transition text-center font-semibold">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Shortlet
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="properties" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Featured Properties</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Handpicked properties just for you</p>
            </div>
            
            @if($properties->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($properties as $property)
                        <a href="{{ route('properties.show', $property->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                            <div class="relative h-64 overflow-hidden">
                                @php
                                    $firstImage = $property->images[0] ?? null;
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
                                <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300" onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                                @if($property->is_featured)
                                    <span class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                                @endif
                                <span class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ ucfirst($property->listing_type) }}
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($property->type) }}</span>
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $property->formatted_price }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $property->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->city }}, {{ $property->state }}
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 border-t dark:border-gray-700 pt-4">
                                    <span>🛏️ {{ $property->bedrooms }} Beds</span>
                                    <span>🚿 {{ $property->bathrooms }} Baths</span>
                                    <span>📏 {{ number_format($property->square_feet) }} sqft</span>
                                </div>
                                <div class="mt-4 pt-4 border-t dark:border-gray-700">
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-2">
                                                <span class="text-blue-600 dark:text-blue-300 font-semibold">{{ substr($property->owner->name, 0, 1) }}</span>
                                            </div>
                                            <span>{{ $property->owner->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('properties.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                        View All Properties
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Properties Available</h3>
                    <p class="text-gray-600 dark:text-gray-400">Check back soon for new listings!</p>
                </div>
            @endif
        </div>
    </section>
    <section id="about" class="py-20 bg-white dark:bg-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Why Choose Home Konnect?</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Your trusted partner in finding the perfect home</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full mb-6">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Smart Search</h3>
                    <p class="text-gray-600 dark:text-gray-400">Advanced filters to help you find exactly what you're looking for in minutes.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full mb-6">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Secure Transactions</h3>
                    <p class="text-gray-600 dark:text-gray-400">Your safety is our priority. All transactions are secure and verified.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full mb-6">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Expert Agents</h3>
                    <p class="text-gray-600 dark:text-gray-400">Work with experienced real estate professionals every step of the way.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    @if($teamMembers->count() > 0)
    <section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Meet Our Team</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">The dedicated professionals behind HomeKonnectAfrica</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($teamMembers as $member)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700">
                        <div class="relative h-64 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $member->name }}</h3>
                            <p class="text-blue-600 dark:text-blue-400 font-semibold text-sm mb-3">{{ $member->role }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $member->bio }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <section id="contact" class="py-20 bg-linear-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Find Your Dream Home?</h2>
            <p class="text-xl text-blue-100 mb-8">Join thousands of happy homeowners who found their perfect property with Home Konnect</p>
        </div>
    </section>

    <footer class="bg-gray-900 dark:bg-gray-950 text-gray-300 dark:text-gray-400 py-12 border-t border-gray-800 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <x-logo size="sm" class="text-white" />
                        <span class="text-xl font-bold text-white">Home<span class="text-blue-500 dark:text-blue-400">Konnect</span></span>
                    </div>
                    <p class="text-sm">Your trusted partner in finding the perfect home.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Properties</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Agents</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-blue-400 dark:hover:text-blue-300 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-sm">
                        <li>📧 info@homekonnect.com</li>
                        <li>📞 +1 (555) 123-4567</li>
                        <li>📍 123 Real Estate Ave, NY</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 dark:border-gray-700 mt-12 pt-8 text-center text-sm">
                <p>&copy; 2025 Home Konnect. All rights reserved. Built with Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

    <!-- Theme Toggle Script -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Show the correct icon based on the current theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Toggle theme
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    </script>
</body>
</html>
