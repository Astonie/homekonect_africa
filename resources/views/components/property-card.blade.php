@props([
    'property',
    'layout' => 'default', // 'default', 'compact', 'featured'
    'showOwner' => true,
    'showViewDetails' => true
])

@php
    $imageUrl = $property->images && count($property->images) > 0
        ? (str_starts_with($property->images[0], 'http') ? $property->images[0] : asset('storage/' . $property->images[0]))
        : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';

    $formattedPrice = $property->listing_type === 'rent'
        ? '$' . number_format($property->price)
        : '$' . number_format($property->price);
@endphp

<div class="bg-background rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group {{ $layout === 'compact' ? 'h-full' : '' }}">
    <!-- Image Section -->
    <div class="relative {{ $layout === 'compact' ? 'h-48' : 'h-48' }} overflow-hidden">
        <img src="{{ $imageUrl }}" alt="{{ $property->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

        <!-- Status Badges -->
        <div class="absolute top-3 left-3">
            <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                Available
            </span>
        </div>

        @if($property->is_verified ?? false)
        <div class="absolute top-3 right-3 bg-blue-500 text-white p-1 rounded-full shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        @endif

        @if($layout === 'featured' && ($property->is_featured ?? false))
        <div class="absolute top-3 right-3 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
            Featured
        </div>
        @endif
    </div>

    <!-- Content Section -->
    <div class="p-5">
        <!-- Header -->
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-text-secondary bg-secondary px-2 py-1 rounded-full">{{ ucfirst($property->type) }}</span>
            <span class="text-lg font-bold text-primary">
                {{ $formattedPrice }}
            </span>
        </div>

        <!-- Title -->
        <h3 class="text-lg font-bold text-text-primary mb-2 {{ $layout === 'compact' ? 'line-clamp-2' : 'line-clamp-2' }}">
            {{ $property->title }}
        </h3>

        <!-- Location -->
        <p class="text-text-secondary text-sm mb-3 flex items-center">
            <svg class="w-4 h-4 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ $property->city }}, {{ $property->state }}
        </p>

        <!-- Property Details -->
        <div class="flex items-center justify-between text-sm text-text-secondary mb-4">
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

        <!-- Owner and Action Section -->
        @if($showOwner && isset($property->owner))
        <div class="flex items-center justify-between pt-4 border-t border-border/30">
            <div class="flex items-center text-sm text-text-secondary">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                    <span class="text-background font-semibold text-sm">{{ substr($property->owner->name, 0, 1) }}</span>
                </div>
                <span>{{ $property->owner->name }}</span>
            </div>

            @if($showViewDetails)
            <a href="{{ route('property.details', $property) }}"
               class="bg-primary hover:bg-primary/90 text-background py-2 px-4 rounded-lg font-semibold text-sm transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                View
            </a>
            @endif
        </div>
        @elseif($showViewDetails)
        <div class="pt-4 border-t border-border/30">
            <a href="{{ route('property.details', $property) }}"
               class="w-full bg-primary hover:bg-primary/90 text-background py-2 px-4 rounded-lg font-semibold text-sm transition-all duration-200 text-center block shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                View Details
            </a>
        </div>
        @endif
    </div>
</div>