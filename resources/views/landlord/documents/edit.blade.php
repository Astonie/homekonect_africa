<x-app-dashboard 
    title="Edit Document" 
    subtitle="Update document information"
    role="landlord">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.landlord active="documents" />
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Edit Document</h2>
            </div>
            
            <form action="{{ route('landlord.documents.update', $document) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Document Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Document Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $document->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Document Type -->
                <div>
                    <label for="document_type" class="block text-sm font-semibold text-gray-700 mb-2">Document Type *</label>
                    <select id="document_type" name="document_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('document_type') border-red-500 @enderror">
                        <option value="">Select document type...</option>
                        <option value="ownership_deed" {{ old('document_type', $document->document_type) == 'ownership_deed' ? 'selected' : '' }}>Ownership Deed</option>
                        <option value="tax_receipt" {{ old('document_type', $document->document_type) == 'tax_receipt' ? 'selected' : '' }}>Tax Receipt</option>
                        <option value="noc" {{ old('document_type', $document->document_type) == 'noc' ? 'selected' : '' }}>NOC (No Objection Certificate)</option>
                        <option value="insurance" {{ old('document_type', $document->document_type) == 'insurance' ? 'selected' : '' }}>Insurance Document</option>
                        <option value="survey_plan" {{ old('document_type', $document->document_type) == 'survey_plan' ? 'selected' : '' }}>Survey Plan</option>
                        <option value="building_approval" {{ old('document_type', $document->document_type) == 'building_approval' ? 'selected' : '' }}>Building Approval</option>
                        <option value="utility_bill" {{ old('document_type', $document->document_type) == 'utility_bill' ? 'selected' : '' }}>Utility Bill</option>
                        <option value="lease_agreement" {{ old('document_type', $document->document_type) == 'lease_agreement' ? 'selected' : '' }}>Lease Agreement</option>
                        <option value="other" {{ old('document_type', $document->document_type) == 'other' ? 'selected' : '' }}>Other Document</option>
                    </select>
                    @error('document_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current File Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Current File</p>
                                <p class="text-sm text-gray-600">{{ $document->file_name }} ({{ $document->formatted_file_size }})</p>
                            </div>
                        </div>
                        <a href="{{ route('landlord.documents.download', $document) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Download
                        </a>
                    </div>
                </div>

                <!-- File Upload (Optional) -->
                <div>
                    <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">Replace File (Optional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition @error('file') border-red-500 @enderror">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a file</span>
                                    <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG up to 10MB</p>
                        </div>
                    </div>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $document->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expiry Date -->
                <div>
                    <label for="expiry_date" class="block text-sm font-semibold text-gray-700 mb-2">Expiry Date (Optional)</label>
                    <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $document->expiry_date?->format('Y-m-d')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('expiry_date') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Set an expiry date for documents like insurance, tax receipts, etc.</p>
                    @error('expiry_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('landlord.documents.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-medium shadow-lg">
                        Update Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-dashboard>
