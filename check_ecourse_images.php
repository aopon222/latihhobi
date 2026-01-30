<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->boot();

$courses = \App\Models\Ecourse::select('id_course', 'name', 'image_url')->get();
echo "=== E-Course Image URLs in Database ===\n";
foreach ($courses as $course) {
    echo "ID: {$course->id_course}\n";
    echo "  Name: {$course->name}\n";
    echo "  Image URL: {$course->image_url}\n";
    if ($course->image_url) {
        echo "  Display URL: " . \App\Helpers\ImageHelper::getEcourseImageUrl($course->image_url) . "\n";
    }
    echo "\n";
}
