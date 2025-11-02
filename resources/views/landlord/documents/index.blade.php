<x-app-dashboard 
    title="My Documents" 
    subtitle="Manage all your property documents in one place. Upload and organize documents for easy access when listing properties."
    role="landlord">
    
    {{-- Navigation Slot --}}
    <x-slot name="navigation">
        <x-navigation.landlord active="documents" />
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Documents -->
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm p-6 border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Total</span>
            </div>
            <div class="text-sm text-gray-600 mb-1">Total Documents</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</div>
        </div>

        <!-- Expired Documents -->
        <div class="bg-gradient-to-br from-white to-red-50 rounded-xl shadow-sm p-6 border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">Alert</span>
            </div>
            <div class="text-sm text-gray-600 mb-1">Expired Documents</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['expired'] }}</div>
        </div>

        <!-- Expiring Soon -->
        <div class="bg-gradient-to-br from-white to-yellow-50 rounded-xl shadow-sm p-6 border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">30 Days</span>
            </div>
            <div class="text-sm text-gray-600 mb-1">Expiring Soon</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['expiring_soon'] }}</div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <form method="GET" class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" placeholder="Search documents..." value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    
                    <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Types</option>
                        <option value="ownership_deed" {{ request('type') == 'ownership_deed' ? 'selected' : '' }}>Ownership Deed</option>
                        <option value="tax_receipt" {{ request('type') == 'tax_receipt' ? 'selected' : '' }}>Tax Receipt</option>
                        <option value="noc" {{ request('type') == 'noc' ? 'selected' : '' }}>NOC</option>
                        <option value="insurance" {{ request('type') == 'insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="survey_plan" {{ request('type') == 'survey_plan' ? 'selected' : '' }}>Survey Plan</option>
                        <option value="building_approval" {{ request('type') == 'building_approval' ? 'selected' : '' }}>Building Approval</option>
                        <option value="utility_bill" {{ request('type') == 'utility_bill' ? 'selected' : '' }}>Utility Bill</option>
                        <option value="lease_agreement" {{ request('type') == 'lease_agreement' ? 'selected' : '' }}>Lease Agreement</option>
                        <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Filter
                    </button>
                </form>
            </div>
            
            <a href="{{ route('landlord.documents.create') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-semibold">Upload Document</span>
            </a>
        </div>
    </div>

    <!-- Documents Grid -->
    @if($documents->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($documents as $document)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Document Icon/Type -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 flex items-center justify-center">
                        @if(in_array($document->file_extension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ Storage::url($document->file_path) }}" alt="{{ $document->title }}" class="h-32 w-full object-cover rounded-lg">
                        @else
                            <div class="w-20 h-20 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Document Info -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 truncate flex-1">{{ $document->title }}</h3>
                            @if($document->isExpired())
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Expired</span>
                            @elseif($document->expiry_date && $document->expiry_date->diffInDays(now()) <= 30)
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Expiring</span>
                            @endif
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-3">{{ $document->getDocumentTypeLabel() }}</p>
                        
                        @if($document->description)
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $document->description }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <span>{{ $document->formatted_file_size }}</span>
                            <span>{{ $document->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        @if($document->expiry_date)
                            <div class="mb-4 p-2 bg-gray-50 rounded-lg">
                                <div class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Expires: {{ $document->expiry_date->format('M d, Y') }}
                                </div>
                            </div>
                        @endif
                        
                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('landlord.documents.download', $document) }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center text-sm font-medium">
                                Download
                            </a>
                            <a href="{{ route('landlord.documents.edit', $document) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                Edit
                            </a>
                            <form action="{{ route('landlord.documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $documents->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-100">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No documents yet</h3>
            <p class="text-gray-600 mb-6">Start uploading your property documents to keep them organized and ready for property listings.</p>
            <a href="{{ route('landlord.documents.create') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Upload Your First Document</span>
            </a>
        </div>
    @endif
</x-app-dashboard>
