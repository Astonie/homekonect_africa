<x-app-dashboard 
    title="Conversation" 
    subtitle="Chat with {{ $otherUser->name }} about {{ $conversation->property->title }}">
    
    {{-- Navigation Slot - Dynamic based on user role --}}
    <x-slot name="navigation">
        @if(Auth::user()->role === 'admin')
            {{-- Admin Navigation --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Dashboard</span>
            </a>

            <div class="relative" x-data="{ usersMenuOpen: false }">
                <button @click="usersMenuOpen = !usersMenuOpen" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'justify-between space-x-3' : 'justify-center'">
                    <div class="flex items-center" :class="sidebarOpen && 'space-x-3'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Users</span>
                    </div>
                    <svg x-show="sidebarOpen" x-transition x-cloak :class="usersMenuOpen && 'rotate-180'" class="w-4 h-4 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="usersMenuOpen && sidebarOpen" x-transition x-cloak class="ml-11 mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">All Users</a>
                    <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Landlords</a>
                    <a href="{{ route('admin.users.index', ['role' => 'agent']) }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Agents</a>
                    <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Tenants</a>
                </div>
            </div>

            <a href="{{ route('admin.properties.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Properties</span>
            </a>

            <a href="{{ route('messages.index') }}" class="flex items-center px-4 py-3 bg-gray-800 rounded-lg text-blue-400 transition-all duration-200 hover:bg-gray-700 transform hover:scale-105 relative" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Messages</span>
                @if(Auth::user()->unreadMessagesCount() > 0)
                <span x-show="sidebarOpen" class="absolute top-2 right-2 w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                <span x-show="!sidebarOpen" class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                @endif
            </a>

            <a href="{{ route('admin.kyc.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105 relative" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">KYC Verifications</span>
            </a>

            <a href="{{ route('admin.team.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Team Members</span>
            </a>

            <a href="{{ route('settings.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Settings</span>
            </a>
        @elseif(Auth::user()->role === 'landlord')
            {{-- Landlord Navigation --}}
            <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Dashboard</span>
            </a>

            <div class="relative" x-data="{ propertyMenuOpen: false }">
                <button @click="propertyMenuOpen = !propertyMenuOpen" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'justify-between space-x-3' : 'justify-center'">
                    <div class="flex items-center" :class="sidebarOpen && 'space-x-3'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">My Properties</span>
                    </div>
                    <svg x-show="sidebarOpen" x-transition x-cloak :class="propertyMenuOpen && 'rotate-180'" class="w-4 h-4 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="propertyMenuOpen && sidebarOpen" x-transition x-cloak class="ml-11 mt-2 space-y-1">
                    <a href="{{ route('landlord.properties.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition transform hover:translate-x-1">All Properties</a>
                    <a href="{{ route('landlord.properties.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition transform hover:translate-x-1">Add New</a>
                </div>
            </div>

            <a href="{{ route('messages.index') }}" class="flex items-center px-4 py-3 bg-gray-800 rounded-lg text-blue-400 transition-all duration-200 hover:bg-gray-700 transform hover:scale-105 relative" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Messages</span>
                @if(Auth::user()->unreadMessagesCount() > 0)
                <span x-show="sidebarOpen" class="absolute top-2 right-2 w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                <span x-show="!sidebarOpen" class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                @endif
            </a>

            <a href="{{ route('landlord.documents.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Documents</span>
            </a>
        @elseif(Auth::user()->role === 'agent')
            {{-- Agent Navigation --}}
            <a href="{{ route('agent.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Dashboard</span>
            </a>

            <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Clients</span>
            </a>

            <div class="relative" x-data="{ propertiesOpen: false }">
                <button @click="propertiesOpen = !propertiesOpen" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'justify-between space-x-3' : 'justify-center'">
                    <div class="flex items-center" :class="sidebarOpen && 'space-x-3'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Properties</span>
                    </div>
                    <svg x-show="sidebarOpen" x-transition x-cloak :class="propertiesOpen && 'rotate-180'" class="w-4 h-4 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="propertiesOpen && sidebarOpen" x-transition x-cloak class="ml-11 mt-2 space-y-1">
                    <a href="{{ route('agent.properties.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">All Properties</a>
                    <a href="{{ route('agent.properties.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Add New</a>
                </div>
            </div>

            <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Appointments</span>
            </a>

            <a href="{{ route('messages.index') }}" class="flex items-center px-4 py-3 bg-gray-800 rounded-lg text-orange-400 transition-all duration-200 hover:bg-gray-700 transform hover:scale-105 relative" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Messages</span>
                @if(Auth::user()->unreadMessagesCount() > 0)
                <span x-show="sidebarOpen" class="absolute top-2 right-2 w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                <span x-show="!sidebarOpen" class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">{{ Auth::user()->unreadMessagesCount() }}</span>
                @endif
            </a>
        @endif
    </x-slot>

    {{-- Main Content --}}
    <div class="h-full">
        <!-- WhatsApp-Style Chat Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
            
            <!-- Property Info Bar - Slim Header -->
            <div class="bg-secondary-100 dark:bg-gray-900 border-b border-light dark:border-gray-700 px-6 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <!-- User Avatar -->
                        <div class="flex-shrink-0 relative">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white font-bold text-xs shadow-md ring-2 ring-white dark:ring-gray-800">
                                {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex-1 min-w-0">
                            <h2 class="text-sm font-bold text-primary dark:text-white truncate">{{ $otherUser->name }}</h2>
                            <p class="text-xs text-muted dark:text-gray-500 flex items-center truncate">
                                <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                {{ $conversation->property->title }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('properties.show', $conversation->property->slug) }}" 
                           class="p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition"
                           title="View Property">
                            <svg class="w-5 h-5 text-primary dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('messages.destroy', $conversation) }}" method="POST" class="inline" onsubmit="return confirm('Delete this conversation? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-danger-50 dark:hover:bg-danger-900/20 rounded-full transition" title="Delete Conversation">
                                <svg class="w-5 h-5 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mx-4 mt-4 bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-700 text-success-700 dark:text-success-300 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Messages Container with WhatsApp-style Background Pattern -->
            <div class="flex-1 overflow-y-auto p-6 bg-soft dark:bg-gray-900" id="messagesContainer" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAgTSAwIDIwIEwgNDAgMjAgTSAyMCAwIEwgMjAgNDAgTSAwIDMwIEwgNDAgMzAgTSAzMCAwIEwgMzAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgwLDAsMCwwLjAyKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+'); background-size: 40px 40px;">
                <div class="space-y-3">
                    @forelse($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} animate-fadeIn">
                            <div class="max-w-[75%] md:max-w-[60%]">
                                <!-- Message Bubble with WhatsApp style -->
                                <div class="relative {{ $message->sender_id === auth()->id() 
                                    ? 'bg-success-100 dark:bg-success-900/30 text-primary dark:text-white rounded-l-2xl rounded-tr-2xl' 
                                    : 'bg-white dark:bg-gray-800 text-primary dark:text-white rounded-r-2xl rounded-tl-2xl shadow-sm' 
                                }} px-4 py-2.5 border {{ $message->sender_id === auth()->id() ? 'border-success-200 dark:border-success-800' : 'border-light dark:border-gray-700' }}">
                                    
                                    @if($message->hasAttachment())
                                        @php
                                            $icon = $message->getFileIcon();
                                            $isImage = $icon === 'image';
                                        @endphp
                                        
                                        @if($isImage)
                                            <!-- Image Preview -->
                                            <a href="{{ route('messages.attachment.download', $message) }}" 
                                               target="_blank"
                                               class="block mb-2 rounded-lg overflow-hidden max-w-xs cursor-pointer group relative">
                                                <img src="{{ asset('storage/' . $message->attachment_path) }}" 
                                                     alt="{{ $message->attachment_name }}"
                                                     class="w-full h-auto rounded-lg border border-gray-200 dark:border-gray-600 group-hover:opacity-90 transition">
                                                <!-- Download overlay on hover -->
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        @else
                                            <!-- File Attachment Display -->
                                            <a href="{{ route('messages.attachment.download', $message) }}" 
                                               class="flex items-center gap-3 p-3 mb-2 bg-white dark:bg-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition border border-gray-200 dark:border-gray-600">
                                                <!-- File Icon -->
                                                <div class="flex-shrink-0">
                                                    @php
                                                        $iconColors = [
                                                            'pdf' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                                                            'word' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                                                            'excel' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
                                                            'video' => 'bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400',
                                                            'audio' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400',
                                                            'archive' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400',
                                                            'document' => 'bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300',
                                                        ];
                                                        $colorClass = $iconColors[$icon] ?? $iconColors['document'];
                                                    @endphp
                                                    <div class="w-12 h-12 rounded-lg {{ $colorClass }} flex items-center justify-center">
                                                        @if($icon === 'video')
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- File Info -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $message->attachment_name }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $message->formatted_size }}</p>
                                                </div>
                                                <!-- Download Icon -->
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        @endif
                                    @endif
                                    
                                    @if($message->message)
                                    <p class="text-sm leading-relaxed break-words whitespace-pre-wrap">{{ $message->message }}</p>
                                    @endif
                                    
                                    <!-- Timestamp and Status in Bubble -->
                                    <div class="flex items-center justify-end gap-1 mt-1">
                                        <span class="text-[10px] text-muted dark:text-gray-500">
                                            {{ $message->created_at->format('g:i A') }}
                                        </span>
                                        @if($message->sender_id === auth()->id())
                                            <span class="{{ $message->is_read ? 'text-info-600 dark:text-info-400' : 'text-muted dark:text-gray-500' }}">
                                                <!-- Double Check for Read -->
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    @if($message->is_read)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2 13l4 4L16 7" opacity="0.6"></path>
                                                    @endif
                                                </svg>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Message Tail (WhatsApp style) -->
                                    <div class="absolute bottom-0 {{ $message->sender_id === auth()->id() ? '-right-2' : '-left-2' }}">
                                        <svg width="12" height="20" viewBox="0 0 8 13" class="{{ $message->sender_id === auth()->id() ? 'text-success-100 dark:text-success-900/30' : 'text-white dark:text-gray-800' }}">
                                            <path d="M1.533,3.568 L8.009,0.011 L8.009,11.174 C8.009,11.174 3.245,10.129 1.533,3.568 Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-24 h-24 mx-auto mb-4 bg-muted dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-tertiary dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <p class="text-secondary dark:text-gray-400">No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Message Input Form - WhatsApp Style -->
            <div class="bg-secondary-100 dark:bg-gray-900 border-t border-light dark:border-gray-700 px-4 py-3">
                <form action="{{ route('messages.send', $conversation) }}" method="POST" enctype="multipart/form-data" class="flex items-end gap-2" x-data="{ 
                    attachedFile: null, 
                    attachFileName: '',
                    fileSizeError: '',
                    selectFile() {
                        this.$refs.fileInput.click();
                    },
                    handleFileSelect(event) {
                        const file = event.target.files[0];
                        if (file) {
                            // Check file size (20MB = 20 * 1024 * 1024 bytes)
                            if (file.size > 20 * 1024 * 1024) {
                                this.fileSizeError = 'File size must be less than 20MB';
                                this.$refs.fileInput.value = '';
                                setTimeout(() => { this.fileSizeError = ''; }, 5000);
                                return;
                            }
                            this.fileSizeError = '';
                            this.attachedFile = file;
                            this.attachFileName = file.name;
                            this.$refs.messageInput.removeAttribute('required');
                        }
                    },
                    removeFile() {
                        this.attachedFile = null;
                        this.attachFileName = '';
                        this.fileSizeError = '';
                        this.$refs.fileInput.value = '';
                        this.$refs.messageInput.setAttribute('required', 'required');
                    }
                }">
                    @csrf
                    
                    <!-- File Input (hidden) -->
                    <input 
                        type="file" 
                        name="attachment" 
                        x-ref="fileInput" 
                        @change="handleFileSelect"
                        accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.txt,.zip,.rar"
                        class="hidden">
                    
                    <!-- Attachment Button -->
                    <button 
                        type="button" 
                        @click="selectFile()"
                        class="flex-shrink-0 w-11 h-11 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition"
                        title="Attach file (max 20MB)">
                        <svg class="w-6 h-6 text-muted dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </button>
                    
                    <div class="flex-1">
                        <!-- File Size Error -->
                        <div x-show="fileSizeError" x-cloak class="mb-2 p-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg">
                            <p class="text-sm text-red-600 dark:text-red-400" x-text="fileSizeError"></p>
                        </div>
                        
                        <!-- Attached File Preview -->
                        <div x-show="attachedFile" x-cloak class="mb-2 p-2 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-between border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-2 flex-1 min-w-0">
                                <svg class="w-5 h-5 text-primary dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-700 dark:text-gray-300 truncate" x-text="attachFileName"></span>
                            </div>
                            <button type="button" @click="removeFile()" class="flex-shrink-0 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full transition">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    
                        <!-- Message Input with Emoji Button -->
                        <div class="relative">
                            <textarea 
                                id="messageInput"
                                x-ref="messageInput"
                                name="message" 
                                rows="1" 
                                placeholder="Type a message"
                                required
                                maxlength="1000"
                                class="w-full rounded-3xl border-0 bg-white dark:bg-gray-800 text-primary dark:text-white placeholder-muted dark:placeholder-gray-500 focus:ring-2 focus:ring-primary-400 dark:focus:ring-primary-600 resize-none px-5 py-3 pr-14 text-sm"
                                style="min-height: 44px; max-height: 120px;"
                                onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); this.form.submit(); }"
                                oninput="this.style.height = 'auto'; this.style.height = Math.min(this.scrollHeight, 120) + 'px';"
                            ></textarea>
                            @error('message')
                                <p class="text-danger-600 dark:text-danger-400 text-xs mt-1 ml-2">{{ $message }}</p>
                            @enderror
                            @error('attachment')
                                <p class="text-danger-600 dark:text-danger-400 text-xs mt-1 ml-2">{{ $message }}</p>
                            @enderror
                            
                            <!-- Emoji Picker -->
                            <div class="absolute right-3 top-1/2 -translate-y-1/2" x-data="{ showEmojiPicker: false }">
                                <button 
                                    type="button" 
                                    @click="showEmojiPicker = !showEmojiPicker"
                                    class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition"
                                    title="Add emoji">
                                    <svg class="w-5 h-5 text-muted dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            
                            <!-- Emoji Picker Dropdown -->
                            <div 
                                x-show="showEmojiPicker" 
                                @click.away="showEmojiPicker = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute bottom-full right-0 mb-2 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 p-3 w-80 max-h-72 overflow-y-auto"
                                style="display: none;">
                                
                                <div class="grid grid-cols-8 gap-1">
                                    @php
                                    $emojis = [
                                        '😀', '😃', '😄', '😁', '😆', '😅', '🤣', '😂',
                                        '🙂', '🙃', '😉', '😊', '😇', '🥰', '😍', '🤩',
                                        '😘', '😗', '😚', '😙', '🥲', '😋', '😛', '😜',
                                        '🤪', '😝', '🤑', '🤗', '🤭', '🤫', '🤔', '🤐',
                                        '🤨', '😐', '😑', '😶', '😏', '😒', '🙄', '😬',
                                        '🤥', '😌', '😔', '😪', '🤤', '😴', '😷', '🤒',
                                        '🤕', '🤢', '🤮', '🤧', '🥵', '🥶', '😶‍🌫️', '😵',
                                        '🤯', '🤠', '🥳', '🥸', '😎', '🤓', '🧐', '😕',
                                        '😟', '🙁', '☹️', '😮', '😯', '😲', '😳', '🥺',
                                        '😦', '😧', '😨', '😰', '😥', '😢', '😭', '😱',
                                        '😖', '😣', '😞', '😓', '😩', '😫', '🥱', '😤',
                                        '😡', '😠', '🤬', '👍', '👎', '👌', '✌️', '🤞',
                                        '🤟', '🤘', '🤙', '👋', '🤚', '🖐️', '✋', '🖖',
                                        '👏', '🙌', '👐', '🤲', '🤝', '🙏', '✍️', '💪',
                                        '🦾', '🦿', '🦵', '🦶', '👂', '🦻', '👃', '🧠',
                                        '❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍',
                                        '🤎', '💔', '❣️', '💕', '💞', '💓', '💗', '💖',
                                        '💘', '💝', '💟', '☮️', '✝️', '☪️', '🕉️', '☸️',
                                        '✡️', '🔯', '🕎', '☯️', '☦️', '🛐', '⛎', '♈',
                                        '♉', '♊', '♋', '♌', '♍', '♎', '♏', '♐',
                                        '♑', '♒', '♓', '🆔', '⚛️', '🉑', '☢️', '☣️',
                                        '🔴', '🟠', '🟡', '🟢', '🔵', '🟣', '⚫', '⚪',
                                        '🟤', '🔺', '🔻', '🔸', '🔹', '🔶', '🔷', '🔳',
                                        '⭐', '🌟', '✨', '⚡', '☄️', '💥', '🔥', '🌈',
                                        '☀️', '🌤️', '⛅', '🌥️', '☁️', '🌦️', '🌧️', '⛈️',
                                        '🌩️', '🌨️', '❄️', '☃️', '⛄', '🌬️', '💨', '💧',
                                        '💦', '☔', '☂️', '🌊', '🌫️', '🍏', '🍎', '🍐',
                                        '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐', '🍈',
                                        '🍒', '🍑', '🥭', '🍍', '🥥', '🥝', '🍅', '🍆',
                                        '🥑', '🥦', '🥬', '🥒', '🌶️', '🫑', '🌽', '🥕',
                                        '🫒', '🧄', '🧅', '🥔', '🍠', '🥐', '🥯', '🍞',
                                        '🥖', '🥨', '🧀', '🥚', '🍳', '🧈', '🥞', '🧇',
                                        '🥓', '🥩', '🍗', '🍖', '🦴', '🌭', '🍔', '🍟',
                                        '🍕', '🫓', '🥪', '🥙', '🧆', '🌮', '🌯', '🫔'
                                    ];
                                    @endphp
                                    
                                    @foreach($emojis as $emoji)
                                    <button 
                                        type="button"
                                        @click="
                                            const textarea = document.getElementById('messageInput');
                                            const start = textarea.selectionStart;
                                            const end = textarea.selectionEnd;
                                            const text = textarea.value;
                                            textarea.value = text.substring(0, start) + '{{ $emoji }}' + text.substring(end);
                                            textarea.focus();
                                            textarea.selectionStart = textarea.selectionEnd = start + {{ mb_strlen($emoji) }};
                                            showEmojiPicker = false;
                                        "
                                        class="text-2xl hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-1 transition-colors cursor-pointer"
                                        title="{{ $emoji }}">
                                        {{ $emoji }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- End Emoji Picker -->
                    </div> <!-- End Relative (Textarea Container) -->
                </div> <!-- End flex-1 (Message Input Area) -->

                <!-- Send Button -->
                <button type="submit" class="flex-shrink-0 w-11 h-11 flex items-center justify-center bg-success-500 hover:bg-success-600 text-white rounded-full transition-all duration-200 transform hover:scale-110 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Custom scrollbar for messages */
    #messagesContainer::-webkit-scrollbar {
        width: 6px;
    }
    
    #messagesContainer::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #messagesContainer::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
    
    #messagesContainer::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.3);
    }
    
    .dark #messagesContainer::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .dark #messagesContainer::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>

<script>
    // Auto-scroll to bottom of messages on load and new message
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('messagesContainer');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
        
        // Focus message input
        const messageInput = document.querySelector('textarea[name="message"]');
        if (messageInput) {
            messageInput.focus();
        }
    });
</script>
</x-app-dashboard>
