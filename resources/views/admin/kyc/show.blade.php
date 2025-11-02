<x-app-dashboard title="KYC Verification Details" role="admin">
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.admin active="kyc" />
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
