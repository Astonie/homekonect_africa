<x-app-dashboard 
    title="Landlord Dashboard" 
    subtitle="Welcome back, {{ Auth::user()->name }}! Manage your properties and rental income."
    role="landlord">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.landlord active="dashboard" />
    </x-slot>

    {{-- Main Content --}}
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Properties -->
        <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-green-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/50 px-2 py-1 rounded-full">Total</span>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Properties</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] ?? 0 }}</div>
            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span>All your listings</span>
            </div>
        </div>

        <!-- Available -->
        <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/50 px-2 py-1 rounded-full">Available</span>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Available</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['available'] ?? 0 }}</div>
            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <span>Ready to rent</span>
            </div>
        </div>

        <!-- Rented -->
        <div class="bg-gradient-to-br from-white to-yellow-50 dark:from-gray-800 dark:to-yellow-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900/50 px-2 py-1 rounded-full">Occupied</span>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Rented</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['rented'] ?? 0 }}</div>
            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <span>Currently occupied</span>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/50 px-2 py-1 rounded-full">Pending</span>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pending</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['pending'] ?? 0 }}</div>
            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <span>Under review</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('landlord.properties.create') }}" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Add Property</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">List new property</p>
                </div>
            </a>

            <a href="{{ route('landlord.properties.index') }}" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">View Properties</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage listings</p>
                </div>
            </a>

            <a href="#" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">View Reports</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Analytics & insights</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
        <div class="space-y-4">
            <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">New property listed</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</p>
                </div>
            </div>

            <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Application received</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">5 hours ago</p>
                </div>
            </div>

            <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Payment received</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">1 day ago</p>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
