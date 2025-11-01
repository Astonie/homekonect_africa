@extends('layouts.home')

@section('title', 'Home Konnect - Find Your Dream Home')
@section('main_classes', '')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2850&q=80" 
                 alt="Modern African Luxury Home" 
                 class="w-full h-full object-cover">
            <!-- Dark Gradient Overlays for text readability -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/95 via-blue-900/90 to-gray-900/95 dark:from-black/98 dark:via-blue-950/95 dark:to-black/98"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent dark:from-black/90"></div>
        </div>

        <!-- Animated Background Pattern Overlay -->
        <div class="absolute inset-0 z-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="text-center space-y-12">
                <!-- Badge -->
                <div data-aos="fade-down" class="inline-flex items-center gap-2 bg-blue-500/10 backdrop-blur-md text-blue-300 px-5 py-2.5 rounded-full border border-blue-400/30 shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">Africa's Most Trusted Real Estate Platform</span>
                </div>
                
                <!-- Main Heading -->
                <div data-aos="fade-up" data-aos-delay="100" class="space-y-6">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight tracking-tight">
                        Find Your Dream Home
                        <br>
                        <span class="relative inline-block mt-2">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 animate-gradient">
                                Across Africa
                            </span>
                            <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></span>
                        </span>
                    </h1>
                    
                    <p class="text-lg sm:text-xl text-gray-300 leading-relaxed max-w-3xl mx-auto font-light">
                        Connect with verified properties, trusted agents, and secure transactions across 45+ African cities
                    </p>
                </div>
                
                <!-- CTA Buttons -->
                <div data-aos="fade-up" data-aos-delay="200" class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="#properties" class="group inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold shadow-2xl shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 space-x-3 w-full sm:w-auto">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Explore Properties</span>
                    </a>
                    <a href="{{ route('register') }}" class="group inline-flex items-center justify-center bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-8 py-4 rounded-xl font-semibold border-2 border-white/20 hover:border-white/40 shadow-xl transition-all duration-300 transform hover:-translate-y-1 space-x-3 w-full sm:w-auto">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>List Your Property</span>
                    </a>
                </div>
                
                <!-- Stats Cards -->
                <div data-aos="fade-up" data-aos-delay="300" class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6 pt-12 max-w-4xl mx-auto">
                    <div class="group bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:border-blue-500/50 shadow-xl hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-3xl lg:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">50K+</div>
                        <div class="text-sm text-gray-400 font-medium">Verified Users</div>
                    </div>
                    <div class="group bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:border-cyan-500/50 shadow-xl hover:shadow-2xl hover:shadow-cyan-500/20 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-3xl lg:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">15K+</div>
                        <div class="text-sm text-gray-400 font-medium">Properties Listed</div>
                    </div>
                    <div class="group bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:border-purple-500/50 shadow-xl hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-3xl lg:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">45+</div>
                        <div class="text-sm text-gray-400 font-medium">African Cities</div>
                    </div>
                    <div class="group bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:border-green-500/50 shadow-xl hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-3xl lg:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">98%</div>
                        <div class="text-sm text-gray-400 font-medium">Satisfaction Rate</div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div data-aos="fade-up" data-aos-delay="400" class="flex flex-wrap items-center justify-center gap-6 pt-8 text-gray-400 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Secure Escrow Payments</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Verified Listings</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <div class="flex flex-col items-center gap-2 text-white/60 hover:text-white/90 transition-colors duration-300 cursor-pointer" onclick="document.querySelector('#properties').scrollIntoView({ behavior: 'smooth' })">
                <span class="text-xs font-medium uppercase tracking-wider">Scroll to Explore</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>
    <!-- Quick Search Section -->
    <section id="properties" class="py-20 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Card -->
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-purple-700 dark:from-blue-800 dark:via-blue-900 dark:to-purple-900 rounded-3xl shadow-2xl overflow-hidden">
                <!-- Decorative Pattern Overlay -->
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.3\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                
                <div class="relative p-8 md:p-12">
                    <!-- Header -->
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20 mb-4">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                            </svg>
                            <span class="text-white text-sm font-medium">Advanced Property Search</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Find Your Perfect Property</h2>
                        <p class="text-blue-100 dark:text-blue-200 text-lg max-w-2xl mx-auto">
                            Search through thousands of verified properties with our advanced filtering system
                        </p>
                    </div>
                    
                    <!-- Main Search CTA -->
                    <div class="max-w-4xl mx-auto">
                        <a href="{{ route('properties.index') }}" class="block group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                            <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                                <div class="flex flex-col lg:flex-row items-center gap-6">
                                    <!-- Search Info -->
                                    <div class="flex-1 text-left w-full">
                                        <!-- Feature Badges -->
                                        <div class="flex flex-wrap gap-3 mb-5">
                                            <div class="flex items-center gap-2 bg-blue-50 dark:bg-blue-900/30 px-4 py-2.5 rounded-lg border border-blue-100 dark:border-blue-800">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">Smart Filters</span>
                                            </div>
                                            <div class="flex items-center gap-2 bg-purple-50 dark:bg-purple-900/30 px-4 py-2.5 rounded-lg border border-purple-100 dark:border-purple-800">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                                </svg>
                                                <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">Verified Properties</span>
                                            </div>
                                            <div class="flex items-center gap-2 bg-green-50 dark:bg-green-900/30 px-4 py-2.5 rounded-lg border border-green-100 dark:border-green-800">
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">Instant Results</span>
                                            </div>
                                        </div>
                                        
                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                            Explore Advanced Search Options
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                                            Filter by property type, price range, location, bedrooms, bathrooms, amenities, and much more to find exactly what you need
                                        </p>
                                        
                                        <!-- Quick Stats -->
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-gray-900 dark:text-white">15K+</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Properties</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-gray-900 dark:text-white">45+</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Cities</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-gray-900 dark:text-white">100%</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Verified</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-gray-900 dark:text-white">24/7</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Support</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Search Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="bg-gradient-to-br from-blue-600 to-purple-600 text-white rounded-2xl p-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-xl">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Quick Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 max-w-4xl mx-auto">
                        <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}" class="group bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:border-white/40 hover:bg-white/20 text-white px-6 py-4 rounded-xl transition-all duration-300 text-center font-semibold flex items-center justify-center gap-3 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <span>Rentals</span>
                        </a>
                        <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}" class="group bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:border-white/40 hover:bg-white/20 text-white px-6 py-4 rounded-xl transition-all duration-300 text-center font-semibold flex items-center justify-center gap-3 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>For Sale</span>
                        </a>
                        <a href="{{ route('properties.index', ['listing_type' => 'shortlet']) }}" class="group bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:border-white/40 hover:bg-white/20 text-white px-6 py-4 rounded-xl transition-all duration-300 text-center font-semibold flex items-center justify-center gap-3 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Shortlets</span>
                        </a>
                    </div>
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
                                
                                <!-- Price Badge -->
                                <div class="absolute bottom-4 right-4">
                                    <span class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-md text-gray-900 dark:text-white px-4 py-2 rounded-lg font-bold text-lg shadow-xl border border-gray-200 dark:border-gray-700">
                                        {{ $property->formatted_price }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-xs font-semibold">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        {{ ucfirst($property->type) }}
                                    </span>
                                    @if($property->status === 'available')
                                        <span class="inline-flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                            Available
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                    {{ $property->title }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $property->city }}, {{ $property->state }}</span>
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 border-t dark:border-gray-700 pt-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        <span>{{ $property->bedrooms }} Beds</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                        <span>{{ $property->bathrooms }} Baths</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                                        </svg>
                                        <span>{{ number_format($property->square_feet) }} sqft</span>
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
    
    <!-- Minimal CTA Section with House Background -->
    <section id="contact" class="relative py-20 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
            <!-- Dark overlay for light mode, lighter overlay for dark mode -->
            <div class="absolute inset-0 bg-gray-900/70 dark:bg-gray-950/80"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">
                Ready to Find Your Dream Home?
            </h2>
            <p class="text-lg sm:text-xl text-gray-200 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                Join thousands of happy homeowners who found their perfect property with HomeKonnect
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('properties.index') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-gray-900 dark:text-gray-900 bg-white dark:bg-white hover:bg-gray-100 dark:hover:bg-gray-200 rounded-lg shadow-lg transition-all duration-200 w-full sm:w-auto">
                    Browse Properties
                </a>
                
                <a href="{{ route('contact.show') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white border-2 border-white hover:bg-white hover:text-gray-900 dark:hover:text-gray-900 rounded-lg transition-all duration-200 w-full sm:w-auto">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
