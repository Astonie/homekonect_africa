<?php
/**
 * Manual Storage Link Creator for Hostinger
 * 
 * Hostinger disables exec() function, so we can't use "php artisan storage:link"
 * This script creates the symbolic link manually using PHP's symlink() function
 * 
 * Upload this to your root directory and access via browser:
 * https://homekonnectafrica.com/create-storage-link.php
 * 
 * DELETE THIS FILE AFTER RUNNING!
 */

echo "<h1>Storage Link Creator</h1>";
echo "<hr>";

// Define paths
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

echo "<h2>Configuration:</h2>";
echo "Target: <code>" . htmlspecialchars($target) . "</code><br>";
echo "Link: <code>" . htmlspecialchars($link) . "</code><br>";
echo "<hr>";

// Check if target directory exists
if (!is_dir($target)) {
    echo "❌ <strong>Error:</strong> Target directory does not exist!<br>";
    echo "Creating target directory...<br>";
    if (mkdir($target, 0775, true)) {
        echo "✅ Target directory created successfully!<br>";
    } else {
        die("❌ Failed to create target directory. Check permissions.<br>");
    }
} else {
    echo "✅ Target directory exists.<br>";
}

// Check if link already exists
if (file_exists($link)) {
    if (is_link($link)) {
        echo "⚠️ Symbolic link already exists!<br>";
        echo "Removing old link...<br>";
        if (unlink($link)) {
            echo "✅ Old link removed.<br>";
        } else {
            die("❌ Failed to remove old link. Check permissions.<br>");
        }
    } else {
        echo "❌ <strong>Error:</strong> A file or directory exists at the link path!<br>";
        echo "Please manually delete: <code>" . htmlspecialchars($link) . "</code><br>";
        die();
    }
}

// Create the symbolic link
echo "<h2>Creating Symbolic Link...</h2>";

if (function_exists('symlink')) {
    if (@symlink($target, $link)) {
        echo "✅ <strong>SUCCESS!</strong> Symbolic link created successfully!<br>";
        echo "<hr>";
        echo "<h2>Verification:</h2>";
        
        if (is_link($link)) {
            echo "✅ Link exists and is a symbolic link<br>";
            echo "✅ Link target: <code>" . readlink($link) . "</code><br>";
        }
        
        echo "<hr>";
        echo "<h2>Test Upload:</h2>";
        echo "<p>Try uploading an image through your application now.</p>";
        echo "<p>Images should be accessible at: <code>https://homekonnectafrica.com/storage/your-image.jpg</code></p>";
        
        echo "<hr>";
        echo "<p><strong>⚠️ SECURITY WARNING:</strong> Delete this file immediately!</p>";
        echo "<p><code>rm create-storage-link.php</code> or delete via File Manager</p>";
        
    } else {
        echo "❌ <strong>Error:</strong> Failed to create symbolic link!<br>";
        echo "<br><strong>Possible reasons:</strong><br>";
        echo "1. Insufficient permissions (try chmod 755 on public/ directory)<br>";
        echo "2. Parent directory is not writable<br>";
        echo "3. Symlinks are disabled by hosting provider<br>";
        echo "<br><strong>Alternative Solution:</strong><br>";
        echo "If symlinks don't work, you can copy files instead of symlinking.<br>";
        echo "Contact Hostinger support to enable symlinks or use a different approach.<br>";
    }
} else {
    echo "❌ <strong>Error:</strong> symlink() function is disabled on this server!<br>";
    echo "<br><strong>Alternative Solution:</strong><br>";
    echo "1. Contact Hostinger support to enable symlink() function<br>";
    echo "2. Or use a file upload strategy that doesn't require symlinks<br>";
    echo "3. Store uploaded files directly in public/uploads instead of storage/app/public<br>";
}

echo "<hr>";
echo "<p><em>Generated: " . date('Y-m-d H:i:s') . "</em></p>";
?>
