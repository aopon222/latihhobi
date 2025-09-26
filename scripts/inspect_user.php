<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = $argv[1] ?? 'multimedia.latihhobi@gmail.com';
$user = User::where('email', $email)->first();
if (! $user) {
    echo "User not found: $email\n";
    exit(1);
}

$output = [
    'id' => $user->id,
    'email' => $user->email,
    'name' => $user->name,
    'email_verified_at' => $user->email_verified_at?->toDateTimeString() ?? null,
    'password_hash' => substr($user->password, 0, 60),
    'disabled' => $user->disabled ?? null,
];

echo "User record:\n";
echo json_encode($output, JSON_PRETTY_PRINT) . "\n\n";

$tryPasswords = ['admin123', 'password123', '12345678'];
foreach ($tryPasswords as $p) {
    $ok = Hash::check($p, $user->password) ? 'OK' : 'NO';
    echo "Password check for '$p': $ok\n";
}

// check role/permission or admin email hard-coded checks
$adminEmailCheck = ($user->email === 'multimedia.latihhobi@gmail.com') ? 'true' : 'false';
echo "Is admin-email (hardcoded): $adminEmailCheck\n";
