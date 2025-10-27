<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home Konnect')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav class="fixed w-full bg-black/20 backdrop-blur-sm shadow-sm z-50 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="text-2xl font-bold text-white drop-shadow-lg">Home<span class="text-primary">Konnect</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('home') || request()->is('/') ? 'text-primary' : '' }}">Home</a>
                    <a href="/properties" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('properties') ? 'text-primary' : '' }}">Properties</a>
                    <a href="/about" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('about') ? 'text-primary' : '' }}">About</a>
                    <a href="/contact" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('contact') ? 'text-primary' : '' }}">Contact</a>

                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-white hover:text-primary font-medium transition drop-shadow-sm">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                    <span class="text-background font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-background rounded-lg shadow-lg border border-border z-50">
                                <div class="py-1">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-text-primary hover:bg-secondary hover:text-text-primary transition">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-text-primary hover:bg-secondary hover:text-text-primary transition">
                                        Profile
                                    </a>
                                    <hr class="border-border my-1">
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="text-white hover:text-primary font-medium transition drop-shadow-sm">Sign In</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 text-white hover:text-primary transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Mobile Menu Overlay -->
                    <div x-show="open" x-transition @click.away="open = false" class="fixed inset-0 z-[9999] md:hidden bg-black bg-opacity-50">
                        <!-- Menu Panel -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="absolute right-0 top-0 h-full w-64 bg-white shadow-lg">
                            <div class="flex flex-col h-full">
                                <!-- Header -->
                                <div class="flex items-center justify-between p-4 border-b">
                                    <h3 class="text-lg font-bold text-gray-900">Home<span class="text-blue-600">Konnect</span></h3>
                                    <button @click="open = false" class="p-2 text-gray-500 hover:text-gray-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Navigation Links -->
                                <div class="flex-1 px-4 py-6">
                                    <nav class="space-y-4">
                                        <a href="/" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded {{ request()->routeIs('home') || request()->is('/') ? 'bg-blue-50 text-blue-600' : '' }}">
                                            Home
                                        </a>
                                        <a href="/properties" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded {{ request()->routeIs('properties') ? 'bg-blue-50 text-blue-600' : '' }}">
                                            Properties
                                        </a>
                                        <a href="/about" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : '' }}">
                                            About
                                        </a>
                                        <a href="/contact" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600' : '' }}">
                                            Contact
                                        </a>
                                    </nav>

                                    <!-- User Section -->
                                    <div class="mt-8 pt-6 border-t">
                                        @auth
                                            <div class="space-y-4">
                                                <div class="px-4">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                                            <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role ?? 'User' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="space-y-2">
                                                    <a href="{{ route('dashboard') }}" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded">
                                                        Dashboard
                                                    </a>
                                                    <a href="{{ route('profile.edit') }}" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded">
                                                        Profile
                                                    </a>
                                                    <hr class="my-2">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                                                            Sign Out
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <a href="/login" @click="open = false" class="block px-4 py-3 bg-blue-600 text-white text-center rounded hover:bg-blue-700">
                                                Sign In
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-background-dark text-text-inverted py-12 border-t border-border-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-xl font-bold text-text-inverted">Home<span class="text-primary">Konnect</span></span>
                    </div>
                    <p class="text-sm text-text-dark-secondary">Your trusted partner in finding the perfect home.</p>
                </div>
                <div>
                    <h4 class="text-text-inverted font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-text-dark-secondary">
                        <li><a href="/about" class="hover:text-primary transition">About Us</a></li>
                        <li><a href="/properties" class="hover:text-primary transition">Properties</a></li>
                        <li><a href="#" class="hover:text-primary transition">Agents</a></li>
                        <li><a href="/contact" class="hover:text-primary transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-text-inverted font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-text-dark-secondary">
                        <li><a href="#" class="hover:text-primary transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-primary transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-primary transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-primary transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-text-inverted font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-sm text-text-dark-secondary">
                        <li> info@homekonnect.com</li>
                        <li> +1 (555) 123-4567</li>
                        <li> 123 Real Estate Ave, NY</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>