<?php

/**
 * Production Filesystem Configuration for Hostinger
 * 
 * This configuration removes the need for symlinks by storing
 * uploaded files directly in the public/uploads directory.
 * 
 * DEPLOYMENT INSTRUCTIONS:
 * 1. Rename this file to filesystems.php
 * 2. Replace the original config/filesystems.php on production server
 * 3. Create public/uploads directory with 775 permissions
 * 4. Update .env to use FILESYSTEM_DISK=public_uploads
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */

    'default' => env('FILESYSTEM_DISK', 'public_uploads'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        // Direct public uploads - NO SYMLINK NEEDED
        'public_uploads' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'url' => env('APP_URL').'/uploads',
            'visibility' => 'public',
            'throw' => false,
        ],

        // Traditional public disk (requires symlink - not recommended for Hostinger)
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    */

    'links' => [
        // Disabled - we're using direct public uploads instead
        // public_path('storage') => storage_path('app/public'),
    ],

];
