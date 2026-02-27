<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Ecourse;

$appUrl = env('APP_URL') ?: 'http://127.0.0.1:8000';

$rows = Ecourse::select('id_course','name','price','original_price')->get();

$affected = $rows->filter(function ($e) {
    $orig = $e->original_price;
    $priceVal = is_numeric($e->price) ? (float)$e->price : (float) preg_replace('/[^0-9\.]/','', $e->price);
    if (is_null($orig) || $orig === '') return true;
    $origVal = is_numeric($orig) ? (float)$orig : (float) preg_replace('/[^0-9\.]/','', $orig);
    return $origVal <= $priceVal;
});

if ($affected->isEmpty()) {
    echo "No affected e-courses found.\n";
    exit(0);
}

echo "Affected e-courses (need original_price fix)\n";
echo "----------------------------------------\n";
foreach ($affected as $a) {
    $id = $a->id_course;
    $name = $a->name;
    $price = is_numeric($a->price) ? (float)$a->price : (float) preg_replace('/[^0-9\.]/','', $a->price);
    $origRaw = $a->original_price;
    $editUrl = rtrim($appUrl, '/') . "/admin/ecourses/{$id}/edit";
    echo "ID: {$id} - {$name}\n";
    echo "  Current price: Rp " . number_format($price,0,',','.') . "\n";
    echo "  Original price (raw): " . ($origRaw === null ? 'NULL' : $origRaw) . "\n";
    echo "  Edit URL: {$editUrl}\n";
    echo "----------------------------------------\n";
}

exit(0);
