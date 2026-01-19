<?php

return [
    'google_maps' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY'),
        'street_view_enabled' => env('GOOGLE_STREET_VIEW_ENABLED', true),
        'default_zoom' => 15,
        'map_type' => 'roadmap', // roadmap, satellite, hybrid, terrain
    ],

    'virtual_tours' => [
        'matterport_enabled' => env('MATTERPORT_ENABLED', false),
        'matterport_key' => env('MATTERPORT_API_KEY'),
        'embed_height' => '600px',
        'autoplay' => false,
    ],

    'media' => [
        'max_photos' => 50,
        'max_videos' => 10,
        'photo_quality' => 90,
        'thumbnail_sizes' => [
            'small' => [200, 200],
            'medium' => [600, 400],
            'large' => [1200, 800],
        ],
        'video_formats' => ['mp4', 'webm', 'mov'],
        'drone_imagery_enabled' => true,
    ],

    'geocoding' => [
        'enabled' => true,
        'provider' => 'google', // google, mapbox, nominatim
        'cache_duration' => 86400, // 24 hours
    ],
];
