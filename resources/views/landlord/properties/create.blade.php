<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Property') }}
            </h2>
            <a href="{{ route('landlord.properties.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Properties
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('landlord.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Title *</label>
                                <input type="text" name="title" value="{{ old('title') }}" required
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
                                    placeholder="Describe your property in detail...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Type *</label>
                                <select name="type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Type</option>
                                    <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="condo" {{ old('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="townhouse" {{ old('type') == 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                    <option value="studio" {{ old('type') == 'studio' ? 'selected' : '' }}>Studio</option>
                                    <option value="villa" {{ old('type') == 'villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                                @error('type')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Listing Type *</label>
                                <select name="listing_type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Listing Type</option>
                                    <option value="rent" {{ old('listing_type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                                    <option value="sale" {{ old('listing_type') == 'sale' ? 'selected' : '' }}>For Sale</option>
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
                                <input type="text" name="address" value="{{ old('address') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Street address">
                                @error('address')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" name="city" value="{{ old('city') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                <input type="text" name="state" value="{{ old('state') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('state')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code *</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('zip_code')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                <input type="text" name="country" value="{{ old('country', 'USA') }}" required
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
                                <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" required min="0"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('bedrooms')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bathrooms *</label>
                                <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" required min="0" step="0.5"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('bathrooms')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Square Feet *</label>
                                <input type="number" name="square_feet" value="{{ old('square_feet') }}" required min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('square_feet')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Year Built</label>
                                <input type="number" name="year_built" value="{{ old('year_built') }}" min="1800" max="{{ date('Y') + 1 }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('year_built')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Floors</label>
                                <input type="number" name="floors" value="{{ old('floors') }}" min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('floors')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Furnished *</label>
                                <select name="furnished" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="0" {{ old('furnished') == '0' ? 'selected' : '' }}>Unfurnished</option>
                                    <option value="1" {{ old('furnished') == '1' ? 'selected' : '' }}>Furnished</option>
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
                                <input type="number" name="price" value="{{ old('price') }}" required min="0" step="0.01"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('price')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Security Deposit</label>
                                <input type="number" name="security_deposit" value="{{ old('security_deposit') }}" min="0" step="0.01"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('security_deposit')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Maintenance Fee</label>
                                <input type="number" name="maintenance_fee" value="{{ old('maintenance_fee') }}" min="0" step="0.01"
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
                            @endphp
                            @foreach($amenitiesList as $amenity)
                                <label class="flex items-center">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                        {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}
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
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Images</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Images</label>
                            <input type="file" name="images[]" accept="image/*" multiple
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">You can select multiple images. JPG, PNG (Max 5MB each)</p>
                            @error('images.*')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                                <input type="date" name="available_from" value="{{ old('available_from') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('available_from')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lease Duration (months)</label>
                                <input type="number" name="lease_duration" value="{{ old('lease_duration') }}" min="1"
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
                        Create Property
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
