<?php

/**
 * Run this script once after deployment to create missing directories
 * Access: https://homekonnectafrica.com/setup-storage.php
 * Delete this file after running!
 */

$directories = [
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/testing',
    'storage/framework/views',
    'storage/logs',
    'storage/app/public',
    'bootstrap/cache',
];

echo "<h2>Laravel Storage Setup</h2>";
echo "<pre>";

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0775, true)) {
            echo "✓ Created: $dir\n";
        } else {
            echo "✗ Failed to create: $dir\n";
        }
    } else {
        echo "✓ Exists: $dir\n";
    }
    
    // Try to set permissions
    @chmod($dir, 0775);
}

echo "\n<strong>Setup Complete!</strong>\n";
echo "\nNext steps:\n";
echo "1. Delete this file (setup-storage.php) for security\n";
echo "2. Run: php artisan storage:link\n";
echo "3. Run: php artisan config:clear\n";
echo "4. Run: php artisan optimize\n";
echo "</pre>";
