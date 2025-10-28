<?php
/**
 * Error Checker for Hostinger Deployment
 * Upload this file to your root directory and access via browser
 * URL: https://homekonnectafrica.com/check-errors.php
 */

echo "<h1>HomeKonnect Error Checker</h1>";
echo "<hr>";

// 1. Check PHP Version
echo "<h2>1. PHP Version</h2>";
echo "Current PHP Version: <strong>" . phpversion() . "</strong><br>";
echo "Required: PHP 8.2+<br>";
echo (version_compare(phpversion(), '8.2.0', '>=')) ? "✅ PHP version OK<br>" : "❌ PHP version too old<br>";
echo "<hr>";

// 2. Check .env file
echo "<h2>2. Environment File (.env)</h2>";
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    echo "✅ .env file exists<br>";
    
    // Check if readable
    if (is_readable($envPath)) {
        echo "✅ .env file is readable<br>";
        
        // Parse .env
        $envContent = file_get_contents($envPath);
        $envLines = explode("\n", $envContent);
        
        $checks = [
            'APP_KEY' => false,
            'APP_ENV' => false,
            'APP_DEBUG' => false,
            'APP_URL' => false,
        ];
        
        foreach ($envLines as $line) {
            foreach ($checks as $key => $value) {
                if (strpos($line, $key . '=') === 0) {
                    $checks[$key] = trim(substr($line, strlen($key) + 1));
                }
            }
        }
        
        echo "<h3>Environment Variables:</h3>";
        foreach ($checks as $key => $value) {
            if ($value === false) {
                echo "❌ {$key} - NOT SET<br>";
            } else {
                if ($key === 'APP_KEY') {
                    if (empty($value) || $value === 'base64:') {
                        echo "❌ {$key} - EMPTY or INVALID<br>";
                    } else {
                        echo "✅ {$key} - Set (" . substr($value, 0, 15) . "...)<br>";
                    }
                } else {
                    echo "✅ {$key} - {$value}<br>";
                }
            }
        }
    } else {
        echo "❌ .env file is NOT readable (check permissions)<br>";
    }
} else {
    echo "❌ .env file does NOT exist<br>";
    echo "Action: Copy .env.production to .env<br>";
}
echo "<hr>";

// 3. Check Storage Directories
echo "<h2>3. Storage Directories</h2>";
$requiredDirs = [
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'storage/app',
    'storage/app/public',
    'bootstrap/cache',
];

foreach ($requiredDirs as $dir) {
    $fullPath = __DIR__ . '/' . $dir;
    if (file_exists($fullPath)) {
        if (is_writable($fullPath)) {
            echo "✅ {$dir} - exists and writable<br>";
        } else {
            echo "⚠️ {$dir} - exists but NOT writable<br>";
        }
    } else {
        echo "❌ {$dir} - does NOT exist<br>";
    }
}
echo "<hr>";

// 4. Check Database
echo "<h2>4. Database</h2>";
$dbPath = __DIR__ . '/database/database.sqlite';
if (file_exists($dbPath)) {
    echo "✅ database.sqlite exists<br>";
    if (is_writable($dbPath)) {
        echo "✅ database.sqlite is writable<br>";
    } else {
        echo "❌ database.sqlite is NOT writable<br>";
    }
    echo "Size: " . filesize($dbPath) . " bytes<br>";
} else {
    echo "❌ database.sqlite does NOT exist<br>";
    echo "Action: Create database file<br>";
}
echo "<hr>";

// 5. Check Critical Files
echo "<h2>5. Critical Files</h2>";
$criticalFiles = [
    'public/index.php',
    'bootstrap/app.php',
    'artisan',
];

foreach ($criticalFiles as $file) {
    $fullPath = __DIR__ . '/' . $file;
    if (file_exists($fullPath)) {
        echo "✅ {$file} exists<br>";
    } else {
        echo "❌ {$file} does NOT exist<br>";
    }
}
echo "<hr>";

// 6. Check Laravel Logs
echo "<h2>6. Recent Laravel Logs</h2>";
$logPath = __DIR__ . '/storage/logs/laravel.log';
if (file_exists($logPath)) {
    echo "✅ laravel.log exists<br>";
    
    // Get last 50 lines
    $logContent = file($logPath);
    $lastLines = array_slice($logContent, -50);
    
    echo "<h3>Last 50 lines of laravel.log:</h3>";
    echo "<pre style='background: #f5f5f5; padding: 10px; overflow: auto; max-height: 400px;'>";
    echo htmlspecialchars(implode('', $lastLines));
    echo "</pre>";
} else {
    echo "❌ laravel.log does NOT exist<br>";
}
echo "<hr>";

// 7. Check PHP Extensions
echo "<h2>7. Required PHP Extensions</h2>";
$requiredExtensions = [
    'openssl',
    'pdo',
    'pdo_sqlite',
    'mbstring',
    'tokenizer',
    'xml',
    'ctype',
    'json',
    'bcmath',
    'fileinfo',
];

foreach ($requiredExtensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✅ {$ext}<br>";
    } else {
        echo "❌ {$ext} - NOT loaded<br>";
    }
}
echo "<hr>";

// 8. Summary
echo "<h2>8. Summary & Next Steps</h2>";
echo "<ol>";

if (!file_exists($envPath)) {
    echo "<li><strong>Create .env file:</strong> Copy .env.production to .env</li>";
} else {
    $envContent = file_get_contents($envPath);
    if (strpos($envContent, 'APP_KEY=') === false || strpos($envContent, 'APP_KEY=base64:') === strlen($envContent) - 15) {
        echo "<li><strong>Generate APP_KEY:</strong> Visit generate-key.php</li>";
    }
}

$missingDirs = false;
foreach ($requiredDirs as $dir) {
    if (!file_exists(__DIR__ . '/' . $dir)) {
        $missingDirs = true;
        break;
    }
}
if ($missingDirs) {
    echo "<li><strong>Create storage directories:</strong> Visit setup-storage.php</li>";
}

echo "<li><strong>Set permissions:</strong> storage/ and bootstrap/cache/ need 775 permissions</li>";
echo "<li><strong>Clear cache:</strong> Run 'php artisan optimize:clear' via SSH</li>";
echo "<li><strong>Delete this file:</strong> Remove check-errors.php after debugging</li>";
echo "</ol>";

echo "<hr>";
echo "<p><em>Generated: " . date('Y-m-d H:i:s') . "</em></p>";
echo "<p><strong>⚠️ SECURITY WARNING:</strong> Delete this file after debugging!</p>";
?>
