<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $property->title }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('landlord.properties.edit', $property) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Edit Property
                </a>
                <a href="{{ route('landlord.properties.index') }}" class="text-gray-600 hover:text-gray-900">
                    ← Back to Properties
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Status Alert -->
            @if($property->status === 'pending')
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                This property is pending verification. Once approved by admin, it will be visible to tenants.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($property->status === 'inactive')
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                This property has been rejected. 
                                @if($property->rejection_reason)
                                    <strong>Reason:</strong> {{ $property->rejection_reason }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Images Gallery -->
                    @if($property->images && count($property->images) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Images</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($property->images as $image)
                                        @php
                                            // Handle both old format (string) and new format (array with path)
                                            $imagePath = is_array($image) ? ($image['path'] ?? $image) : $image;
                                            $isFeatured = is_array($image) && isset($image['is_featured']) && $image['is_featured'];
                                        @endphp
                                        <div class="relative">
                                            <img src="{{ $imagePath }}" alt="{{ $property->title }}" class="w-full h-48 object-cover rounded-lg {{ $isFeatured ? 'ring-4 ring-blue-500' : '' }}">
                                            @if($isFeatured)
                                                <div class="absolute top-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                                    Featured
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                            <p class="text-gray-700 whitespace-pre-line">{{ $property->description }}</p>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Details</h3>
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
                                @if($property->year_built)
                                <div>
                                    <p class="text-sm text-gray-600">Year Built</p>
                                    <p class="font-medium">{{ $property->year_built }}</p>
                                </div>
                                @endif
                                @if($property->floors)
                                <div>
                                    <p class="text-sm text-gray-600">Floors</p>
                                    <p class="font-medium">{{ $property->floors }}</p>
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm text-gray-600">Furnished</p>
                                    <p class="font-medium">{{ $property->furnished ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amenities -->
                    @if($property->amenities && count($property->amenities) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Amenities</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($property->amenities as $amenity)
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $amenity)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Property Documents -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Property Documents</h3>
                            
                            <div class="space-y-3">
                                @if($property->ownership_document)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="text-sm font-medium text-gray-700">Ownership Document</span>
                                        <a href="{{ Storage::url($property->ownership_document) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                    </div>
                                @endif
                                @if($property->tax_receipt)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="text-sm font-medium text-gray-700">Tax Receipt</span>
                                        <a href="{{ Storage::url($property->tax_receipt) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                    </div>
                                @endif
                                @if($property->insurance_document)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="text-sm font-medium text-gray-700">Insurance Document</span>
                                        <a href="{{ Storage::url($property->insurance_document) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                    </div>
                                @endif
                                @if($property->building_permit)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="text-sm font-medium text-gray-700">Building Permit</span>
                                        <a href="{{ Storage::url($property->building_permit) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                    </div>
                                @endif
                                @if($property->additional_documents && count($property->additional_documents) > 0)
                                    @foreach($property->additional_documents as $index => $doc)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                            <span class="text-sm font-medium text-gray-700">Additional Document {{ $index + 1 }}</span>
                                            <a href="{{ Storage::url($doc) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            @if($property->verification_notes)
                                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded">
                                    <p class="text-sm font-medium text-blue-900 mb-1">Admin Notes:</p>
                                    <p class="text-sm text-blue-800">{{ $property->verification_notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Price Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                ${{ number_format($property->price, 2) }}
                                <span class="text-sm font-normal text-gray-600">
                                    {{ $property->listing_type === 'rent' ? '/ month' : '' }}
                                </span>
                            </h3>
                            
                            @if($property->security_deposit)
                                <p class="text-sm text-gray-600 mt-2">Security Deposit: ${{ number_format($property->security_deposit, 2) }}</p>
                            @endif
                            @if($property->maintenance_fee)
                                <p class="text-sm text-gray-600">Maintenance Fee: ${{ number_format($property->maintenance_fee, 2) }}</p>
                            @endif

                            <div class="mt-4 pt-4 border-t">
                                <p class="text-sm text-gray-600">Status</p>
                                @if($property->status === 'available')
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Available</span>
                                @elseif($property->status === 'pending')
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">Pending Verification</span>
                                @elseif($property->status === 'rented')
                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Rented</span>
                                @elseif($property->status === 'sold')
                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">Sold</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Location</h3>
                            <div class="text-sm text-gray-700 space-y-1">
                                <p>{{ $property->address }}</p>
                                <p>{{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}</p>
                                <p>{{ $property->country }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Availability Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Availability</h3>
                            
                            @if($property->available_from)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600">Available From</p>
                                    <p class="font-medium">{{ \Carbon\Carbon::parse($property->available_from)->format('M d, Y') }}</p>
                                </div>
                            @endif
                            
                            @if($property->lease_duration)
                                <div>
                                    <p class="text-sm text-gray-600">Lease Duration</p>
                                    <p class="font-medium">{{ $property->lease_duration }} months</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Document Verification Status -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Status</h3>
                            
                            @if($property->documents_submitted)
                                <div class="flex items-center mb-3">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">Documents Submitted</span>
                                </div>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($property->documents_submitted_at)->format('M d, Y g:i A') }}</p>
                            @else
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700">No Documents Submitted</span>
                                </div>
                            @endif

                            @if($property->is_verified)
                                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm font-medium text-green-900">✓ Verified by Admin</p>
                                    @if($property->verifier)
                                        <p class="text-xs text-green-700 mt-1">By: {{ $property->verifier->name }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
