<?php
// Test direct URL generation like Laravel would
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test what asset() function should return
$path1 = 'images/THUMBNAIL E COURSE ATHUTO.svg';
$expectedUrl1 = '/images/THUMBNAIL E COURSE ATHUTO.svg';

$path2 = 'course_images/bVNjcoDH9aYPwjlX45DPHr7HvGp9VFh70TvOBfDf.jpg';
$expectedUrl2 = '/storage/course_images/bVNjcoDH9aYPwjlX45DPHr7HvGp9VFh70TvOBfDf.jpg';

echo "=== Expected URLs ===\n";
echo "Old image path: $path1\n";
echo "Expected URL: $expectedUrl1\n";
echo "File exists: " . (file_exists(__DIR__ . '/public/' . $path1) ? 'YES' : 'NO') . "\n\n";

echo "New image path: $path2\n";
echo "Expected URL: $expectedUrl2\n";
echo "File exists: " . (file_exists(__DIR__ . '/storage/app/public/' . $path2) ? 'YES' : 'NO') . "\n\n";

// Test what the helper should do
echo "=== Helper Logic Should Be ===\n";
echo "1. If path contains 'course_images':\n";
echo "   → Use Storage::disk('public')->url()\n";
echo "   → Returns: /storage/course_images/filename.jpg\n\n";

echo "2. Else if file exists in public/images/:\n";
echo "   → Use asset('images/filename.svg')\n";
echo "   → Returns: /images/filename.svg\n\n";

echo "3. Else return placeholder\n";
