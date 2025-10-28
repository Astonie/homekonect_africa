@props(['title' => 'Dashboard', 'subtitle' => '', 'role' => 'user'])

@php
    $userRole = (string) $role;
    $roleColors = [
        'admin' => ['from' => 'from-purple-500', 'to' => 'to-blue-700', 'text' => 'Admin Panel'],
        'landlord' => ['from' => 'from-blue-500', 'to' => 'to-blue-700', 'text' => 'Landlord Portal'],
        'tenant' => ['from' => 'from-green-500', 'to' => 'to-green-700', 'text' => 'Tenant Portal'],
        'agent' => ['from' => 'from-orange-500', 'to' => 'to-orange-700', 'text' => 'Agent Portal'],
        'user' => ['from' => 'from-gray-500', 'to' => 'to-gray-700', 'text' => 'User Portal'],
    ];
    
    $roleConfig = $roleColors[$userRole] ?? $roleColors['user'];
    $initial = strtoupper(substr($roleConfig['text'], 0, 1));
@endphp

@extends('layouts.dashboard')

@section('content')
<div class="flex h-screen bg-gray-50" 
     x-data="{ 
         sidebarOpen: true, 
         showNotifications: false, 
         userMenuOpen: false,
         currentTime: new Date().toLocaleTimeString() 
     }" 
     x-init="setInterval(() => currentTime = new Date().toLocaleTimeString(), 1000)">
    
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex-shrink-0 transition-all duration-300 ease-in-out shadow-2xl">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="p-6">
                <!-- Expanded Logo -->
                <div class="flex items-center space-x-3 mb-8" x-show="sidebarOpen" x-transition>
                    <x-logo size="default" class="flex-shrink-0" />
                    <div>
                        <div class="text-lg font-bold">HomeKonnect</div>
                        <div class="text-xs text-gray-400">{{ $roleConfig['text'] }}</div>
                    </div>
                </div>

                <!-- Collapsed Logo -->
                <div class="flex justify-center mb-8" x-show="!sidebarOpen" x-transition x-cloak>
                    <x-logo size="default" class="flex-shrink-0" />
                </div>

                <!-- Navigation Slot -->
                <nav class="space-y-2">
                    {{ $navigation }}
                </nav>
            </div>

            <!-- Collapse Button -->
            <div class="p-4 border-t border-gray-700 mt-auto">
                <button @click="sidebarOpen = !sidebarOpen" class="w-full flex items-center justify-center px-4 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 transition">
                    <svg :class="!sidebarOpen && 'rotate-180'" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-100 rounded-lg transition-all duration-200 transform hover:scale-110">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div>
                        @if(isset($breadcrumbs))
                            {{ $breadcrumbs }}
                        @else
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span class="font-medium">{{ strtoupper($roleConfig['text']) }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>{{ $title }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Header Actions Slot -->
                    @if(isset($headerActions))
                        {{ $headerActions }}
                    @endif

                    <!-- Notifications Slot -->
                    @if(isset($notifications))
                        {{ $notifications }}
                    @endif

                    <!-- Theme Toggle -->
                    <button class="p-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-600 transform hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg px-3 py-2 transition">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br {{ $roleConfig['from'] }} {{ $roleConfig['to'] }} rounded-full flex items-center justify-center shadow-lg transform transition hover:scale-110">
                                <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <svg :class="userMenuOpen && 'rotate-180'" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Profile Dropdown -->
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    My Profile
                                </a>
                            </div>
                            <div class="border-t border-gray-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 px-8 py-6">
            <!-- Page Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="text-gray-600 mt-1">{{ $subtitle }}</p>
                    @endif
                </div>
                @if(!isset($headerActions))
                    <div class="flex items-center space-x-2 bg-white px-4 py-3 rounded-lg shadow-sm border border-gray-200">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">Current Time</div>
                            <div class="text-lg font-bold text-gray-900" x-text="currentTime"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Main Content Slot -->
            {{ $slot }}
        </main>
    </div>
</div>
@endsection
