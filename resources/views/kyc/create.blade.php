<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('KYC Verification') }}
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

                    @if(session('error'))
                        <div class="mb-6 rounded-lg border border-red-200 dark:border-red-900/40 bg-red-50 dark:bg-red-900/40 p-4 text-red-800 dark:text-red-300">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 dark:border-red-900/40 bg-red-50 dark:bg-red-900/40 p-4 text-red-800 dark:text-red-300">
                            <div class="font-semibold mb-2">Please fix the following errors:</div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                       <div x-data="imagePreview()">
                        </div>
                                           <input type="file" name="id_front_image" accept="image/*" {{ $existingKyc ? '' : 'required' }}
                                               @change="showPreview($event)"
                                               class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">

                                           <div x-show="imageUrl" class="mt-3">
                                               <img :src="imageUrl" class="max-w-xs rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm">
                                           </div>
                    @if($existingKyc && $existingKyc->status === 'rejected')
                                       <div x-data="imagePreview()">
                            <div class="font-semibold mb-2">Your previous submission was rejected</div>
                                           <input type="file" name="id_back_image" accept="image/*"
                                               @change="showPreview($event)"
                                               class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                            <p>Please review the feedback and resubmit your documents.</p>
                                           <div x-show="imageUrl" class="mt-3">
                                               <img :src="imageUrl" class="max-w-xs rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm">
                                           </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Welcome to KYC Verification</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            To list properties on HomeKonnect, we need to verify your identity. Please provide the following information and documents.
                                   <div x-data="imagePreview()">
                        </p>
                                       <input type="file" name="selfie_image" accept="image/*" {{ $existingKyc ? '' : 'required' }}
                                           @change="showPreview($event)"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">

                                       <div x-show="imageUrl" class="mt-3">
                                           <img :src="imageUrl" class="max-w-xs rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm">
                                       </div>
                    <form method="POST" action="{{ route('kyc.submit') }}" enctype="multipart/form-data" class="space-y-8" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf

                        <!-- Personal Information -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                            <h4 class="text-lg font-semibold mb-4">Personal Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if(auth()->user()->isAgent())
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-2">Business Name (if applicable)</label>
                                        <input type="text" name="business_name" value="{{ old('business_name', $existingKyc->business_name ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-2">License Number</label>
                                        <input type="text" name="license_number" value="{{ old('license_number', $existingKyc->license_number ?? '') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    </div>
                                       <div x-data="imagePreview()">
                                <div>
                                           <input type="file" name="proof_of_address_image" accept="image/*,application/pdf" {{ $existingKyc ? '' : 'required' }}
                                               @change="showPreview($event)"
                                               class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    <input type="text" name="tax_id" value="{{ old('tax_id', $existingKyc->tax_id ?? '') }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                           <div x-show="imageUrl" class="mt-3">
                                               <img :src="imageUrl" class="max-w-xs rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm">
                                           </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2">Business Address <span class="text-red-500">*</span></label>
                                    <textarea name="business_address" rows="2" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">{{ old('business_address', $existingKyc->business_address ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

           <script>
               function imagePreview() {
                   return {
                       imageUrl: null,
                       showPreview(event) {
                           const file = event.target.files[0];
                           if (file && file.type.startsWith('image/')) {
                               const reader = new FileReader();
                               reader.onload = (e) => {
                                   this.imageUrl = e.target.result;
                               };
                               reader.readAsDataURL(file);
                           } else {
                               this.imageUrl = null;
                           }
                       }
                   }
               }
           </script>

                        <!-- ID Document -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                            <h4 class="text-lg font-semibold mb-4">Identity Document</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">ID Type <span class="text-red-500">*</span></label>
                                    <select name="id_type" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        <option value="">Select ID Type</option>
                                        <option value="passport" {{ old('id_type', $existingKyc->id_type ?? '') === 'passport' ? 'selected' : '' }}>Passport</option>
                                        <option value="national_id" {{ old('id_type', $existingKyc->id_type ?? '') === 'national_id' ? 'selected' : '' }}>National ID</option>
                                        <option value="drivers_license" {{ old('id_type', $existingKyc->id_type ?? '') === 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">ID Number <span class="text-red-500">*</span></label>
                                    <input type="text" name="id_number" value="{{ old('id_number', $existingKyc->id_number ?? '') }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">ID Front Image <span class="text-red-500">*</span></label>
                                    <input type="file" name="id_front_image" accept="image/*" {{ $existingKyc ? '' : 'required' }} class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Clear photo of the front of your ID (max 5MB)</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">ID Back Image</label>
                                    <input type="file" name="id_back_image" accept="image/*" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Clear photo of the back of your ID (max 5MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Selfie -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                            <h4 class="text-lg font-semibold mb-4">Selfie Verification</h4>
                            <div>
                                <label class="block text-sm font-medium mb-2">Selfie with ID <span class="text-red-500">*</span></label>
                                <input type="file" name="selfie_image" accept="image/*" {{ $existingKyc ? '' : 'required' }} class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Take a selfie holding your ID next to your face (max 5MB)</p>
                            </div>
                        </div>

                        <!-- Proof of Address -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                            <h4 class="text-lg font-semibold mb-4">Proof of Address</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Document Type <span class="text-red-500">*</span></label>
                                    <select name="proof_of_address_type" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        <option value="">Select Document Type</option>
                                        <option value="utility_bill" {{ old('proof_of_address_type', $existingKyc->proof_of_address_type ?? '') === 'utility_bill' ? 'selected' : '' }}>Utility Bill</option>
                                        <option value="bank_statement" {{ old('proof_of_address_type', $existingKyc->proof_of_address_type ?? '') === 'bank_statement' ? 'selected' : '' }}>Bank Statement</option>
                                        <option value="lease_agreement" {{ old('proof_of_address_type', $existingKyc->proof_of_address_type ?? '') === 'lease_agreement' ? 'selected' : '' }}>Lease Agreement</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Upload Document <span class="text-red-500">*</span></label>
                                    <input type="file" name="proof_of_address_image" accept="image/*,application/pdf" {{ $existingKyc ? '' : 'required' }} class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Document not older than 3 months (max 5MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Agent-specific Documents -->
                        @if(auth()->user()->isAgent())
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                                <h4 class="text-lg font-semibold mb-4">Professional Documents (Agent)</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Professional License</label>
                                        <input type="file" name="professional_license_image" accept="image/*,application/pdf" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Real estate agent license (max 5MB)</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Certifications (Optional)</label>
                                        <input type="file" name="certification_documents[]" accept="image/*,application/pdf" multiple class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Any professional certifications (max 5MB each)</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Landlord-specific Documents -->
                        @if(auth()->user()->isLandlord())
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                                <h4 class="text-lg font-semibold mb-4">Property Ownership Documents (Landlord)</h4>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Ownership Documents (Optional)</label>
                                    <input type="file" name="property_ownership_documents[]" accept="image/*,application/pdf" multiple class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Property deeds, titles, or ownership certificates (max 5MB each)</p>
                                </div>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                ← Back to Dashboard
                            </a>
                            <button type="submit" :disabled="submitting" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                                <svg x-show="submitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="submitting ? 'Submitting...' : 'Submit KYC Verification'"></span>
                            </button>
                        </div>

                        <!-- Loading Overlay -->
                        <div x-show="submitting" x-cloak class="fixed inset-0 bg-gray-900 dark:bg-gray-950 bg-opacity-75 flex items-center justify-center z-50">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-8 max-w-sm w-full mx-4 text-center border border-gray-200 dark:border-gray-700">
                                <div class="mb-4">
                                    <svg class="animate-spin h-12 w-12 text-blue-600 dark:text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Submitting KYC</h3>
                                <p class="text-gray-600 dark:text-gray-400">Please wait while we upload your documents...</p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
