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
                    <a href="/" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('home') || request()->is('/') ? 'text-primary border-b-2 border-primary pb-1' : '' }}">Home</a>
                    <a href="/properties" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->routeIs('properties') ? 'text-primary border-b-2 border-primary pb-1' : '' }}">Properties</a>
                    <a href="/about" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->is('about') ? 'text-primary border-b-2 border-primary pb-1' : '' }}">About</a>
                    <a href="/contact" class="text-white hover:text-primary font-medium transition drop-shadow-sm {{ request()->is('contact') ? 'text-primary border-b-2 border-primary pb-1' : '' }}">Contact</a>

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
                    <div x-show="open" x-transition @click.away="open = false" class="fixed inset-0 z-[10000] md:hidden">
                        <!-- Backdrop -->
                        <div class="absolute inset-0 bg-black/95"></div>

                        <!-- Menu Panel -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="absolute right-0 top-0 h-full w-80 bg-background border-l border-border shadow-2xl">
                            <div class="flex flex-col h-full">
                                <!-- Header -->
                                <div class="flex items-center justify-between p-6 border-b border-border">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        <span class="text-lg font-bold text-text-primary">Home<span class="text-primary">Konnect</span></span>
                                    </div>
                                    <button @click="open = false" class="p-2 text-text-secondary hover:text-text-primary hover:bg-secondary rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Navigation Links -->
                                <div class="flex-1 px-6 py-6">
                                    <nav class="space-y-2">
                                        <a href="/" @click="open = false" class="block px-4 py-3 text-text-primary hover:bg-primary hover:text-background rounded-lg font-medium transition-all {{ request()->routeIs('home') || request()->is('/') ? 'bg-primary text-background' : '' }}">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                <span>Home</span>
                                            </div>
                                        </a>
                                        <a href="/properties" @click="open = false" class="block px-4 py-3 text-text-primary hover:bg-primary hover:text-background rounded-lg font-medium transition-all {{ request()->routeIs('properties') ? 'bg-primary text-background' : '' }}">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span>Properties</span>
                                            </div>
                                        </a>
                                        <a href="/about" @click="open = false" class="block px-4 py-3 text-text-primary hover:bg-primary hover:text-background rounded-lg font-medium transition-all {{ request()->is('about') ? 'bg-primary text-background' : '' }}">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>About</span>
                                            </div>
                                        </a>
                                        <a href="/contact" @click="open = false" class="block px-4 py-3 text-text-primary hover:bg-primary hover:text-background rounded-lg font-medium transition-all {{ request()->is('contact') ? 'bg-primary text-background' : '' }}">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>Contact</span>
                                            </div>
                                        </a>
                                    </nav>

                                    <!-- User Section -->
                                    <div class="mt-8 pt-6 border-t border-border">
                                        @auth
                                            <div class="space-y-4">
                                                <div class="px-4">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                                            <span class="text-background font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-semibold text-text-primary">{{ auth()->user()->name }}</p>
                                                            <p class="text-xs text-text-secondary capitalize">{{ auth()->user()->role ?? 'User' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="space-y-2">
                                                    <a href="{{ route('dashboard') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-text-primary hover:bg-secondary rounded-lg font-medium transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                        </svg>
                                                        <span>Dashboard</span>
                                                    </a>
                                                    <a href="{{ route('profile.edit') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-text-primary hover:bg-secondary rounded-lg font-medium transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        <span>Profile</span>
                                                    </a>
                                                    <hr class="border-border my-3">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 text-danger hover:bg-danger/10 rounded-lg font-medium transition-all">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                            </svg>
                                                            <span>Sign Out</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <a href="/login" @click="open = false" class="flex items-center justify-center space-x-3 w-full px-4 py-4 bg-primary text-background rounded-lg font-semibold hover:bg-primary/90 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                                </svg>
                                                <span>Sign In</span>
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