<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <!-- Using Unsplash property image as background -->
                <div class="absolute inset-0 bg-gradient-to-br from-black/40 via-black/30 to-black/40 z-10"></div>
                <img 
                    src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2075&q=80" 
                    alt="Modern Property Background" 
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Content Container -->
            <div class="relative z-20 w-full sm:max-w-md px-6">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <a href="/" class="block">
                        <div class="bg-white/95 backdrop-blur-sm p-4 rounded-2xl shadow-2xl border border-white/20 transform transition hover:scale-105">
                            <x-application-logo class="w-20 h-20 fill-current text-brand-600" />
                        </div>
                    </a>
                </div>

                <!-- Brand Name -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-white drop-shadow-lg">HomeKonnectAfrica</h1>
                    <p class="text-gray-200 text-sm mt-1">Connecting You to Your Dream Property</p>
                </div>

                <!-- Card Container -->
                <div class="bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-white/20">
                    <div class="px-6 py-8">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center">
                    <p class="text-white/80 text-sm">
                        © {{ date('Y') }} HomeKonnectAfrica. All rights reserved.
                    </p>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 right-20 w-24 h-24 bg-white/5 rounded-full blur-2xl"></div>
            </div>
        </div>
    </body>
</html>
