<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
$users = User::orderBy('id')->limit(50)->get(['id','email','name','email_verified_at']);
if ($users->isEmpty()) {
    echo "No users found in DB.\n";
    exit(0);
}
foreach ($users as $u) {
    echo "{$u->id}\t{$u->email}\t{$u->name}\t" . ($u->email_verified_at? $u->email_verified_at : 'NULL') . "\n";
}
