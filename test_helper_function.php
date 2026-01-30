<?php
// Test what getEcourseImageUrl() function returns for admin view
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/Helpers/helpers.php';
require __DIR__ . '/app/Helpers/ImageHelper.php';

// Simulate what blade view does
$testPaths = [
    'THUMBNAIL E COURSE ATHUTO.svg',
    'THUMBNAIL E COURSE HEMIPTERA.svg',
    'KOMIK 1.svg',
    'FILM 1.svg',
];

echo "=== Testing getEcourseImageUrl() Function ===\n\n";

foreach ($testPaths as $path) {
    $url = getEcourseImageUrl($path);
    echo "Input: $path\n";
    echo "Output URL: $url\n";
    
    // Check what this should be
    if (file_exists(__DIR__ . '/public/images/' . $path)) {
        echo "Status: FILE EXISTS ✓\n";
        echo "Expected: /images/$path\n";
        echo "Got: $url\n";
        echo "Match: " . ($url === "/images/$path" ? "YES ✓" : "NO ✗") . "\n";
    }
    echo "\n";
}
