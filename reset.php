<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'multimedia.latihhobi@gmail.com')->first();

if ($user) {
    $user->password = Hash::make('admin123');
    $user->email_verified_at = now();
    $user->save();
    echo "Password reset berhasil.\n";
    echo "Email: multimedia.latihhobi@gmail.com\n";
    echo "Password: admin123\n";
} else {
    echo "User tidak ditemukan\n";
}