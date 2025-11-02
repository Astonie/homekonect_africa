@props(['active' => ''])

<a href="{{ route('tenant.dashboard') }}" class="flex items-center px-4 py-3 {{ $active === 'dashboard' ? 'bg-gray-800 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
    </svg>
    <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Dashboard</span>
</a>

<a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 {{ $active === 'browse' ? 'bg-gray-800 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Browse Properties</span>
</a>

<a href="{{ route('settings.index') }}" class="flex items-center px-4 py-3 {{ $active === 'settings' ? 'bg-gray-800 text-green-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} rounded-lg transition-all duration-200 transform hover:scale-105" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    <span x-show="sidebarOpen" x-transition x-cloak class="font-medium">Settings</span>
</a>
