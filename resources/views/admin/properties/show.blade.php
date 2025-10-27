<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Property Verification - {{ $property->title }}
            </h2>
            <a href="{{ route('admin.properties.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Properties
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Status Alert -->
            @if($property->is_verified)
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                ✓ This property has been verified and is now available for listing.
                                @if($property->verifier)
                                    <br><strong>Verified by:</strong> {{ $property->verifier->name }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($property->status === 'inactive' && $property->rejection_reason)
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <strong>Rejection Reason:</strong> {{ $property->rejection_reason }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Property Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Information</h3>
                            
                            <!-- Images -->
                            @if($property->images && count($property->images) > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Property Images</h4>
                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach($property->images as $image)
                                            <img src="{{ Storage::url($image) }}" alt="{{ $property->title }}" class="w-full h-32 object-cover rounded-lg">
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Type</p>
                                    <p class="font-medium">{{ ucfirst($property->type) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Listing Type</p>
                                    <p class="font-medium">{{ ucfirst($property->listing_type) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Bedrooms</p>
                                    <p class="font-medium">{{ $property->bedrooms }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Bathrooms</p>
                                    <p class="font-medium">{{ $property->bathrooms }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Square Feet</p>
                                    <p class="font-medium">{{ number_format($property->square_feet) }} sq ft</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Price</p>
                                    <p class="font-medium">${{ number_format($property->price, 2) }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Description</p>
                                <p class="text-gray-700 mt-1">{{ $property->description }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Location</p>
                                <p class="text-gray-700 mt-1">{{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Property Documents -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Property Documents</h3>
                            
                            @if($property->documents_submitted)
                                <div class="space-y-3">
                                    @if($property->ownership_document)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Ownership Document</span>
                                            </div>
                                            <a href="{{ Storage::url($property->ownership_document) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                        </div>
                                    @endif
                                    @if($property->tax_receipt)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Tax Receipt</span>
                                            </div>
                                            <a href="{{ Storage::url($property->tax_receipt) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                        </div>
                                    @endif
                                    @if($property->insurance_document)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Insurance Document</span>
                                            </div>
                                            <a href="{{ Storage::url($property->insurance_document) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                        </div>
                                    @endif
                                    @if($property->building_permit)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Building Permit</span>
                                            </div>
                                            <a href="{{ Storage::url($property->building_permit) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                        </div>
                                    @endif
                                    @if($property->additional_documents && count($property->additional_documents) > 0)
                                        @foreach($property->additional_documents as $index => $doc)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                    </svg>
                                                    <span class="text-sm font-medium text-gray-700">Additional Document {{ $index + 1 }}</span>
                                                </div>
                                                <a href="{{ Storage::url($doc) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <p class="text-xs text-gray-500 mt-4">Submitted: {{ \Carbon\Carbon::parse($property->documents_submitted_at)->format('M d, Y g:i A') }}</p>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No documents have been submitted yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Owner Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Owner Information</h3>
                            <div>
                                <p class="text-sm text-gray-600">Name</p>
                                <p class="font-medium">{{ $property->user->name }}</p>
                            </div>
                            <div class="mt-3">
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="text-sm text-gray-700">{{ $property->user->email }}</p>
                            </div>
                            <div class="mt-3">
                                <p class="text-sm text-gray-600">Role</p>
                                <p class="font-medium">{{ ucfirst($property->user->role) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                            
                            <div class="mb-3">
                                <p class="text-sm text-gray-600">Current Status</p>
                                @if($property->status === 'available')
                                    <span class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Available</span>
                                @elseif($property->status === 'pending')
                                    <span class="inline-block mt-1 px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">Pending</span>
                                @else
                                    <span class="inline-block mt-1 px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">{{ ucfirst($property->status) }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <p class="text-sm text-gray-600">Documents Status</p>
                                @if($property->documents_submitted)
                                    <span class="inline-block mt-1 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Submitted</span>
                                @else
                                    <span class="inline-block mt-1 px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Not Submitted</span>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Verification Status</p>
                                @if($property->is_verified)
                                    <span class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">✓ Verified</span>
                                @else
                                    <span class="inline-block mt-1 px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Not Verified</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Verification Notes -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Verification Notes</h3>
                            
                            @if($property->verification_notes)
                                <div class="p-3 bg-blue-50 border border-blue-200 rounded mb-4">
                                    <p class="text-sm text-blue-900">{{ $property->verification_notes }}</p>
                                </div>
                            @endif

                            <form action="{{ route('admin.properties.notes', $property) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <textarea name="notes" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Add verification notes...">{{ old('notes', $property->verification_notes) }}</textarea>
                                @error('notes')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="mt-2 w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition text-sm font-medium">
                                    Update Notes
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 border border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                            
                            <div class="bg-white p-4 rounded-lg">
                                @if(!$property->is_verified && $property->status !== 'inactive')
                                    <!-- Verify Form -->
                                    <form action="{{ route('admin.properties.verify', $property) }}" method="POST" class="mb-3">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="notes" value="{{ $property->verification_notes }}">
                                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium shadow-sm">
                                            ✓ Verify & Approve Property
                                        </button>
                                    </form>

                                    <!-- Reject Form -->
                                    <form action="{{ route('admin.properties.reject', $property) }}" method="POST" x-data="{ showReason: false }">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" @click="showReason = !showReason" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium shadow-sm">
                                            ✗ Reject Property
                                        </button>
                                        <div x-show="showReason" class="mt-3">
                                            <textarea name="reason" rows="3" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm"
                                                placeholder="Please provide a reason for rejection..."></textarea>
                                            @error('reason')
                                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                            <button type="submit" class="mt-2 w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                                Confirm Rejection
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <p class="text-sm text-gray-600 text-center">
                                        This property has already been {{ $property->is_verified ? 'verified' : 'rejected' }}.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
