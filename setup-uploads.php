<?php

/**
 * Setup Public Uploads Directory for Hostinger
 * This script creates the uploads directory structure without needing symlinks
 * 
 * Access: https://homekonnectafrica.com/setup-uploads.php
 * Delete this file after running!
 */

echo "<h1>HomeKonnect - Setup Public Uploads</h1>";
echo "<hr>";

$baseDir = __DIR__ . '/public';
$directories = [
    'uploads',
    'uploads/team_members',
    'uploads/properties',
    'uploads/documents',
    'uploads/kyc',
    'uploads/profiles',
];

echo "<h2>Creating Upload Directories...</h2>";
echo "<pre>";

$allSuccess = true;

foreach ($directories as $dir) {
    $fullPath = $baseDir . '/' . $dir;
    
    if (!is_dir($fullPath)) {
        if (mkdir($fullPath, 0775, true)) {
            echo "✅ Created: public/{$dir}\n";
        } else {
            echo "❌ Failed to create: public/{$dir}\n";
            $allSuccess = false;
        }
    } else {
        echo "✅ Already exists: public/{$dir}\n";
    }
    
    // Try to set permissions
    @chmod($fullPath, 0775);
}

echo "</pre>";

if ($allSuccess) {
    echo "<h2>✅ Setup Complete!</h2>";
    echo "<p>All upload directories have been created successfully.</p>";
} else {
    echo "<h2>⚠️ Setup Incomplete</h2>";
    echo "<p>Some directories could not be created. Check file permissions.</p>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Upload <code>config/filesystems-production.php</code> and rename it to <code>config/filesystems.php</code></li>";
echo "<li>Add <code>FILESYSTEM_DISK=public_uploads</code> to your .env file</li>";
echo "<li><strong>Delete this file (setup-uploads.php) for security!</strong></li>";
echo "<li>Test file uploads from your dashboard</li>";
echo "</ol>";

echo "<hr>";
echo "<p><em>Generated: " . date('Y-m-d H:i:s') . "</em></p>";
echo "<p><strong>⚠️ SECURITY WARNING:</strong> Delete this file after running!</p>";
?>
