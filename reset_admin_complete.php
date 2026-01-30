<?php

// Script lengkap untuk reset password admin dan verifikasi
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "=== RESET PASSWORD ADMIN ===\n\n";

$adminEmail = 'multimedia.latihhobi@gmail.com';
$newPassword = 'admin123';

echo "1. Mencari user admin: {$adminEmail}\n";
$user = User::where('email', $adminEmail)->first();

if (!$user) {
    echo "❌ User admin tidak ditemukan!\n";
    exit(1);
}

echo "✅ User ditemukan - ID: {$user->id}, Nama: {$user->name}\n\n";

echo "2. Mengubah password menjadi: {$newPassword}\n";
$hashedPassword = Hash::make($newPassword);

$user->update([
    'password' => $hashedPassword,
    'email_verified_at' => now()
]);

echo "✅ Password berhasil diubah\n\n";

echo "3. Verifikasi password hash\n";
$user->refresh(); // Reload dari database
$storedHash = $user->password;

if (Hash::check($newPassword, $storedHash)) {
    echo "✅ Password hash valid - cocok dengan input\n\n";
} else {
    echo "❌ Password hash tidak valid!\n\n";
}

echo "4. Detail user setelah update:\n";
echo "   ID: {$user->id}\n";
echo "   Email: {$user->email}\n";
echo "   Nama: {$user->name}\n";
echo "   Password Hash: " . substr($user->password, 0, 20) . "...\n";
echo "   Email Verified: " . ($user->email_verified_at ? 'YES' : 'NO') . "\n\n";

echo "5. Test login simulation\n";
$credentials = [
    'email' => $adminEmail,
    'password' => $newPassword
];

if (Auth::attempt($credentials)) {
    echo "✅ Login berhasil dengan kredensial baru!\n";
    Auth::logout(); // Logout setelah test
} else {
    echo "❌ Login gagal!\n";
}

echo "\n=== KREDENSIAL LOGIN ===\n";
echo "Email: {$adminEmail}\n";
echo "Password: {$newPassword}\n\n";

echo "=== CARA LOGIN ===\n";
echo "1. Buka: http://127.0.0.1:8000/login\n";
echo "2. Email: {$adminEmail}\n";
echo "3. Password: {$newPassword}\n";
echo "4. Klik Login\n\n";

echo "Jika masih tidak bisa login, periksa:\n";
echo "- Pastikan server Laravel berjalan: php artisan serve\n";
echo "- Cek log Laravel: tail -f storage/logs/laravel.log\n";
echo "- Pastikan database terhubung\n\n";

?>