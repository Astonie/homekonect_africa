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
    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => "$sizeClass $class"]) }}>
        <!-- African continent silhouette background -->
        <g opacity="0.15">
            <path fill="currentColor" d="M85 35 Q75 25, 70 30 T60 45 Q55 55, 58 65 T70 85 Q75 95, 80 105 T90 125 Q95 135, 100 145 T105 165 Q110 175, 105 180 Q100 185, 90 180 T70 170 Q60 165, 55 160 T50 150 Q45 140, 50 130 T60 110 Q55 100, 50 90 T40 70 Q35 60, 40 50 T55 30 Q65 20, 75 25 T85 35"/>
        </g>

        <!-- Main house structure -->
        <g>
            <!-- House roof -->
            <path fill="currentColor" d="M100 45 L140 75 L140 85 L60 85 L60 75 Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>

            <!-- House body -->
            <rect x="65" y="85" width="70" height="70" fill="currentColor" stroke="currentColor" stroke-width="2"/>

            <!-- Door -->
            <rect x="85" y="120" width="30" height="35" fill="none" stroke="white" stroke-width="2.5" rx="2"/>

            <!-- Door handle -->
            <circle cx="107" cy="137" r="2" fill="white"/>

            <!-- Windows - left -->
            <rect x="72" y="95" width="20" height="18" fill="none" stroke="white" stroke-width="2" rx="1"/>
            <line x1="82" y1="95" x2="82" y2="113" stroke="white" stroke-width="1.5"/>
            <line x1="72" y1="104" x2="92" y2="104" stroke="white" stroke-width="1.5"/>

            <!-- Windows - right -->
            <rect x="108" y="95" width="20" height="18" fill="none" stroke="white" stroke-width="2" rx="1"/>
            <line x1="118" y1="95" x2="118" y2="113" stroke="white" stroke-width="1.5"/>
            <line x1="108" y1="104" x2="128" y2="104" stroke="white" stroke-width="1.5"/>

            <!-- Chimney -->
            <rect x="115" y="55" width="12" height="20" fill="currentColor" stroke="currentColor" stroke-width="2"/>

            <!-- Connection symbol (network nodes) -->
            <!-- Circle representing connectivity -->
            <circle cx="150" cy="100" r="8" fill="none" stroke="currentColor" stroke-width="2.5"/>
            <circle cx="165" cy="85" r="6" fill="none" stroke="currentColor" stroke-width="2"/>
            <circle cx="170" cy="110" r="6" fill="none" stroke="currentColor" stroke-width="2"/>

            <!-- Connection lines -->
            <line x1="155" y1="95" x2="162" y2="88" stroke="currentColor" stroke-width="2"/>
            <line x1="157" y1="105" x2="165" y2="108" stroke="currentColor" stroke-width="2"/>

            <!-- WiFi/signal waves for connectivity -->
            <path d="M 140 105 Q 142 100, 145 105" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M 138 110 Q 142 102, 147 110" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </g>

        <!-- Home text or branding initials -->
        <g>
            <text x="100" y="175" font-family="Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="currentColor">HKA</text>
        </g>
    </svg>
@endif
