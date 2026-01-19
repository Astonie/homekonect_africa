@props(['size' => 'default', 'class' => ''])

@php
    $sizes = [
        'sm' => 'w-6 h-6',
        'default' => 'w-10 h-10',
        'lg' => 'w-16 h-16',
        'xl' => 'w-24 h-24',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['default'];

    // Check for custom logo from settings
    $customLogo = \App\Models\Setting::get('company_logo');
@endphp

@if($customLogo)
    <img src="{{ asset('storage/' . $customLogo) }}" alt="Company Logo" {{ $attributes->merge(['class' => "$sizeClass object-contain $class"]) }}>
@else
    <svg {{ $attributes->merge(['class' => "$sizeClass $class"]) }} viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Background Circle -->
        <circle cx="100" cy="100" r="95" fill="url(#gradient)" />

        <!-- House Icon -->
        <g transform="translate(50, 60)">
            <!-- Roof -->
            <path d="M50 20 L10 55 L20 55 L20 90 L80 90 L80 55 L90 55 Z" fill="white" opacity="0.95"/>

            <!-- House Body -->
            <rect x="25" y="55" width="50" height="35" fill="white" opacity="0.9"/>

            <!-- Door -->
            <rect x="42" y="68" width="16" height="22" rx="2" fill="currentColor" class="text-purple-600"/>

            <!-- Windows -->
            <rect x="32" y="60" width="10" height="10" rx="1" fill="currentColor" class="text-purple-400"/>
            <rect x="58" y="60" width="10" height="10" rx="1" fill="currentColor" class="text-purple-400"/>

            <!-- Connection Symbol (K) -->
            <path d="M85 65 L95 65 L95 75 M95 70 L100 65 M95 70 L100 75" stroke="white" stroke-width="3" stroke-linecap="round"/>
        </g>

        <!-- Gradient Definition -->
        <defs>
            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#8B5CF6;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#6366F1;stop-opacity:1" />
            </linearGradient>
        </defs>
    </svg>
@endif
