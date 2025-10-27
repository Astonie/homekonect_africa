@extends('layouts.public')

@section('title', $property->title . ' - Home Konnect Africa')

@section('content')
    <!-- Hero Image Section -->
    <section class="relative">
        <div class="relative h-96 lg:h-[600px] overflow-hidden">
            @if($property->images && count($property->images) > 0)
                <img src="{{ $property->images[0] }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
            @else
                <img src="https://via.placeholder.com/1200x600?text=No+Image+Available" alt="No image available" class="w-full h-full object-cover">
            @endif

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

            <!-- Back Button -->
            <div class="absolute top-6 left-6 z-10">
                <a href="{{ url()->previous() }}" class="bg-black/50 hover:bg-black/70 text-white px-4 py-2 rounded-lg backdrop-blur-sm transition-all duration-200 flex items-center space-x-2 shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="font-medium">Back</span>
                </a>
            </div>

            <!-- Property Badges -->
            <div class="absolute top-28 right-6 z-10 flex flex-row space-x-2">
                @if($property->is_featured)
                    <span class="bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span>Featured</span>
                    </span>
                @endif
                @if($property->is_verified)
                    <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Verified</span>
                    </span>
                @endif
                <span class="bg-primary text-background px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                    {{ ucfirst($property->listing_type) }}
                </span>
            </div>

            <!-- Property Info Overlay -->
            <div class="absolute bottom-6 left-6 right-6 z-10">
                <div class="bg-black/60 backdrop-blur-sm rounded-xl p-6 text-white">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between">
                        <div class="mb-4 lg:mb-0">
                            <h1 class="text-2xl lg:text-3xl font-bold mb-2">{{ $property->title }}</h1>
                            <div class="flex items-center text-white/90 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</span>
                            </div>
                            <div class="flex items-center space-x-6 text-sm">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0M8 5a2 2 0 012-2h4a2 2 0 012 2v0"></path>
                                    </svg>
                                    {{ $property->bedrooms }} Beds
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    {{ $property->bathrooms }} Baths
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    {{ number_format($property->square_feet) }} sqft
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $property->formatted_price }}</div>
                            @if($property->listing_type === 'rent')
                                <div class="text-white/80 text-sm">per month</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Property Details -->
    <section class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Property Overview -->
                    <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Property Overview</h2>

                        <!-- Location -->
                        <div class="flex items-center text-text-secondary mb-6">
                            <svg class="w-5 h-5 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-lg">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}, {{ $property->country }}</span>
                        </div>

                        <!-- Key Stats -->
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="text-center p-4 bg-secondary rounded-xl border border-border/50">
                                <div class="text-3xl font-bold text-primary mb-1">{{ $property->bedrooms }}</div>
                                <div class="text-sm text-text-secondary font-medium">Bedrooms</div>
                            </div>
                            <div class="text-center p-4 bg-secondary rounded-xl border border-border/50">
                                <div class="text-3xl font-bold text-primary mb-1">{{ $property->bathrooms }}</div>
                                <div class="text-sm text-text-secondary font-medium">Bathrooms</div>
                            </div>
                            <div class="text-center p-4 bg-secondary rounded-xl border border-border/50">
                                <div class="text-3xl font-bold text-primary mb-1">{{ number_format($property->square_feet) }}</div>
                                <div class="text-sm text-text-secondary font-medium">Sq Ft</div>
                            </div>
                            <div class="text-center p-4 bg-secondary rounded-xl border border-border/50">
                                <div class="text-3xl font-bold text-primary mb-1">{{ $property->year_built ?? 'N/A' }}</div>
                                <div class="text-sm text-text-secondary font-medium">Year Built</div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                        <h2 class="text-2xl font-bold text-text-primary mb-4">Description</h2>
                        <div class="prose prose-lg text-text-secondary max-w-none">
                            {!! nl2br(e($property->description)) !!}
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Property Details</h2>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-5">
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Property Type</div>
                                            <div class="font-semibold text-text-primary">{{ ucfirst($property->type) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Listing Type</div>
                                            <div class="font-semibold text-text-primary">{{ ucfirst($property->listing_type) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Year Built</div>
                                            <div class="font-semibold text-text-primary">{{ $property->year_built ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Floors</div>
                                            <div class="font-semibold text-text-primary">{{ $property->floors ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-5">
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Furnished</div>
                                            <div class="font-semibold text-text-primary">{{ $property->furnished ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Available From</div>
                                            <div class="font-semibold text-text-primary">{{ $property->available_from ? $property->available_from->format('M j, Y') : 'Immediately' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Lease Duration</div>
                                            <div class="font-semibold text-text-primary">{{ $property->lease_duration ?? 'Flexible' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-text-secondary">Square Feet</div>
                                            <div class="font-semibold text-text-primary">{{ number_format($property->square_feet) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amenities -->
                    @if($property->amenities && count($property->amenities) > 0)
                        <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-text-primary">Amenities & Features</h2>
                                <span class="text-sm text-text-secondary bg-secondary px-3 py-1 rounded-full">
                                    {{ count($property->amenities) }} amenities
                                </span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($property->amenities as $amenity)
                                    <div class="flex items-center space-x-3 p-3 bg-secondary/50 rounded-lg border border-border/30">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-text-primary font-medium text-sm">{{ ucfirst($amenity) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Virtual Tour -->
                    @if($property->virtual_tour_url)
                        <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                            <h2 class="text-2xl font-bold text-text-primary mb-4">Virtual Tour</h2>
                            <div class="aspect-video">
                                <iframe src="{{ $property->virtual_tour_url }}" class="w-full h-full rounded-lg" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                    <!-- Property Gallery -->
                    @if($property->images && count($property->images) > 1)
                        <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-text-primary">Property Gallery</h2>
                                <span class="text-sm text-text-secondary bg-secondary px-3 py-1 rounded-full">
                                    {{ count($property->images) }} photos
                                </span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($property->images as $index => $image)
                                    <div class="group relative aspect-square overflow-hidden rounded-lg cursor-pointer">
                                        <img src="{{ $image }}" alt="Property image {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                                        @if($index === 0)
                                            <div class="absolute top-2 right-2 bg-primary text-background text-xs px-2 py-1 rounded-full font-semibold">
                                                Hero
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Contact Agent -->
                    <div class="bg-background border border-border rounded-xl p-6 shadow-sm sticky top-6">
                        <div class="text-center mb-6">
                            <h3 class="text-xl font-bold text-text-primary mb-2">Contact Agent</h3>
                            <p class="text-sm text-text-secondary">Get in touch for more details</p>
                        </div>

                        <div class="flex items-center space-x-4 mb-6 p-4 bg-secondary/50 rounded-lg">
                            <div class="w-14 h-14 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-background font-bold text-xl">{{ substr($property->owner->name, 0, 1) }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="font-semibold text-text-primary text-lg">{{ $property->owner->name }}</div>
                                <div class="text-sm text-text-secondary">Property Owner</div>
                                @if($property->owner->email)
                                    <div class="text-xs text-primary mt-1">{{ $property->owner->email }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button class="w-full bg-primary hover:bg-primary/90 text-background py-3 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>Call Agent</span>
                            </button>
                            <button class="w-full bg-secondary hover:bg-secondary/80 text-text-primary py-3 px-4 rounded-lg font-semibold transition-all duration-200 border border-border flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>Send Message</span>
                            </button>
                            <button class="w-full bg-accent hover:bg-accent/90 text-background py-3 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Schedule Viewing</span>
                            </button>
                        </div>

                        <!-- Property Stats -->
                        <div class="mt-6 pt-6 border-t border-border">
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="text-text-secondary">Views</span>
                                    </div>
                                    <span class="font-semibold text-text-primary">{{ $property->views }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-text-secondary">Listed</span>
                                    </div>
                                    <span class="font-semibold text-text-primary">{{ $property->published_at ? $property->published_at->diffForHumans() : 'Recently' }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-text-secondary">Status</span>
                                    </div>
                                    <span class="font-semibold text-success-600">{{ ucfirst($property->status) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Details -->
                    @if($property->listing_type === 'rent')
                        <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-text-primary">Pricing Breakdown</h3>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-primary">{{ $property->formatted_price }}</div>
                                    <div class="text-sm text-text-secondary">per month</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-3 border-b border-border/50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                        <span class="text-text-secondary">Monthly Rent</span>
                                    </div>
                                    <span class="font-semibold text-text-primary">{{ $property->formatted_price }}</span>
                                </div>
                                @if($property->security_deposit)
                                    <div class="flex items-center justify-between py-3 border-b border-border/50">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-text-secondary">Security Deposit</span>
                                        </div>
                                        <span class="font-semibold text-text-primary">${{ number_format($property->security_deposit, 2) }}</span>
                                    </div>
                                @endif
                                @if($property->maintenance_fee)
                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-text-secondary">Maintenance Fee</span>
                                        </div>
                                        <span class="font-semibold text-text-primary">${{ number_format($property->maintenance_fee, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Share Property -->
                    <div class="bg-background border border-border rounded-xl p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-text-primary">Share Property</h3>
                            <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <button class="flex flex-col items-center space-y-2 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 group">
                                <svg class="w-6 h-6 text-blue-600 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span class="text-xs font-medium text-blue-700">Facebook</span>
                            </button>
                            <button class="flex flex-col items-center space-y-2 p-3 bg-sky-50 hover:bg-sky-100 rounded-lg transition-colors duration-200 group">
                                <svg class="w-6 h-6 text-sky-600 group-hover:text-sky-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                <span class="text-xs font-medium text-sky-700">Twitter</span>
                            </button>
                            <button class="flex flex-col items-center space-y-2 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200 group">
                                <svg class="w-6 h-6 text-green-600 group-hover:text-green-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                <span class="text-xs font-medium text-green-700">WhatsApp</span>
                            </button>
                        </div>
                        <div class="mt-4 pt-4 border-t border-border">
                            <button class="w-full flex items-center justify-center space-x-2 py-2 px-4 bg-secondary hover:bg-secondary/80 rounded-lg transition-colors duration-200 text-text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium">Copy Link</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Properties -->
    <section class="py-12 bg-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-text-primary">Similar Properties</h2>
                <a href="/" class="text-primary hover:text-primary/80 font-semibold flex items-center space-x-2 transition-colors duration-200">
                    <span>View All Properties</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if($similarProperties->count() > 0)
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-3 gap-6">
                    @foreach($similarProperties as $index => $similarProperty)
                        <div class="bg-background rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group {{ $index >= 3 ? 'lg:hidden' : '' }}">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $similarProperty->first_image }}" alt="{{ $similarProperty->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @if($similarProperty->is_featured)
                                    <span class="absolute top-3 left-3 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                        Featured
                                    </span>
                                @endif
                                @if($similarProperty->is_verified)
                                    <span class="absolute top-3 right-3 bg-green-500 text-white p-1 rounded-full shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-text-secondary bg-secondary px-2 py-1 rounded-full">{{ ucfirst($similarProperty->type) }}</span>
                                    <span class="text-lg font-bold text-primary">{{ $similarProperty->formatted_price }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-text-primary mb-2 line-clamp-2">{{ $similarProperty->title }}</h3>
                                <p class="text-text-secondary text-sm mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $similarProperty->city }}, {{ $similarProperty->state }}
                                </p>
                                <div class="flex items-center justify-between text-sm text-text-secondary mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0M8 5a2 2 0 012-2h4a2 2 0 012 2v0"></path>
                                        </svg>
                                        {{ $similarProperty->bedrooms }} Beds
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        {{ $similarProperty->bathrooms }} Baths
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        {{ number_format($similarProperty->square_feet) }} sqft
                                    </span>
                                </div>
                                <a href="{{ route('property.details', $similarProperty) }}" class="w-full bg-primary hover:bg-primary/90 text-background py-2 px-4 rounded-lg font-semibold text-sm transition-all duration-200 text-center block shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-text-secondary/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-text-primary mb-2">No Similar Properties Found</h3>
                    <p class="text-text-secondary">Check back later for more listings in this area.</p>
                    <div class="mt-6">
                        <a href="/" class="inline-block bg-primary hover:bg-primary/90 text-background px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                            Browse All Properties
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection