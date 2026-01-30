<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\EcourseEnrollment;

echo "Total enrollments: " . EcourseEnrollment::count() . PHP_EOL;

$enrollments = EcourseEnrollment::with(['user', 'ecourse'])->get();

foreach ($enrollments as $e) {
    echo $e->user->email . ' - ' . $e->ecourse->name . ' - Locked: ' . ($e->is_locked ? 'Yes' : 'No') . PHP_EOL;
}