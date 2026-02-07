<?php
/**
 * Route Test Helper
 * Check if Laravel routes are loading correctly
 * Visit: yourdomain.com/test-routes.php
 * DELETE THIS FILE AFTER USE!
 */

echo "<!DOCTYPE html><html><head><title>Route Test</title>";
echo "<style>body{font-family:Arial;margin:40px;} h1{color:#2196F3;} pre{background:#f4f4f4;padding:15px;border-radius:5px;overflow-x:auto;} table{border-collapse:collapse;width:100%;margin:20px 0;} th,td{border:1px solid #ddd;padding:12px;text-align:left;} th{background:#2196F3;color:white;} .warning{background:#fff3cd;padding:15px;border-left:4px solid #ffc107;margin:20px 0;}</style>";
echo "</head><body>";

echo "<h1>🧪 Laravel Route Test</h1>";

try {
    // Load Laravel application
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    echo "<p style='color:green;'>✅ Laravel application loaded successfully!</p>";
    
    // Get router
    $router = $app->make('router');
    $routes = $router->getRoutes();
    
    echo "<h2>📍 Install Routes</h2>";
    
    $installRoutes = [];
    foreach ($routes as $route) {
        if (str_contains($route->uri(), 'install')) {
            $installRoutes[] = [
                'method' => implode(', ', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        }
    }
    
    if (empty($installRoutes)) {
        echo "<p style='color:red;'>❌ No install routes found! This is the problem.</p>";
        echo "<p>Routes might be cached. Run <a href='clear-cache.php'>clear-cache.php</a> first.</p>";
    } else {
        echo "<p style='color:green;'>✅ Found " . count($installRoutes) . " install routes:</p>";
        echo "<table>";
        echo "<tr><th>Method</th><th>URI</th><th>Name</th><th>Action</th></tr>";
        foreach ($installRoutes as $route) {
            echo "<tr>";
            echo "<td>{$route['method']}</td>";
            echo "<td><strong>{$route['uri']}</strong></td>";
            echo "<td>{$route['name']}</td>";
            echo "<td>" . htmlspecialchars($route['action']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<h2>📊 Total Routes</h2>";
    echo "<p>Total routes registered: <strong>" . count($routes) . "</strong></p>";
    
    echo "<h2>🔍 Sample Routes</h2>";
    echo "<table>";
    echo "<tr><th>Method</th><th>URI</th><th>Name</th></tr>";
    $count = 0;
    foreach ($routes as $route) {
        if ($count >= 10) break;
        echo "<tr>";
        echo "<td>" . implode(', ', $route->methods()) . "</td>";
        echo "<td>{$route->uri()}</td>";
        echo "<td>{$route->getName()}</td>";
        echo "</tr>";
        $count++;
    }
    echo "</table>";
    echo "<p><em>Showing first 10 routes only</em></p>";
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Error loading Laravel:</p>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<p>Stack trace:</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "<hr>";
echo "<h2>🧭 Quick Links</h2>";
echo "<ul>";
echo "<li><a href='/install' style='font-size:18px; color:blue;'><strong>Try /install</strong></a></li>";
echo "<li><a href='/install/requirements'>/install/requirements</a></li>";
echo "<li><a href='/install/database'>/install/database</a></li>";
echo "<li><a href='clear-cache.php'>Clear All Caches</a></li>";
echo "<li><a href='/'>Homepage</a></li>";
echo "</ul>";

echo "<div class='warning'><strong>⚠️ SECURITY:</strong> Delete this file after debugging!</div>";
echo "<p>File location: <code>" . __FILE__ . "</code></p>";

echo "</body></html>";
?>
