<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/Helpers/ImageHelper.php';

// Test ImageHelper dengan path yang disimpan di database
$testPaths = [
    'THUMBNAIL E COURSE ATHUTO.svg',
    'THUMBNAIL E COURSE HEMIPTERA.svg',
    'KOMIK 1.svg',
    'course_images/bVNjcoDH9aYPwjlX45DPHr7HvGp9VFh70TvOBfDf.jpg',
    'nonexistent.jpg',
    null
];

echo "=== Testing ImageHelper::getEcourseImageUrl() ===\n\n";

foreach ($testPaths as $path) {
    echo "Input Path: " . ($path ?? 'NULL') . "\n";
    
    $result = \App\Helpers\ImageHelper::getEcourseImageUrl($path);
    echo "Output URL: $result\n";
    
    // Check if file exists
    if ($path) {
        if (strpos($path, 'course_images') !== false) {
            $diskPath = __DIR__ . '/storage/app/public/' . $path;
            $exists = file_exists($diskPath) ? '✓ EXISTS' : '✗ NOT FOUND';
            echo "  Storage file: $exists\n";
        } else {
            $publicPath = __DIR__ . '/public/images/' . $path;
            $exists = file_exists($publicPath) ? '✓ EXISTS' : '✗ NOT FOUND';
            echo "  Public file: $exists\n";
        }
    }
    echo "\n";
}
