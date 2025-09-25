<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Make DB facade available
Illuminate\Support\Facades\App::setFacadeApplication($app);

use Illuminate\Support\Facades\DB;

$counts = DB::table('ecourses')
    ->select('category', DB::raw('count(*) as cnt'))
    ->groupBy('category')
    ->get();

echo "Ecourse counts by category:\n";
foreach ($counts as $row) {
    echo "- {$row->category}: {$row->cnt}\n";
}

$komik = DB::table('ecourses')->where('category', 'Komik')->get();
echo "\nKomik rows: " . count($komik) . "\n";
foreach ($komik as $r) {
    echo " * {$r->id} | {$r->title} | active={$r->is_active}\n";
}
