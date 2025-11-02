<x-app-dashboard>
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.landlord active="properties" />
    </x-slot>
        <a href="{{ route('landlord.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Dashboard</span>
        </a>

        <div class="relative" x-data="{ propertyMenuOpen: true }">
            <button @click="propertyMenuOpen = !propertyMenuOpen" class="w-full flex items-center justify-between space-x-3 px-4 py-3 bg-gray-800 rounded-lg text-blue-400 transition-all duration-200" :class="!sidebarOpen && 'justify-center'">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="font-medium">My Properties</span>
                </div>
                <svg x-show="sidebarOpen" :class="propertyMenuOpen && 'rotate-180'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="propertyMenuOpen && sidebarOpen" x-transition class="ml-11 mt-2 space-y-1">
                <a href="{{ route('landlord.properties.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition transform hover:translate-x-1">All Properties</a>
                <a href="{{ route('landlord.properties.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition transform hover:translate-x-1">Add New</a>
            </div>
        </div>

        <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105 relative" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Communications</span>
            <span class="absolute top-2 right-2 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold animate-pulse">3</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-all duration-200 transform hover:scale-105" :class="!sidebarOpen && 'justify-center'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span x-show="sidebarOpen" x-transition class="font-medium">Documents</span>
        </a>
    </x-slot>

    {{-- Profile Links Slot --}}
    <x-slot name="profileLinks">
        <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>
        <a href="{{ route('landlord.properties.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            My Properties
        </a>
    </x-slot>

    {{-- Breadcrumbs --}}
    <x-slot name="breadcrumbs">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('landlord.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('landlord.properties.index') }}" class="ml-1 text-gray-700 hover:text-blue-600">My Properties</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-blue-600 font-medium">Edit Property</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    {{-- Header Actions --}}
    <x-slot name="headerActions">
        <a href="{{ route('landlord.properties.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Properties
        </a>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('landlord.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Title *</label>
                                <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="e.g., Modern 3BR Apartment in Downtown">
                                @error('title')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                                <textarea name="description" rows="4" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Describe your property in detail...">{{ old('description', $property->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Type *</label>
                                <select name="type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Type</option>
                                    <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="condo" {{ old('type', $property->type) == 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="townhouse" {{ old('type', $property->type) == 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                    <option value="studio" {{ old('type', $property->type) == 'studio' ? 'selected' : '' }}>Studio</option>
                                    <option value="villa" {{ old('type', $property->type) == 'villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="commercial" {{ old('type', $property->type) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                                @error('type')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Listing Type *</label>
                                <select name="listing_type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Listing Type</option>
                                    <option value="rent" {{ old('listing_type', $property->listing_type) == 'rent' ? 'selected' : '' }}>For Rent</option>
                                    <option value="sale" {{ old('listing_type', $property->listing_type) == 'sale' ? 'selected' : '' }}>For Sale</option>
                                </select>
                                @error('listing_type')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Location</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                <input type="text" name="address" value="{{ old('address', $property->address) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Street address">
                                @error('address')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" name="city" value="{{ old('city', $property->city) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                <input type="text" name="state" value="{{ old('state', $property->state) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('state')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code *</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code', $property->zip_code) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('zip_code')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                <input type="text" name="country" value="{{ old('country', $property->country) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('country')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Details</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bedrooms *</label>
                                <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" required min="0"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('bedrooms')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bathrooms *</label>
                                <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" required min="0" step="0.5"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('bathrooms')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Square Feet *</label>
                                <input type="number" name="square_feet" value="{{ old('square_feet', $property->square_feet) }}" required min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('square_feet')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Year Built</label>
                                <input type="number" name="year_built" value="{{ old('year_built', $property->year_built) }}" min="1800" max="{{ date('Y') + 1 }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('year_built')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Floors</label>
                                <input type="number" name="floors" value="{{ old('floors', $property->floors) }}" min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('floors')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Furnished *</label>
                                <select name="furnished" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="0" {{ old('furnished', $property->furnished) == '0' ? 'selected' : '' }}>Unfurnished</option>
                                    <option value="1" {{ old('furnished', $property->furnished) == '1' ? 'selected' : '' }}>Furnished</option>
                                </select>
                                @error('furnished')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pricing</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price (per month/total) *</label>
                                <input type="number" name="price" value="{{ old('price', $property->price) }}" required min="0" step="0.01"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('price')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Security Deposit</label>
                                <input type="number" name="security_deposit" value="{{ old('security_deposit', $property->security_deposit) }}" min="0" step="0.01"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('security_deposit')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Maintenance Fee</label>
                                <input type="number" name="maintenance_fee" value="{{ old('maintenance_fee', $property->maintenance_fee) }}" min="0" step="0.01"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('maintenance_fee')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Amenities</h3>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @php
                            $amenitiesList = ['parking', 'gym', 'pool', 'security', 'elevator', 'balcony', 'garden', 'pet_friendly', 'laundry', 'central_ac', 'heating', 'internet', 'cable_tv', 'dishwasher', 'microwave', 'refrigerator'];
                            $propertyAmenities = $property->amenities ?? [];
                            @endphp
                            @foreach($amenitiesList as $amenity)
                                <label class="flex items-center">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                        {{ in_array($amenity, old('amenities', $propertyAmenities)) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $amenity)) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Property Documents -->
                <div class="bg-yellow-50 border border-yellow-200 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">📄 Property Documents (Required for Verification)</h3>
                        <p class="text-sm text-gray-600 mb-4">Upload property documents for admin verification. Your property will be listed after verification.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ownership Document (Title Deed/Lease) *</label>
                                <input type="file" name="ownership_document" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                @error('ownership_document')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tax Receipt</label>
                                <input type="file" name="tax_receipt" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                @error('tax_receipt')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Insurance Document</label>
                                <input type="file" name="insurance_document" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                @error('insurance_document')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Building Permit</label>
                                <input type="file" name="building_permit" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                @error('building_permit')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Documents</label>
                                <input type="file" name="additional_documents[]" accept=".pdf,.jpg,.jpeg,.png" multiple
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">You can select multiple files. PDF, JPG, PNG (Max 5MB each)</p>
                                @error('additional_documents.*')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Images -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6" x-data="imageManager()">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Images</h3>
                        
                        <!-- Existing Images -->
                        @if($property->images && count($property->images) > 0)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($property->images as $index => $image)
                                        @php
                                            $imagePath = is_array($image) ? ($image['path'] ?? $image) : $image;
                                            $isFeatured = is_array($image) && isset($image['is_featured']) && $image['is_featured'];
                                        @endphp
                                        <div class="relative group" x-data="{ deleted: false }">
                                            <img src="{{ $imagePath }}" class="w-full h-40 object-cover rounded-lg border-2" 
                                                :class="deleted ? 'opacity-30 border-red-500' : '{{ $isFeatured ? "border-blue-500" : "border-gray-300" }}'">
                                            
                                            @if($isFeatured)
                                                <div class="absolute top-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                                    Featured
                                                </div>
                                            @endif
                                            
                                            <!-- Delete Overlay -->
                                            <div x-show="deleted" class="absolute inset-0 flex items-center justify-center bg-red-500 bg-opacity-20 rounded-lg">
                                                <span class="text-red-600 font-bold text-sm bg-white px-3 py-1 rounded">DELETED</span>
                                            </div>
                                            
                                            <!-- Action Buttons -->
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all rounded-lg flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100">
                                                <button type="button" @click="deleted = !deleted" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold">
                                                    <span x-text="deleted ? 'Undo' : 'Delete'"></span>
                                                </button>
                                            </div>
                                            
                                            <!-- Hidden input to track deletion -->
                                            <input type="hidden" :name="deleted ? 'delete_images[]' : ''" value="{{ $index }}">
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Click "Delete" to remove images. Click "Undo" to restore.</p>
                            </div>
                        @endif
                        
                        <!-- Add New Images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Add New Images</label>
                            <input type="file" accept="image/*" multiple
                                @change="handleFiles($event)"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">You can select multiple images. JPG, PNG (Max 5MB each)</p>
                            @error('images.*')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            <!-- New Images Preview Grid -->
                            <div x-show="newImages.length > 0" class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                                <template x-for="(image, index) in newImages" :key="index">
                                    <div class="relative group">
                                        <img :src="image.preview" class="w-full h-40 object-cover rounded-lg border-2" 
                                            :class="image.isFeatured ? 'border-blue-500' : 'border-gray-300'">
                                        
                                        <!-- Featured Badge -->
                                        <div x-show="image.isFeatured" class="absolute top-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                            Featured
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all rounded-lg flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100">
                                            <button type="button" @click="setFeatured(index)" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold">
                                                <span x-text="image.isFeatured ? 'Featured' : 'Set Featured'"></span>
                                            </button>
                                            <button type="button" @click="removeImage(index)" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold">
                                                Remove
                                            </button>
                                        </div>

                                        <!-- Hidden input for this image -->
                                        <input type="hidden" :name="'new_property_images[' + index + '][file]'" :value="image.base64">
                                        <input type="hidden" :name="'new_property_images[' + index + '][is_featured]'" :value="image.isFeatured ? '1' : '0'">
                                    </div>
                                </template>
                            </div>

                            <p x-show="newImages.length > 0" class="text-sm text-gray-600 mt-4">
                                <span class="font-semibold" x-text="newImages.length"></span> new image(s) selected.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Availability</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Available From</label>
                                <input type="date" name="available_from" value="{{ old('available_from', $property->available_from ? \Carbon\Carbon::parse($property->available_from)->format('Y-m-d') : '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('available_from')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lease Duration (months)</label>
                                <input type="number" name="lease_duration" value="{{ old('lease_duration', $property->lease_duration) }}" min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Leave empty for sale properties</p>
                                @error('lease_duration')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('landlord.properties.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                        Update Property
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function imageManager() {
            return {
                newImages: [],
                
                handleFiles(event) {
                    const files = Array.from(event.target.files);
                    
                    files.forEach((file, idx) => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            
                            reader.onload = (e) => {
                                this.newImages.push({
                                    preview: e.target.result,
                                    base64: e.target.result,
                                    isFeatured: false
                                });
                            };
                            
                            reader.readAsDataURL(file);
                        }
                    });
                },
                
                setFeatured(index) {
                    // Remove featured from all new images
                    this.newImages.forEach(img => img.isFeatured = false);
                    // Set this image as featured
                    this.newImages[index].isFeatured = true;
                },
                
                removeImage(index) {
                    this.newImages.splice(index, 1);
                }
            }
        }
    </script>
</x-app-dashboard>
