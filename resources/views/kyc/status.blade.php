<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('KYC Verification Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if(session('success'))
                        <div class="mb-6 rounded-lg border border-green-200 dark:border-green-900/40 bg-green-50 dark:bg-green-900/40 p-4 text-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="mb-6 rounded-lg border border-blue-200 dark:border-blue-900/40 bg-blue-50 dark:bg-blue-900/40 p-4 text-blue-800 dark:text-blue-300">
                            {{ session('info') }}
                        </div>
                    @endif

                    <div class="text-center mb-8">
                        @if($kyc->status === 'pending' || $kyc->status === 'under_review')
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-yellow-100 dark:bg-yellow-900/40 mb-4">
                                <svg class="w-12 h-12 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Verification Pending</h3>
                            <p class="text-gray-600 dark:text-gray-400">Your KYC documents are being reviewed by our team.</p>
                        @elseif($kyc->status === 'approved')
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-100 dark:bg-green-900/40 mb-4">
                                <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 text-green-600 dark:text-green-400">Verified!</h3>
                            <p class="text-gray-600 dark:text-gray-400">Your account has been successfully verified.</p>
                        @elseif($kyc->status === 'rejected')
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-100 dark:bg-red-900/40 mb-4">
                                <svg class="w-12 h-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 text-red-600 dark:text-red-400">Verification Rejected</h3>
                            <p class="text-gray-600 dark:text-gray-400">Unfortunately, your KYC submission was not approved.</p>
                        @endif
                    </div>

                    <!-- Status Details -->
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Status</div>
                                <div class="font-semibold">
                                    <span class="inline-flex px-3 py-1 rounded-full text-sm
                                        @if($kyc->status === 'pending' || $kyc->status === 'under_review') bg-yellow-100 dark:bg-yellow-900/40 text-yellow-800 dark:text-yellow-300
                                        @elseif($kyc->status === 'approved') bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300
                                        @elseif($kyc->status === 'rejected') bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $kyc->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Submitted On</div>
                                <div class="font-semibold">{{ $kyc->submitted_at ? $kyc->submitted_at->format('M d, Y H:i') : 'N/A' }}</div>
                            </div>
                            @if($kyc->reviewed_at)
                                <div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Reviewed On</div>
                                    <div class="font-semibold">{{ $kyc->reviewed_at->format('M d, Y H:i') }}</div>
                                </div>
                            @endif
                            @if($kyc->verified_at)
                                <div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Verified On</div>
                                    <div class="font-semibold">{{ $kyc->verified_at->format('M d, Y H:i') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Rejection Reason -->
                    @if($kyc->status === 'rejected' && $kyc->rejection_reason)
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/40 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-red-800 dark:text-red-300 mb-2">Rejection Reason</h4>
                            <p class="text-red-700 dark:text-red-400">{{ $kyc->rejection_reason }}</p>
                        </div>
                    @endif

                    <!-- Admin Notes -->
                    @if($kyc->admin_notes)
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900/40 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Admin Notes</h4>
                            <p class="text-blue-700 dark:text-blue-400">{{ $kyc->admin_notes }}</p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            ← Back to Dashboard
                        </a>
                        @if($kyc->status === 'rejected' || $kyc->status === 'resubmission_required')
                            <a href="{{ route('kyc.create') }}" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-colors shadow-lg">
                                Resubmit KYC
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
