<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
$events = Event::orderBy('id','desc')->limit(10)->get();
if ($events->isEmpty()) {
    echo "No events\n";
    exit;
}
foreach ($events as $e) {
    echo "{$e->id}\t{$e->title}\t{$e->start_date}\t{$e->is_active}\t{$e->is_featured}\n";
}
