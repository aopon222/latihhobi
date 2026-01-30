<?php

// Script untuk mengatur ulang password admin
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== MENGATUR ULANG PASSWORD ADMIN ===\n";

$user = User::where('email', 'multimedia.latihhobi@gmail.com')->first();

if ($user) {
    $newPassword = 'admin123';
    $user->update([
        'password' => Hash::make($newPassword),
        'email_verified_at' => now()
    ]);

    echo "✅ Password berhasil diubah!\n";
    echo "Email: {$user->email}\n";
    echo "Password Baru: {$newPassword}\n";
    echo "Email Status: " . ($user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi') . "\n\n";

    echo "=== KREDENSIAL LOGIN BARU ===\n";
    echo "Email: multimedia.latihhobi@gmail.com\n";
    echo "Password: admin123\n\n";

    echo "Silakan login dengan kredensial di atas.\n";

} else {
    echo "❌ User admin tidak ditemukan!\n";
}