@extends('layouts.public')

@section('title', 'Home Konnect - Find Your Dream Home')

@section('content')
    <section class="relative min-h-screen flex items-center bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070');">
        <!-- Subtle overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/40 via-black/30 to-black/20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8 text-background">


                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight">
                        Find Your Perfect <span class="text-primary">Home</span> With Ease
                    </h1>

                    <p class="text-xl text-background/90 leading-relaxed max-w-lg">
                        Discover thousands of verified properties, connect with trusted agents, and find your dream home in
                        the perfect location with our advanced search technology.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#properties"
                            class="bg-primary text-background px-6 py-3 rounded-xl hover:bg-primary/90 transition-all duration-300 font-semibold text-center shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Browse Properties
                        </a>
                        <a href="#contact"
                            class="bg-background/90 text-text-primary px-6 py-3 rounded-xl hover:bg-background transition-all duration-300 font-semibold text-center border-2 border-background/50 shadow-lg hover:shadow-xl backdrop-blur-sm">
                            Contact Us
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-background/30">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-background mb-1">1000+</div>
                            <div class="text-sm text-background/80 font-medium">Properties Listed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-background mb-1">500+</div>
                            <div class="text-sm text-background/80 font-medium">Happy Clients</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-background mb-1">50+</div>
                            <div class="text-sm text-background/80 font-medium">Cities Covered</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Feature Cards -->
                <div class="relative lg:block hidden">
                    <div class="space-y-4">
                        <!-- Smaller Floating Cards -->
                        <div
                            class="bg-background/95 backdrop-blur-sm rounded-lg shadow-lg p-4 animate-float border border-background/20 max-w-fit">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-success-50 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-success-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-text-primary text-sm">Verified Properties</div>
                                    <div class="text-text-secondary text-xs">100% authentic listings</div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-background/95 backdrop-blur-sm rounded-lg shadow-lg p-4 animate-float-delayed border border-background/20 max-w-fit ml-8">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-info-50 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-info-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-text-primary text-sm">$2.5M Average</div>
                                    <div class="text-text-secondary text-xs">Market price range</div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-background/95 backdrop-blur-sm rounded-lg shadow-lg p-4 animate-float border border-background/20 max-w-fit">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-accent-50 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-text-primary text-sm">Best Deals</div>
                                    <div class="text-text-secondary text-xs">Competitive pricing</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="flex flex-col items-center space-y-2 text-background">
                <span class="text-sm font-medium opacity-80">Scroll Down</span>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <section id="properties" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Properties</h2>

            </div>

            <form class="grid md:grid-cols-5 gap-4 items-end mb-8">
                <!-- Location Input -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-text-primary">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Location
                    </label>
                    <input type="text" placeholder="Enter city, state, or zip code"
                        class="w-full px-3 py-2 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200 text-sm">
                </div>

                <!-- Property Type -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-text-primary">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Property Type
                    </label>
                    <select
                        class="w-full px-3 py-2 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200 text-sm">
                        <option>All Types</option>
                        <option>House</option>
                        <option>Apartment</option>
                        <option>Condo</option>
                        <option>Townhouse</option>
                        <option>Land</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-text-primary">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                        Price Range
                    </label>
                    <select
                        class="w-full px-3 py-2 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200 text-sm">
                        <option>Any Price</option>
                        <option>$0 - $200k</option>
                        <option>$200k - $500k</option>
                        <option>$500k - $1M</option>
                        <option>$1M - $2M</option>
                        <option>$2M+</option>
                    </select>
                </div>

                <!-- Bedrooms -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-text-primary">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0M8 5a2 2 0 012-2h4a2 2 0 012 2v0"></path>
                        </svg>
                        Bedrooms
                    </label>
                    <select
                        class="w-full px-3 py-2 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200 text-sm">
                        <option>Any</option>
                        <option>1+</option>
                        <option>2+</option>
                        <option>3+</option>
                        <option>4+</option>
                        <option>5+</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div class="md:col-span-1">
                    <button
                        class="w-full bg-primary hover:bg-primary/90 text-background px-4 py-2 rounded-lg font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Search</span>
                    </button>
                </div>
            </form>

            @if ($properties->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($properties as $property)
                        <x-property-card :property="$property" :layout="'featured'" />
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="/properties"
                        class="inline-block bg-primary text-background px-8 py-3 rounded-lg hover:bg-primary/90 transition font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        View All Properties
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Properties Available</h3>
                    <p class="text-gray-600">Check back soon for new listings!</p>
                </div>
            @endif
        </div>
    </section>
    <section id="about" class="py-20 bg-cover bg-center bg-no-repeat relative" style="background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?q=80&w=2096');">
        <div class="absolute inset-0 bg-white/80"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-text-primary mb-4">Why Choose Home Konnect?</h2>
                <p class="text-xl text-text-secondary">Your trusted partner in finding the perfect home</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center group bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary/10 rounded-full mb-8 group-hover:bg-primary/20 transition-colors duration-300">
                        <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Smart Search</h3>
                    <p class="text-text-secondary leading-relaxed">Advanced filters to help you find exactly what you're looking for in minutes.</p>
                </div>
                <div class="text-center group bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary/10 rounded-full mb-8 group-hover:bg-primary/20 transition-colors duration-300">
                        <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Secure Transactions</h3>
                    <p class="text-text-secondary leading-relaxed">Your safety is our priority. All transactions are secure and verified.</p>
                </div>
                <div class="text-center group bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary/10 rounded-full mb-8 group-hover:bg-primary/20 transition-colors duration-300">
                        <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Expert Agents</h3>
                    <p class="text-text-secondary leading-relaxed">Work with experienced real estate professionals every step of the way.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-20 bg-cover bg-center bg-no-repeat relative overflow-hidden" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
        <!-- Floating decorative elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-primary/20 rounded-full blur-lg animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-secondary/30 rounded-full blur-md animate-float"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="mb-12">
                <h2 class="text-5xl font-bold text-background mb-6 leading-tight">
                    Ready to Find Your <span class="text-secondary">Dream Home</span>?
                </h2>
                <p class="text-xl text-background/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Join thousands of happy homeowners who found their perfect property with Home Konnect.
                    Start your journey to homeownership today.
                </p>
            </div>

            <!-- Stats section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-background mb-2">1000+</div>
                    <div class="text-background/80 text-sm">Properties Listed</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-background mb-2">500+</div>
                    <div class="text-background/80 text-sm">Happy Clients</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-background mb-2">50+</div>
                    <div class="text-background/80 text-sm">Cities Covered</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-background mb-2">24/7</div>
                    <div class="text-background/80 text-sm">Support Available</div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="/properties"
                    class="inline-flex items-center px-8 py-4 bg-primary text-background font-semibold rounded-xl hover:bg-primary/90 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 text-lg">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Browse Properties
                </a>
                <a href="/login"
                    class="inline-flex items-center px-8 py-4 bg-white/20 backdrop-blur-sm text-background font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 border border-white/30 text-lg">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Get Started
                </a>
            </div>
        </div>
    </section>
@endsection
