<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Landlord Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- KYC Verification Alert -->
            @if(!Auth::user()->is_verified)
                @php
                    $kyc = Auth::user()->kycVerification;
                @endphp
                
                @if(!$kyc)
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-yellow-800">KYC Verification Required</h3>
                                <p class="text-yellow-700 mt-1">Complete your KYC verification to start listing properties on our platform.</p>
                            </div>
                            <a href="{{ route('kyc.create') }}" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition font-semibold ml-4">
                                Complete KYC
                            </a>
                        </div>
                    </div>
                @elseif($kyc->status === 'pending' || $kyc->status === 'under_review')
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-6 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-blue-800">KYC Under Review</h3>
                                <p class="text-blue-700 mt-1">Your KYC verification is being reviewed. You'll be notified once approved (usually within 24-48 hours).</p>
                            </div>
                            <a href="{{ route('kyc.status') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition font-semibold ml-4">
                                View Status
                            </a>
                        </div>
                    </div>
                @elseif($kyc->status === 'rejected' || $kyc->status === 'resubmission_required')
                    <div class="bg-red-50 border-l-4 border-red-400 p-6 mb-6 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-red-800">KYC Verification {{ $kyc->status === 'rejected' ? 'Rejected' : 'Needs Resubmission' }}</h3>
                                <p class="text-red-700 mt-1">{{ $kyc->rejection_reason }}</p>
                            </div>
                            <a href="{{ route('kyc.create') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition font-semibold ml-4">
                                Resubmit KYC
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-green-800">✓ Verified Account</h3>
                            <p class="text-green-700 mt-1">Your account is verified. You can now list properties on our platform.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Manage your properties and connect with potential tenants.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">My Properties</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Active Listings</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Monthly Revenue</p>
                            <p class="text-3xl font-bold text-gray-900">$0</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    <a href="{{ route('landlord.properties.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">+ Add Property</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('landlord.properties.index') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">My Properties</p>
                            <p class="text-sm text-gray-600">View all your listings</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                        <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Applications</p>
                            <p class="text-sm text-gray-600">Review tenant applications</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                        <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Analytics</p>
                            <p class="text-sm text-gray-600">View performance metrics</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p>No recent activity to display</p>
                    <p class="text-sm">Start by adding your first property</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
