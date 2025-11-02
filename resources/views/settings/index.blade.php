<x-app-dashboard 
    title="Settings" 
    subtitle="Manage your account settings and preferences"
    role="{{ Auth::user()->role }}">

    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        @if(Auth::user()->role === 'landlord')
            <x-navigation.landlord active="settings" />
        @elseif(Auth::user()->role === 'agent')
            <x-navigation.agent active="settings" />
        @elseif(Auth::user()->role === 'tenant')
            <x-navigation.tenant active="settings" />
        @elseif(Auth::user()->role === 'admin')
            <x-navigation.admin active="settings" />
        @endif
    </x-slot>

    {{-- Main Content --}}
    <div class="space-y-6" x-data="{ activeTab: 'profile' }">
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 dark:border-green-500 p-4 rounded">
                <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabs Navigation -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden transition-colors duration-300">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex space-x-4 px-6" aria-label="Tabs">
                    <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Profile Information
                    </button>
                    <button @click="activeTab = 'security'" :class="activeTab === 'security' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Security
                    </button>
                    <button @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Notifications
                    </button>
                    <button @click="activeTab = 'privacy'" :class="activeTab === 'privacy' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Privacy
                    </button>
                    <button @click="activeTab = 'danger'" :class="activeTab === 'danger' ? 'border-red-500 text-red-600 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Danger Zone
                    </button>
                </nav>
            </div>
        </div>

        <!-- Profile Information Tab -->
        <div x-show="activeTab === 'profile'" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Profile Information</h3>
            
            <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role (Read-only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account Type</label>
                    <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg">
                        <span class="text-gray-900 dark:text-white font-semibold">{{ ucfirst($user->role) }}</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-800 transition-colors duration-200 font-semibold shadow-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Tab -->
        <div x-show="activeTab === 'security'" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Change Password</h3>
            
            <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-800 transition-colors duration-200 font-semibold shadow-sm">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Notifications Tab -->
        <div x-show="activeTab === 'notifications'" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Notification Preferences</h3>
            
            <form action="{{ route('settings.notifications.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <!-- Email Notifications -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Email Notifications</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive email notifications for property updates</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="email_notifications" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>

                    <!-- SMS Notifications -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">SMS Notifications</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive text messages for important updates</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="sms_notifications" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>

                    <!-- Marketing Emails -->
                    <div class="flex items-center justify-between py-4">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Marketing Emails</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive promotional offers and newsletters</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="marketing_emails" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-800 transition-colors duration-200 font-semibold shadow-sm">
                        Save Preferences
                    </button>
                </div>
            </form>
        </div>

        <!-- Privacy Tab -->
        <div x-show="activeTab === 'privacy'" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Privacy Settings</h3>
            
            <form action="{{ route('settings.privacy.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <!-- Profile Visibility -->
                    <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                        <label for="profile_visibility" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Profile Visibility</label>
                        <select name="profile_visibility" id="profile_visibility" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                            <option value="public">Public - Anyone can view my profile</option>
                            <option value="private">Private - Only verified users can view</option>
                        </select>
                    </div>

                    <!-- Show Email -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Show Email Address</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Allow others to see your email address</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_email" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>

                    <!-- Show Phone -->
                    <div class="flex items-center justify-between py-4">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Show Phone Number</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Allow others to see your phone number</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_phone" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-800 transition-colors duration-200 font-semibold shadow-sm">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone Tab -->
        <div x-show="activeTab === 'danger'" x-transition class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-red-200 dark:border-red-900 p-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-6">Danger Zone</h3>
            
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-6">
                <h4 class="text-base font-semibold text-red-900 dark:text-red-400 mb-2">Delete Account</h4>
                <p class="text-sm text-red-700 dark:text-red-300 mb-4">
                    Once you delete your account, there is no going back. Please be certain. All your data including properties, messages, and documents will be permanently removed.
                </p>
                
                <form action="{{ route('settings.account.delete') }}" method="POST" x-data="{ confirmDelete: false }">
                    @csrf
                    @method('DELETE')

                    <div class="space-y-4">
                        <div>
                            <label for="delete_password" class="block text-sm font-medium text-red-900 dark:text-red-400 mb-2">Confirm Password</label>
                            <input type="password" name="password" id="delete_password" 
                                class="w-full px-4 py-2 border border-red-300 dark:border-red-700 rounded-lg focus:ring-2 focus:ring-red-500 dark:bg-gray-900 dark:text-white transition-colors duration-200">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" x-model="confirmDelete" id="confirm_delete" class="rounded border-red-300 dark:border-red-700 text-red-600 focus:ring-red-500 dark:bg-gray-900">
                            <label for="confirm_delete" class="ml-2 text-sm text-red-700 dark:text-red-300">
                                I understand this action cannot be undone
                            </label>
                        </div>

                        <button type="submit" :disabled="!confirmDelete" 
                            :class="confirmDelete ? 'bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800' : 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed'" 
                            class="px-6 py-2 text-white rounded-lg transition-colors duration-200 font-semibold shadow-sm">
                            Delete My Account
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-dashboard>
