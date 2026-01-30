<?php
// Simple test to see what URLs are generated
require __DIR__ . '/vendor/autoload.php';

// Test without Laravel (just check file existence)
$testPaths = [
    'THUMBNAIL E COURSE ATHUTO.svg',
    'THUMBNAIL E COURSE HEMIPTERA.svg',
    'KOMIK 1.svg',
];

echo "=== File Existence Check ===\n\n";

foreach ($testPaths as $path) {
    $fullPath = __DIR__ . '/public/images/' . $path;
    $exists = file_exists($fullPath) ? 'YES' : 'NO';
    echo "Path: $path\n";
    echo "  Full path: $fullPath\n";
    echo "  Exists: $exists\n";
    
    // What the URL should be
    if ($exists === 'YES') {
        echo "  Expected URL: /images/$path\n";
    }
    echo "\n";
}

echo "=== Troubleshooting ===\n";
echo "If images not showing:\n";
echo "1. Check browser console (F12) for 404 errors\n";
echo "2. Verify image file exists: " . (__DIR__ . '/public/images/THUMBNAIL E COURSE ATHUTO.svg') . "\n";
echo "3. Check file permissions: " . (is_readable(__DIR__ . '/public/images/THUMBNAIL E COURSE ATHUTO.svg') ? 'READABLE' : 'NOT READABLE') . "\n";
