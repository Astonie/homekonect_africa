<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }" x-init="sidebarOpen = localStorage.getItem('sidebarOpen') === 'true' || localStorage.getItem('sidebarOpen') === null">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Theme initialization script -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside 
                x-data="{ 
                    sidebarOpen: $persist(true).as('sidebarOpen'),
                    unreadMessages: {{ auth()->user()->unreadMessagesCount() ?? 0 }}
                }"
                :class="sidebarOpen ? 'w-64' : 'w-20'" 
                class="bg-gray-900 dark:bg-gray-950 text-white transition-all duration-300 ease-in-out flex flex-col border-r border-gray-800 dark:border-gray-700 fixed h-screen z-30"
            >
                <!-- Logo & Toggle -->
                <div class="p-4 flex items-center justify-between border-b border-gray-800 dark:border-gray-700">
                    <a href="/" class="flex items-center space-x-2 overflow-hidden">
                        <x-logo size="sm" class="text-white flex-shrink-0" />
                        <span x-show="sidebarOpen" x-transition class="text-xl font-bold whitespace-nowrap">
                            Home<span class="text-blue-400">Konnect</span>
                        </span>
                    </a>
                    <button 
                        @click="sidebarOpen = !sidebarOpen; localStorage.setItem('sidebarOpen', sidebarOpen)" 
                        class="p-2 rounded-lg hover:bg-gray-800 transition-colors ml-2 flex-shrink-0"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- User Info -->
                <div class="p-4 border-b border-gray-800 dark:border-gray-700">
                    <div class="flex items-center" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div x-show="sidebarOpen" x-transition class="overflow-hidden">
                            <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                    @yield('navigation')
                </nav>

                <!-- Theme Toggle & Logout -->
                <div class="p-4 border-t border-gray-800 dark:border-gray-700 space-y-2">
                    <!-- Theme Toggle -->
                    <button 
                        @click="
                            if (localStorage.theme === 'dark') {
                                localStorage.theme = 'light';
                                document.documentElement.classList.remove('dark');
                            } else {
                                localStorage.theme = 'dark';
                                document.documentElement.classList.add('dark');
                            }
                        "
                        class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200"
                        :class="sidebarOpen ? 'space-x-3' : 'justify-center'"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Dark Mode</span>
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300 ease-in-out">
                <!-- Top Bar -->
                <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $header ?? 'Dashboard' }}
                            </h1>
                            
                            <div class="flex items-center space-x-4">
                                <!-- Notifications -->
                                <button class="relative p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>

        @stack('scripts')
    </body>
</html>
