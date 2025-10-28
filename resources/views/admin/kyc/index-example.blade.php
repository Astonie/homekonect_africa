<x-app-dashboard 
    title="KYC Verifications" 
    subtitle="Review and manage user identity verifications" 
    role="admin">

    {{-- Breadcrumbs Slot --}}
    <x-slot:breadcrumbs>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600 transition">
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
                        <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">KYC Verifications</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot:breadcrumbs>

    {{-- Header Actions Slot --}}
    <x-slot:headerActions>
        <div class="flex items-center space-x-3">
            <!-- Status Filter -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span class="font-medium">Filter Status</span>
                </button>
                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                    <div class="p-2">
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg">All Submissions</a>
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg">Pending Review</a>
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg">Approved</a>
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg">Rejected</a>
                    </div>
                </div>
            </div>

            <!-- Export Button -->
            <button class="flex items-center space-x-2 bg-gradient-to-r from-orange-600 to-red-600 text-white px-6 py-2 rounded-lg hover:from-orange-700 hover:to-red-700 transition shadow-md hover:shadow-lg transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                <span class="font-semibold">Export Report</span>
            </button>
        </div>
    </x-slot:headerActions>

    {{-- Main Content --}}
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Pending Review</div>
                    <div class="text-3xl font-bold">{{ $stats['pending'] ?? 0 }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-ping"></span>
                <span>Requires attention</span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Approved</div>
                    <div class="text-3xl font-bold">{{ $stats['approved'] ?? 0 }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <span>Verified users</span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Rejected</div>
                    <div class="text-3xl font-bold">{{ $stats['rejected'] ?? 0 }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <span>Failed verification</span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium opacity-90">Total Submissions</div>
                    <div class="text-3xl font-bold">{{ $stats['total'] ?? 0 }}</div>
                </div>
            </div>
            <div class="flex items-center text-sm opacity-90">
                <span>All time</span>
            </div>
        </div>
    </div>

    <!-- KYC Submissions Grid -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                KYC Submissions
            </h3>
        </div>

        @forelse($kyc_submissions ?? [] as $kyc)
            <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-xl p-6 border-2 border-orange-200 hover:border-orange-300 hover:shadow-lg transition-all duration-200 mb-4 group">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
                            {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-lg group-hover:text-orange-700 transition">{{ $kyc->user->name }}</div>
                            <div class="text-sm text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $kyc->user->email }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">User ID: #{{ $kyc->user->id }}</div>
                        </div>
                    </div>

                    <!-- KYC Details -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Document Type</div>
                            <div class="text-sm font-semibold text-gray-900">{{ ucfirst($kyc->document_type) }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Submitted</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $kyc->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $kyc->created_at->diffForHumans() }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Status</div>
                            @if($kyc->status == 'pending')
                                <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-sm flex items-center w-fit">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                                    Pending
                                </span>
                            @elseif($kyc->status == 'approved')
                                <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-sm">
                                    ✓ Approved
                                </span>
                            @else
                                <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-sm">
                                    ✗ Rejected
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div>
                        <a href="{{ route('admin.kyc.show', $kyc->id) }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-orange-600 to-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-orange-700 hover:to-red-700 transition shadow-md hover:shadow-lg transform group-hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>Review Details</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-100 to-emerald-200 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-gray-600 font-medium text-lg">All caught up!</p>
                <p class="text-gray-500 text-sm mt-2">No KYC submissions to review at the moment.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        @if(isset($kyc_submissions) && $kyc_submissions->hasPages())
        <div class="mt-6 pt-6 border-t border-gray-200">
            {{ $kyc_submissions->links() }}
        </div>
        @endif
    </div>

</x-app-dashboard>
