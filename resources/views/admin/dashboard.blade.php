<x-app-dashboard 
    title="Admin Dashboard" 
    subtitle="Welcome back, {{ Auth::user()->name }}! Monitor and manage your platform.">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.admin active="dashboard" />
    </x-slot>

    {{-- Main Content --}}
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Total Users</div>
                    <div class="text-3xl font-bold">{{ number_format($stats['total_users']) }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span>View all users</span>
            </div>
        </div>

        <!-- Total Properties Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Total Properties</div>
                    <div class="text-3xl font-bold">{{ number_format($stats['total_properties']) }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <a href="{{ route('admin.properties.index') }}" class="hover:underline flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>View all properties</span>
                </a>
            </div>
        </div>

        <!-- Active Listings Card -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Active Listings</div>
                    <div class="text-3xl font-bold">{{ number_format($stats['active_listings']) }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                <span>Available for rent</span>
            </div>
        </div>

        <!-- Pending KYC Card -->
        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Pending KYC</div>
                    <div class="text-3xl font-bold">{{ number_format($stats['pending_kyc']) }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <a href="{{ route('admin.kyc.index') }}" class="hover:underline flex items-center">
                    @if($stats['pending_kyc'] > 0)
                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-ping"></span>
                    @endif
                    <span>Review now →</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            Quick Actions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.properties.index') }}" class="flex items-center justify-center space-x-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-md hover:shadow-lg transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="font-semibold">View Properties</span>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center space-x-3 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-lg hover:from-green-700 hover:to-green-800 transition shadow-md hover:shadow-lg transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="font-semibold">Manage Users</span>
            </a>

            <a href="{{ route('admin.kyc.index') }}" class="flex items-center justify-center space-x-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-6 py-4 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition shadow-md hover:shadow-lg transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="font-semibold">Review KYC</span>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center space-x-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4 rounded-lg hover:from-purple-700 hover:to-purple-800 transition shadow-md hover:shadow-lg transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="font-semibold">Analytics</span>
            </a>
        </div>
    </div>

    @if($recent_properties->count() > 0)
        <!-- Recent Properties -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Recent Properties
            </h3>
                <a href="{{ route('admin.properties.index') }}" class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-semibold flex items-center group">
                View All
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @if($recent_properties->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                            <tr class="border-b-2 border-gray-200 dark:border-gray-700">
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Property</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Owner</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Type</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Price</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-700 dark:text-gray-400 uppercase tracking-wider">Date Added</th>
                        </tr>
                    </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($recent_properties as $property)
                                <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200 group">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        @if(!empty($property->images) && isset($property->images[0]))
                                            @php
                                                $imageData = $property->images[0];
                                                // Extract path from array or use string directly
                                                $imagePath = is_array($imageData) ? ($imageData['path'] ?? '') : $imageData;
                                                
                                                // Handle different image path formats
                                                if (empty($imagePath)) {
                                                    $imageUrl = null;
                                                } elseif (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                    $imageUrl = $imagePath;
                                                } elseif (Str::startsWith($imagePath, 'http')) {
                                                    $imageUrl = $imagePath;
                                                } elseif (Str::startsWith($imagePath, 'uploads/')) {
                                                    $imageUrl = asset($imagePath);
                                                } else {
                                                    $imageUrl = Storage::url($imagePath);
                                                }
                                            @endphp
                                            @if($imageUrl)
                                            <div class="relative flex-shrink-0">
                                                <img src="{{ $imageUrl }}" alt="{{ $property->name ?? $property->title }}" class="w-14 h-14 rounded-xl object-cover shadow-md group-hover:shadow-lg transition" onerror="this.parentElement.innerHTML='<div class=\'w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md\'><svg class=\'w-7 h-7 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                                            </div>
                                            @else
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
                                                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            @endif
                                        @else
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
                                                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                            <span class="font-semibold text-gray-900 dark:text-white group-hover:text-purple-700 dark:group-hover:text-purple-400 transition">{{ $property->name ?? $property->title }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center text-white font-bold text-xs mr-2">
                                            {{ strtoupper(substr($property->owner->name, 0, 1)) }}
                                        </div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $property->owner->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm">
                                        {{ $property->type }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                        <span class="text-base font-bold text-gray-900 dark:text-white">${{ number_format($property->rent_amount, 2) }}</span>
                                    <span class="text-xs text-gray-500 ml-1">/mo</span>
                                </td>
                                <td class="py-4 px-4">
                                    @if($property->status == 'available')
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-sm flex items-center w-fit">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                                            Available
                                        </span>
                                    @else
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-sm">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    @endif
                                </td>
                                    <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-400 font-medium">
                                    {{ $property->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">No properties found</p>
                <p class="mt-2 text-sm text-gray-500">Properties added by landlords will appear here</p>
            </div>
        @endif
    </div>
    @endif

    <!-- Pending KYC Verifications -->
    @if($pending_kyc->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Pending KYC Verifications
                <span class="ml-3 px-2.5 py-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold rounded-full shadow-sm animate-pulse">
                    {{ $pending_kyc->count() }} pending
                </span>
            </h3>
            <a href="{{ route('admin.kyc.index') }}" class="text-sm text-orange-600 hover:text-orange-700 font-semibold flex items-center group">
                View All
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($pending_kyc as $kyc)
                <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-xl p-5 border-2 border-orange-200 hover:border-orange-300 hover:shadow-lg transition-all duration-200 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 group-hover:text-orange-700 transition">{{ $kyc->user->name }}</div>
                                <div class="text-xs text-gray-600 flex items-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $kyc->user->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 space-y-2">
                        <div class="flex items-center text-xs text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                            <span class="font-semibold">ID Type:</span>
                            <span class="ml-1">{{ ucfirst($kyc->document_type) }}</span>
                        </div>
                        <div class="flex items-center text-xs text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">Submitted:</span>
                            <span class="ml-1">{{ $kyc->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.kyc.show', $kyc->id) }}" class="block w-full bg-gradient-to-r from-orange-600 to-red-600 text-white text-center py-2.5 rounded-lg font-semibold hover:from-orange-700 hover:to-red-700 transition shadow-md hover:shadow-lg transform group-hover:scale-105">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Review Now
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            KYC Verifications
        </h3>
        <div class="text-center py-12">
            <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-900 dark:to-emerald-900 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-400 font-medium text-lg">All caught up!</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">No pending KYC verifications at the moment.</p>
        </div>
    </div>
    @endif
</x-app-dashboard>
