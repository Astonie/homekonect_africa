<?php

/**
 * Generate Laravel APP_KEY if missing
 * Access: https://homekonnectafrica.com/generate-key.php
 * Delete this file after running!
 */

$envFile = __DIR__ . '/.env';

if (!file_exists($envFile)) {
    die("Error: .env file not found! Make sure you uploaded it.");
}

$envContent = file_get_contents($envFile);

// Check if APP_KEY is empty
if (preg_match('/APP_KEY=\s*$/', $envContent) || !str_contains($envContent, 'APP_KEY=base64:')) {
    // Generate a random key
    $key = 'base64:' . base64_encode(random_bytes(32));
    
    // Update .env file
    $envContent = preg_replace('/APP_KEY=.*/', 'APP_KEY=' . $key, $envContent);
    
    if (file_put_contents($envFile, $envContent)) {
        echo "<h2>✓ APP_KEY Generated Successfully!</h2>";
        echo "<p>Your new APP_KEY has been set in .env file.</p>";
        echo "<p><strong>IMPORTANT:</strong> Delete this file (generate-key.php) immediately for security!</p>";
        echo "<p>New APP_KEY: <code>" . htmlspecialchars($key) . "</code></p>";
    } else {
        echo "<h2>✗ Error: Could not write to .env file</h2>";
        echo "<p>Set file permissions to 644 for .env file and try again.</p>";
    }
} else {
    echo "<h2>✓ APP_KEY Already Set</h2>";
    echo "<p>Your .env file already has a valid APP_KEY.</p>";
    echo "<p>You can delete this file (generate-key.php).</p>";
}
