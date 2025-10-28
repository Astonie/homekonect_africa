#!/bin/bash

# Laravel Hostinger Permission Fix Script
# Upload this file to your server root and run: bash fix-permissions.sh

echo "Setting Laravel permissions for Hostinger..."

# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Set special permissions for storage and bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# If www-data user exists (some servers)
if id "www-data" &>/dev/null; then
    chown -R www-data:www-data storage bootstrap/cache
fi

# Make artisan executable
chmod +x artisan

echo "Permissions set successfully!"
echo "Now run: php artisan storage:link"
echo "And: php artisan optimize:clear"
