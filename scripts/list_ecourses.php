<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$ecourses = \App\Models\Ecourse::all();
echo "COUNT: " . $ecourses->count() . PHP_EOL;
foreach ($ecourses as $c) {
    echo $c->id . ' | ' . $c->title . ' | category=' . ($c->category ?? 'NULL') . ' | active=' . ($c->is_active ? '1' : '0') . ' | featured=' . ($c->is_featured ? '1' : '0') . PHP_EOL;
}

// Print counts per category and featured robotics
$categories = \App\Models\Ecourse::select('category')->distinct()->pluck('category')->filter();
echo PHP_EOL . "Categories present: " . $categories->implode(', ') . PHP_EOL;
foreach ($categories as $cat) {
    $count = \App\Models\Ecourse::where('category', $cat)->count();
    $featured = \App\Models\Ecourse::where('category', $cat)->where('is_featured', true)->count();
    echo "- $cat: total=$count, featured=$featured" . PHP_EOL;
}

// Specific checks
$roboticsCount = \App\Models\Ecourse::where('category', 'Robotics')->count();
$roboticsFeatured = \App\Models\Ecourse::where('category', 'Robotics')->where('is_featured', true)->count();

echo PHP_EOL . "Robotics count: $roboticsCount, Robotics featured: $roboticsFeatured" . PHP_EOL;
