<x-app-dashboard 
    title="Tenant Dashboard" 
    subtitle="Find your dream home with Home Konnect. Browse properties and connect with agents."
    role="tenant">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.tenant active="dashboard" />
    </x-slot>

    {{-- Profile Links --}}
    <!-- Search Section -->
    <div class="bg-gradient-to-r from-green-600 to-teal-600 dark:from-green-700 dark:to-teal-700 rounded-xl shadow-xl p-8 mb-8">
        <h3 class="text-2xl font-bold text-white mb-6">Search Properties</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" placeholder="Location" class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
            <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white dark:bg-gray-700 dark:text-white">
                <option>Property Type</option>
                <option>Apartment</option>
                <option>House</option>
                <option>Condo</option>
            </select>
            <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white dark:bg-gray-700 dark:text-white">
                <option>Price Range</option>
                <option>$500 - $1000/mo</option>
                <option>$1000 - $2000/mo</option>
                <option>$2000+/mo</option>
            </select>
            <button class="bg-white text-green-600 px-6 py-3 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700 transition font-bold">Search</button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-white to-red-50 dark:from-gray-800 dark:to-red-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Saved Properties</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>

        <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Applications</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>

        <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-green-900/20 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Messages</div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="#" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Browse Properties</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Find your perfect home</p>
                </div>
            </a>

            <a href="#" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Saved Properties</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">View your favorites</p>
                </div>
            </a>

            <a href="#" class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Messages</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Chat with agents</p>
                </div>
            </a>
        </div>
    </div>
</x-app-dashboard>
