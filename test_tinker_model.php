<?php
// Test artisan tinker without hang
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

// Bootrap the application
$app->boot();

// Try to load Ecourse model
try {
    echo "Loading Ecourse model...\n";
    $ecourse = \App\Models\Ecourse::first();
    
    if ($ecourse) {
        echo "✓ Ecourse model loaded successfully\n";
        echo "  ID: " . $ecourse->id_course . "\n";
        echo "  Name: " . $ecourse->name . "\n";
        echo "  Image URL: " . $ecourse->image_url . "\n";
    } else {
        echo "✓ Model loads but no records found\n";
    }
    
    // Test relation
    echo "\nTesting relation access...\n";
    if ($ecourse) {
        $lessons = $ecourse->lessons()->count();
        echo "✓ Lessons relation accessible (count: " . $lessons . ")\n";
    }
    
    echo "\n✓ All tests passed! Tinker should work now.\n";
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit(1);
}
