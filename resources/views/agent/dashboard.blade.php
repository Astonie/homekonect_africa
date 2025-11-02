<x-app-dashboard 
    title="Agent Dashboard" 
    subtitle="Manage your clients, listings, and grow your real estate business."
    role="agent">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.agent active="dashboard" />
    </x-slot>

    {{-- Main Content --}}
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Active Clients</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>

        <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-green-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Properties Listed</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>

        <div class="bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Deals Closed</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>

        <div class="bg-gradient-to-br from-white to-yellow-50 dark:from-gray-800 dark:to-yellow-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Commission</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">$0</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="#" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Add Client</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">New client</p>
                </div>
            </a>

            <a href="{{ route('agent.properties.create') }}" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">List Property</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Add listing</p>
                </div>
            </a>

            <a href="{{ route('agent.properties.index') }}" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">My Properties</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">View all listings</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity & Appointments -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Upcoming Appointments</h3>
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p>No appointments scheduled</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Leads</h3>
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p>No leads yet</p>
            </div>
        </div>
    </div>
</x-app-dashboard>
