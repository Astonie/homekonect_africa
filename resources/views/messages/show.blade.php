<x-app-dashboard 
    title="Conversation" 
    subtitle="Chat with {{ $otherUser->name }} about {{ $conversation->property->title }}">
    
    {{-- Navigation Slot - Copy full navigation from admin dashboard --}}
    <x-slot name="navigation">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
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
                                    
                                    <p class="text-sm leading-relaxed break-words whitespace-pre-wrap">{{ $message->message }}</p>
                                    
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
                <form action="{{ route('messages.send', $conversation) }}" method="POST" class="flex items-end gap-2">
                    @csrf
                    
                    <div class="flex-1 relative">
                        <textarea 
                            name="message" 
                            rows="1" 
                            placeholder="Type a message"
                            required
                            maxlength="1000"
                            class="w-full rounded-3xl border-0 bg-white dark:bg-gray-800 text-primary dark:text-white placeholder-muted dark:placeholder-gray-500 focus:ring-2 focus:ring-primary-400 dark:focus:ring-primary-600 resize-none px-5 py-3 pr-12 text-sm"
                            style="min-height: 44px; max-height: 120px;"
                            onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); this.form.submit(); }"
                            oninput="this.style.height = 'auto'; this.style.height = Math.min(this.scrollHeight, 120) + 'px';"
                        ></textarea>
                        @error('message')
                            <p class="text-danger-600 dark:text-danger-400 text-xs mt-1 ml-2">{{ $message }}</p>
                        @enderror
                        
                        <!-- Emoji/Attachment placeholder -->
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                            <svg class="w-5 h-5 text-muted dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>

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
