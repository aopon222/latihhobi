<?php

require 'bootstrap/app.php';

$app = app();
$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\Category;
use App\Models\Ecourse;

echo "=== CATEGORIES ===\n";
$categories = Category::all();
foreach ($categories as $cat) {
    echo "ID: {$cat->id_category}, Name: {$cat->name}\n";
}

echo "\n=== ECOURSES ===\n";
$ecourses = Ecourse::all();
foreach ($ecourses as $course) {
    echo "ID: {$course->id_course}, Name: {$course->name}, Category: {$course->id_category}\n";
}
