<x-app-dashboard 
    title="Messages" 
    subtitle="{{ $conversations->count() }} conversation{{ $conversations->count() !== 1 ? 's' : '' }}">
    
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
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
        <!-- WhatsApp-Style Messages Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col h-full">

            @if(session('success'))
                <div class="mx-4 mt-4 bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-700 text-success-700 dark:text-success-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Conversations List -->
            @if($conversations->count() > 0)
                <div class="flex-1 overflow-y-auto bg-soft dark:bg-gray-900">
                    @foreach($conversations as $conversation)
                        @php
                            $otherUser = $conversation->getOtherUser(auth()->id());
                            $unreadCount = $conversation->unreadMessagesCount(auth()->id());
                            $latestMsg = $conversation->latestMessage->first();
                        @endphp
                        
                        <a href="{{ route('messages.show', $conversation) }}" 
                           class="flex items-center gap-4 px-6 py-4 hover:bg-muted dark:hover:bg-gray-800 transition border-b border-light dark:border-gray-700 {{ $unreadCount > 0 ? 'bg-info-50 dark:bg-info-900/10' : 'bg-white dark:bg-gray-800' }}">
                            
                            <!-- User Avatar -->
                            <div class="relative flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white font-bold text-lg shadow-md ring-2 ring-white dark:ring-gray-800">
                                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                </div>
                            </div>

                            <!-- Conversation Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline justify-between mb-1">
                                    <h3 class="text-base font-semibold text-primary dark:text-white truncate {{ $unreadCount > 0 ? 'font-bold' : '' }}">
                                        {{ $otherUser->name }}
                                    </h3>
                                    <span class="text-xs text-muted dark:text-gray-500 ml-2 flex-shrink-0 {{ $unreadCount > 0 ? 'text-primary-600 dark:text-primary-400 font-semibold' : '' }}">
                                        {{ $conversation->last_message_at->format('M j') }}
                                    </span>
                                </div>
                                
                                @if($latestMsg)
                                    <p class="text-sm text-secondary dark:text-gray-400 truncate {{ $unreadCount > 0 ? 'font-semibold text-primary dark:text-white' : '' }}">
                                        @if($latestMsg->sender_id === auth()->id())
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-info-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        @endif
                                        {{ Str::limit($latestMsg->message, 50) }}
                                    </p>
                                @else
                                    <p class="text-sm text-muted dark:text-gray-500 italic">No messages yet</p>
                                @endif
                                
                                <p class="text-xs text-muted dark:text-gray-500 mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    {{ Str::limit($conversation->property->title, 35) }}
                                </p>
                            </div>

                            <!-- Unread Badge -->
                            @if($unreadCount > 0)
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 bg-success-500 text-white text-xs font-bold rounded-full px-1.5">
                                        {{ $unreadCount }}
                                    </span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="flex-1 flex items-center justify-center bg-soft dark:bg-gray-900">
                    <div class="text-center px-4 py-16">
                        <div class="w-32 h-32 mx-auto mb-6 bg-muted dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-tertiary dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-primary dark:text-white mb-3">No Messages Yet</h3>
                        <p class="text-secondary dark:text-gray-400 mb-6 max-w-sm mx-auto">Start a conversation by inquiring about a property you're interested in</p>
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center bg-primary hover:bg-primary-600 text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse Properties
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-dashboard>
