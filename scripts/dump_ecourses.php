<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Ecourse;

$rows = Ecourse::select('id_course','name','price','original_price')->get();
$out = [];
foreach ($rows as $r) {
    $out[] = [
        'id' => $r->id_course,
        'name' => $r->name,
        'price_raw' => $r->price,
        'original_price_raw' => $r->original_price,
        'price' => is_numeric($r->price) ? (float)$r->price : (float)preg_replace('/[^0-9\.]/','',$r->price),
        'original_price' => is_numeric($r->original_price) ? (float)$r->original_price : (float)preg_replace('/[^0-9\.]/','',$r->original_price),
    ];
}

header('Content-Type: application/json');
echo json_encode($out, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
