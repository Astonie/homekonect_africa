<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenant Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Find your dream home with Home Konnect. Browse properties and connect with agents.</p>
            </div>

            <!-- Search Section -->
            <div class="bg-linear-to-r from-blue-600 to-purple-600 rounded-xl shadow-xl p-8 mb-6">
                <h3 class="text-2xl font-bold text-white mb-6">Search Properties</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" placeholder="Location" class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                    <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option>Property Type</option>
                        <option>Apartment</option>
                        <option>House</option>
                        <option>Condo</option>
                    </select>
                    <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option>Price Range</option>
                        <option>$500 - $1000/mo</option>
                        <option>$1000 - $2000/mo</option>
                        <option>$2000+/mo</option>
                    </select>
                    <button class="bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-bold">Search</button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Saved Properties</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Applications</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Messages</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="#" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Browse Properties</p>
                            <p class="text-sm text-gray-600">Find your perfect home</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                        <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Saved Properties</p>
                            <p class="text-sm text-gray-600">View your favorites</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                        <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Messages</p>
                            <p class="text-sm text-gray-600">Chat with agents</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
