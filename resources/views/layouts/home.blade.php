<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'HomeKonnect'))</title>
    <meta name="description" content="@yield('meta_description', 'Find your dream home with HomeKonnect')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Initialize theme before page loads to prevent flash
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @stack('styles')
</head>
<body class="m-0 p-0 font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300" @yield('body_attributes')>
    
    @hasSection('navigation')
        @yield('navigation')
    @else
        <!-- Modern Navigation with Alpine.js -->
        <div x-data="{ mobileMenuOpen: false, scrolled: false }" 
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             class="fixed top-0 left-0 right-0 z-50">
            <nav class="w-full transition-all duration-300"
                 :class="scrolled ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg shadow-lg border-b border-gray-200 dark:border-gray-800' : 'bg-white dark:bg-gray-900 shadow-md'">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-20">
                        <!-- Logo Section -->
                        <div class="flex items-center space-x-3 z-50">
                            <a href="/" class="flex items-center space-x-3 group">
                                <div class="relative">
                                    <x-logo size="default" 
                                            class="text-blue-600 dark:text-blue-500 transition-colors duration-300" />
                                    <div class="absolute inset-0 bg-blue-500/20 blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white transition-colors duration-300">
                                        HomeKonnect
                                    </span>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 transition-colors duration-300">
                                        Africa's Trusted Real Estate
                                    </span>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Desktop Navigation Links -->
                        <div class="hidden lg:flex items-center space-x-1">
                            <a href="/" 
                               class="px-4 py-2 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 relative group">
                                Home
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('properties.index') }}" 
                               class="px-4 py-2 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 relative group">
                                Find Properties
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('contact.show') }}" 
                               class="px-4 py-2 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 relative group">
                                Contact
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </div>

                        <!-- Right Side: Theme Toggle & Auth Buttons -->
                        <div class="hidden lg:flex items-center space-x-3">
                            <!-- Theme Toggle Button -->
                            <button id="theme-toggle" type="button" 
                                    class="p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 hover:scale-110">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            
                            @auth
                                <a href="{{ route('dashboard') }}" 
                                   class="px-5 py-2.5 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 hover:scale-105">
                                    Dashboard
                                </a>
                            @else
                                <!-- Sign In Button -->
                                <a href="{{ route('login') }}" 
                                   class="px-5 py-2.5 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 hover:scale-105">
                                    Sign in
                                </a>
                                
                                <!-- Get Started Button -->
                                <a href="{{ route('register') }}" 
                                   class="px-6 py-2.5 rounded-lg font-semibold text-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all duration-200 hover:scale-105 flex items-center space-x-2">
                                    <span>Get Started</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endauth
                        </div>

                        <!-- Mobile Menu Button -->
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="lg:hidden p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 z-50">
                            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileMenuOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-4"
                     @click.away="mobileMenuOpen = false"
                     class="lg:hidden absolute top-full left-0 right-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-xl">
                    <div class="px-4 py-6 space-y-1 max-w-7xl mx-auto">
                        <a href="/" 
                           @click="mobileMenuOpen = false"
                           class="block px-4 py-3 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors duration-200">
                            Home
                        </a>
                        <a href="{{ route('properties.index') }}" 
                           @click="mobileMenuOpen = false"
                           class="block px-4 py-3 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors duration-200">
                            Find Properties
                        </a>
                        <a href="{{ route('contact.show') }}" 
                           @click="mobileMenuOpen = false"
                           class="block px-4 py-3 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors duration-200">
                            Contact
                        </a>
                        
                        <div class="pt-4 space-y-2 border-t border-gray-200 dark:border-gray-800">
                            @auth
                                <a href="{{ route('dashboard') }}" 
                                   @click="mobileMenuOpen = false"
                                   class="block px-4 py-3 rounded-lg text-center text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg transition-all duration-200">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   @click="mobileMenuOpen = false"
                                   class="block px-4 py-3 rounded-lg text-center text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold transition-colors duration-200">
                                    Sign in
                                </a>
                                <a href="{{ route('register') }}" 
                                   @click="mobileMenuOpen = false"
                                   class="block px-4 py-3 rounded-lg text-center text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg transition-all duration-200">
                                    Get Started
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    @endif

    <!-- Main Content -->
    <main class="@yield('main_classes', 'pt-20')">
        @yield('content')
    </main>

    <!-- Footer -->
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
                        <li><a href="/" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Home</a></li>
                        <li><a href="{{ route('properties.index') }}" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Properties</a></li>
                        <li><a href="{{ route('contact.show') }}" class="hover:text-blue-400 dark:hover:text-blue-300 transition">Contact</a></li>
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
                        <li>📧 {{ $siteSettings['contact_email'] ?? 'info@homekonnect.com' }}</li>
                        @if(!empty($siteSettings['contact_phone']))
                        <li>📞 {{ $siteSettings['contact_phone'] }}</li>
                        @endif
                        @if(!empty($siteSettings['contact_address']))
                        <li>📍 {{ $siteSettings['contact_address'] }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Theme Toggle Script -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        if (themeToggleBtn) {
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            // Show the correct icon based on the current theme
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
            } else {
                if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                // Toggle icons
                if (themeToggleDarkIcon) themeToggleDarkIcon.classList.toggle('hidden');
                if (themeToggleLightIcon) themeToggleLightIcon.classList.toggle('hidden');

                // Toggle theme
                if (localStorage.theme === 'dark') {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
