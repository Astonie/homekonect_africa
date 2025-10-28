<x-app-dashboard title="KYC Verification Details" role="admin">
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Dashboard</span>
        </a>

        <div class="relative" x-data="{ usersMenuOpen: false }">
            <button @click="usersMenuOpen = !usersMenuOpen" class="w-full flex items-center justify-between space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="font-medium">Users</span>
                </div>
                <svg x-show="sidebarOpen" :class="usersMenuOpen && 'rotate-180'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="usersMenuOpen && sidebarOpen" x-transition class="ml-11 mt-2 space-y-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">All Users</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Landlords</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Agents</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">Tenants</a>
            </div>
        </div>

        <a href="{{ route('admin.properties.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Properties</span>
        </a>

        <a href="{{ route('admin.kyc.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-gray-800 rounded-lg text-purple-400 transition-all duration-200 hover:bg-gray-700 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">KYC Verifications</span>
        </a>

        <a href="{{ route('admin.team.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Team Members</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Settings</span>
        </a>
    </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('KYC Verification Details') }}
            </h2>
            <a href="{{ route('admin.kyc.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- User Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">User Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->user->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($kycVerification->user->role) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Current Status</label>
                            <p class="mt-1">
                                @if($kycVerification->status === 'pending')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($kycVerification->status === 'under_review')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Under Review</span>
                                @elseif($kycVerification->status === 'approved')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                @elseif($kycVerification->status === 'rejected')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Resubmission Required</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Submitted At</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->submitted_at ? $kycVerification->submitted_at->format('M d, Y h:i A') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Business Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Business Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->business_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">License Number</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->license_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tax ID</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->tax_id ?? 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Business Address</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->business_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identity Documents -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Identity Documents</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Type</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $kycVerification->id_type)) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Number</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $kycVerification->id_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Front Image</label>
                            <p class="mt-1 text-sm text-blue-600">
                                <a href="#" class="hover:underline">{{ basename($kycVerification->id_front_image) }}</a>
                            </p>
                        </div>
                        @if($kycVerification->id_back_image)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ID Back Image</label>
                                <p class="mt-1 text-sm text-blue-600">
                                    <a href="#" class="hover:underline">{{ basename($kycVerification->id_back_image) }}</a>
                                </p>
                            </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Selfie Image</label>
                            <p class="mt-1 text-sm text-blue-600">
                                <a href="#" class="hover:underline">{{ basename($kycVerification->selfie_image) }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proof of Address -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Proof of Address</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Document Type</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $kycVerification->proof_of_address_type)) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Document</label>
                            <p class="mt-1 text-sm text-blue-600">
                                <a href="#" class="hover:underline">{{ basename($kycVerification->proof_of_address_image) }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Documents (For Agents) -->
            @if($kycVerification->user->role === 'agent' && $kycVerification->professional_license_image)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Professional Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Professional License</label>
                                <p class="mt-1 text-sm text-blue-600">
                                    <a href="#" class="hover:underline">{{ basename($kycVerification->professional_license_image) }}</a>
                                </p>
                            </div>
                            @if($kycVerification->certification_documents)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Certifications</label>
                                    <div class="mt-1 space-y-1">
                                        @foreach(json_decode($kycVerification->certification_documents, true) as $cert)
                                            <p class="text-sm text-blue-600">
                                                <a href="#" class="hover:underline">{{ basename($cert) }}</a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Property Ownership Documents (For Landlords) -->
            @if($kycVerification->user->role === 'landlord' && $kycVerification->property_ownership_documents)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Ownership Documents</h3>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach(json_decode($kycVerification->property_ownership_documents, true) as $doc)
                                <div>
                                    <p class="text-sm text-blue-600">
                                        <a href="#" class="hover:underline">{{ basename($doc) }}</a>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Admin Notes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <form action="{{ route('admin.kyc.notes', $kycVerification) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <textarea name="admin_notes" rows="4" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Add notes about this verification...">{{ $kycVerification->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                            Update Notes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Rejection Reason (if rejected) -->
            @if($kycVerification->rejection_reason)
                <div class="bg-red-50 border border-red-200 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-red-900 mb-2">Rejection Reason</h3>
                        <p class="text-sm text-red-700">{{ $kycVerification->rejection_reason }}</p>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="bg-gray-50 border border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    
                    @if(in_array($kycVerification->status, ['pending', 'under_review']))
                        <div class="flex flex-wrap gap-4">
                            <!-- Mark as Under Review -->
                            @if($kycVerification->status === 'pending')
                                <form action="{{ route('admin.kyc.under-review', $kycVerification) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
                                        📋 Mark as Under Review
                                    </button>
                                </form>
                            @endif

                            <!-- Approve -->
                            <form action="{{ route('admin.kyc.approve', $kycVerification) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to approve this KYC verification?')">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-medium shadow-sm">
                                    ✓ Approve Verification
                                </button>
                            </form>

                            <!-- Reject -->
                            <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" 
                                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium shadow-sm">
                                ✗ Reject Verification
                            </button>
                        </div>
                    @else
                        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p class="text-gray-600">
                                This KYC verification has already been processed. 
                                <span class="font-semibold">Current status: {{ ucfirst(str_replace('_', ' ', $kycVerification->status)) }}</span>
                            </p>
                            @if($kycVerification->status === 'approved')
                                <p class="text-sm text-gray-500 mt-2">
                                    Approved on {{ $kycVerification->verified_at ? $kycVerification->verified_at->format('M d, Y h:i A') : 'N/A' }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rejection Modal -->
            <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Reject KYC Verification</h3>
                        <form action="{{ route('admin.kyc.reject', $kycVerification) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason</label>
                                <textarea name="rejection_reason" rows="4" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                    placeholder="Explain why this verification is being rejected..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="require_resubmission" value="1" 
                                        class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-500 focus:ring-red-500">
                                    <span class="ml-2 text-sm text-gray-700">Require resubmission</span>
                                </label>
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    Reject
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
