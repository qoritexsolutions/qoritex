<?php
/**
 * Cache Clear Helper
 * Run this file to clear all Laravel caches
 * Visit: yourdomain.com/clear-cache.php
 * DELETE THIS FILE AFTER USE!
 */

echo "<!DOCTYPE html><html><head><title>Cache Clear</title>";
echo "<style>body{font-family:Arial;margin:40px;} h1{color:#4CAF50;} pre{background:#f4f4f4;padding:10px;border-radius:5px;} .success{color:green;} .error{color:red;} .warning{background:#fff3cd;padding:15px;border-left:4px solid #ffc107;margin:20px 0;}</style>";
echo "</head><body>";

echo "<h1>🔧 Laravel Cache Clear</h1>";

// Change to Laravel root directory
chdir(__DIR__ . '/..');

echo "<div class='warning'><strong>⚠️ SECURITY WARNING:</strong> Delete this file after use!</div>";

// Check if we can execute artisan commands
if (!file_exists('artisan')) {
    echo "<p class='error'>❌ Error: artisan file not found. Are you in the correct directory?</p>";
    echo "<p>Current directory: " . getcwd() . "</p>";
    exit;
}

echo "<h2>Clearing Caches...</h2>";

// Commands to run
$commands = [
    'config:clear' => 'Configuration cache',
    'route:clear' => 'Route cache',
    'cache:clear' => 'Application cache',
    'view:clear' => 'Compiled views',
];

foreach ($commands as $command => $description) {
    echo "<h3>📝 Clearing: $description</h3>";
    echo "<p>Running: <code>php artisan $command</code></p>";
    
    $output = [];
    $returnVar = 0;
    exec("php artisan $command 2>&1", $output, $returnVar);
    
    if ($returnVar === 0) {
        echo "<p class='success'>✅ Success!</p>";
    } else {
        echo "<p class='error'>❌ Failed</p>";
    }
    
    if (!empty($output)) {
        echo "<pre>" . htmlspecialchars(implode("\n", $output)) . "</pre>";
    }
}

// Manually delete bootstrap cache files
echo "<h2>🗑️ Deleting Bootstrap Cache Files</h2>";
$cacheDir = __DIR__ . '/../bootstrap/cache/';
$deleted = 0;

if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '*.php');
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            if (unlink($file)) {
                echo "<p class='success'>✅ Deleted: " . basename($file) . "</p>";
                $deleted++;
            } else {
                echo "<p class='error'>❌ Failed to delete: " . basename($file) . "</p>";
            }
        }
    }
    
    if ($deleted === 0) {
        echo "<p>No cache files to delete.</p>";
    } else {
        echo "<p class='success'>✅ Deleted $deleted file(s)</p>";
    }
} else {
    echo "<p class='error'>❌ Bootstrap cache directory not found</p>";
}

// Check for storage/installed file
echo "<h2>📋 Installation Status Check</h2>";
$installedFile = __DIR__ . '/../storage/installed';
if (file_exists($installedFile)) {
    echo "<p class='error'>⚠️ Found 'storage/installed' file - this blocks the installer!</p>";
    if (unlink($installedFile)) {
        echo "<p class='success'>✅ Deleted storage/installed file</p>";
    } else {
        echo "<p class='error'>❌ Failed to delete - please delete manually</p>";
    }
} else {
    echo "<p class='success'>✅ No installation lock file found</p>";
}

echo "<hr>";
echo "<h2>✅ All Done!</h2>";
echo "<p>Caches have been cleared. You can now:</p>";
echo "<ul>";
echo "<li><a href='/install' style='font-size:18px; color:blue;'><strong>Go to Installation Wizard (/install)</strong></a></li>";
echo "<li><a href='/' style='font-size:16px;'>Go to Homepage</a></li>";
echo "</ul>";

echo "<hr>";
echo "<p style='color:red; font-weight:bold; font-size:18px;'>⚠️ DELETE THIS FILE NOW FOR SECURITY!</p>";
echo "<p>File location: <code>" . __FILE__ . "</code></p>";

echo "</body></html>";
?>
