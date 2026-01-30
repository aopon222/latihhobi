<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'All Events:' . PHP_EOL;
$events = DB::table('events')->get();
foreach($events as $event) {
    echo $event->title . ' - ' . $event->start_date . ' - Active: ' . ($event->is_active ? 'Yes' : 'No') . PHP_EOL;
}

echo PHP_EOL . 'Published + Upcoming Events:' . PHP_EOL;
$publishedUpcoming = DB::table('events')
    ->where('is_active', true)
    ->where('start_date', '>', now())
    ->get();
foreach($publishedUpcoming as $event) {
    echo $event->title . ' - ' . $event->start_date . PHP_EOL;
}
echo 'Count: ' . $publishedUpcoming->count() . PHP_EOL;
?>