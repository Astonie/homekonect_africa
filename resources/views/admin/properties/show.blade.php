<x-app-dashboard 
    title="Property Verification" 
    subtitle="{{ $property->title }}">

    {{-- Navigation Slot --}}
    <x-slot:navigation>
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

        <a href="{{ route('admin.properties.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-gray-800 rounded-lg text-indigo-400 transition-all duration-200 hover:bg-gray-700 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Properties</span>
        </a>

        <a href="{{ route('admin.kyc.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105 relative" :class="!sidebarOpen && 'justify-center'">
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
    </x-slot:navigation>

    {{-- Breadcrumbs Slot --}}
    <x-slot:breadcrumbs>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Admin Panel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.properties.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Properties</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-indigo-600 md:ml-2">Verify Property</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot:breadcrumbs>

    {{-- Header Actions Slot --}}
    <x-slot:headerActions>
        <a href="{{ route('admin.properties.index') }}" class="flex items-center space-x-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="font-medium">Back to List</span>
        </a>
    </x-slot:headerActions>

    {{-- Main Content --}}
    
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
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
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Property Images</h4>
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach($property->images as $image)
                                            @php
                                                // Handle different image path formats
                                                if (filter_var($image, FILTER_VALIDATE_URL)) {
                                                    $imageUrl = $image;
                                                } elseif (Str::startsWith($image, 'http')) {
                                                    $imageUrl = $image;
                                                } elseif (Str::startsWith($image, 'uploads/')) {
                                                    $imageUrl = asset($image);
                                                } else {
                                                    $imageUrl = Storage::url($image);
                                                }
                                            @endphp
                                            <div class="relative group">
                                                <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="w-full h-40 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-shadow" onerror="this.parentElement.innerHTML='<div class=\'w-full h-40 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center shadow-md\'><svg class=\'w-12 h-12 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Property Images</h4>
                                    <div class="flex items-center justify-center h-40 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">No images uploaded</p>
                                        </div>
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

</x-app-dashboard>
