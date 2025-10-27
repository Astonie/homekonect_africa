<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Konnect - Find Your Dream Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head><body class="font-sans antialiased bg-gray-50">
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="text-2xl font-bold text-gray-900">Home<span class="text-blue-600">Konnect</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#properties" class="text-gray-700 hover:text-blue-600 font-medium transition">Properties</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium transition">About</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
                </div>
            </div>
        </div>
    </nav>
    <section class="pt-24 pb-16 bg-linear-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-block">
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">🏡 Your Dream Home Awaits</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        Find Your Perfect <span class="text-blue-600">Home</span> With Ease
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Discover thousands of properties, connect with trusted agents, and find your dream home in the perfect location.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#properties" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition font-semibold text-center shadow-lg hover:shadow-xl">Browse Properties</a>
                        <a href="#contact" class="bg-white text-gray-700 px-8 py-4 rounded-lg hover:bg-gray-50 transition font-semibold text-center border-2 border-gray-200">Contact Us</a>
                    </div>
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">1000+</div>
                            <div class="text-sm text-gray-600">Properties</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">500+</div>
                            <div class="text-sm text-gray-600">Happy Clients</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">50+</div>
                            <div class="text-sm text-gray-600">Cities</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-linear-to-r from-blue-600 to-purple-600 rounded-2xl shadow-2xl p-8 md:p-12">
                <h2 class="text-3xl font-bold text-white mb-8 text-center">Find Your Dream Home</h2>
                <div class="grid md:grid-cols-4 gap-4">
                    <input type="text" placeholder="Location" class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white text-gray-900">
                    <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white text-gray-900">
                        <option>Property Type</option>
                        <option>House</option>
                        <option>Apartment</option>
                    </select>
                    <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white text-gray-900">
                        <option>Price Range</option>
                        <option>$0 - $200k</option>
                        <option>$500k - $1M</option>
                    </select>
                    <button class="bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-bold shadow-lg">Search</button>
                </div>
            </div>
        </div>
    </section>

    <section id="properties" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Properties</h2>
                <p class="text-xl text-gray-600">Handpicked properties just for you</p>
            </div>
            
            @if($properties->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($properties as $property)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $property->first_image }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                @if($property->is_featured)
                                    <span class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                                @endif
                                <span class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ ucfirst($property->listing_type) }}
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-500">{{ ucfirst($property->type) }}</span>
                                    <span class="text-2xl font-bold text-blue-600">{{ $property->formatted_price }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $property->title }}</h3>
                                <p class="text-gray-600 mb-4">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->city }}, {{ $property->state }}
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-600 border-t pt-4">
                                    <span>🛏️ {{ $property->bedrooms }} Beds</span>
                                    <span>🚿 {{ $property->bathrooms }} Baths</span>
                                    <span>📏 {{ number_format($property->square_feet) }} sqft</span>
                                </div>
                                <div class="mt-4 pt-4 border-t">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                                <span class="text-blue-600 font-semibold">{{ substr($property->owner->name, 0, 1) }}</span>
                                            </div>
                                            <span>{{ $property->owner->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="/login" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                        View All Properties
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Properties Available</h3>
                    <p class="text-gray-600">Check back soon for new listings!</p>
                </div>
            @endif
        </div>
    </section>
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Home Konnect?</h2>
                <p class="text-xl text-gray-600">Your trusted partner in finding the perfect home</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Smart Search</h3>
                    <p class="text-gray-600">Advanced filters to help you find exactly what you're looking for in minutes.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Transactions</h3>
                    <p class="text-gray-600">Your safety is our priority. All transactions are secure and verified.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Expert Agents</h3>
                    <p class="text-gray-600">Work with experienced real estate professionals every step of the way.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-20 bg-linear-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Find Your Dream Home?</h2>
            <p class="text-xl text-blue-100 mb-8">Join thousands of happy homeowners who found their perfect property with Home Konnect</p>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-xl font-bold text-white">Home<span class="text-blue-500">Konnect</span></span>
                    </div>
                    <p class="text-sm">Your trusted partner in finding the perfect home.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-blue-400 transition">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Properties</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Agents</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-blue-400 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-sm">
                        <li> info@homekonnect.com</li>
                        <li> +1 (555) 123-4567</li>
                        <li> 123 Real Estate Ave, NY</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm">
                <p>&copy; 2025 Home Konnect. All rights reserved. Built with Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>
</body>
</html>
