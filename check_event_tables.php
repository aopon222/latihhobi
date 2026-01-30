<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'Checking for other event-related tables...' . PHP_EOL;
$tables = DB::select('SHOW TABLES');
foreach($tables as $table) {
    $tableName = array_values((array)$table)[0];
    if (strpos($tableName, 'event') !== false) {
        echo 'Found table: ' . $tableName . PHP_EOL;
        $count = DB::table($tableName)->count();
        echo 'Records: ' . $count . PHP_EOL;

        // Show sample data if exists
        if ($count > 0) {
            $sample = DB::table($tableName)->first();
            echo 'Sample: ' . json_encode($sample) . PHP_EOL;
        }
    }
}
?>