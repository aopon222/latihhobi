<?php

// Script untuk menampilkan data user admin yang tersedia
$host = '127.0.0.1';
$db = 'latihhobi';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

echo "=== DATA USER ADMIN YANG TERSEDIA ===\n\n";

$adminEmails = ['multimedia.latihhobi@gmail.com', 'admin@latihhobi.id'];

foreach ($adminEmails as $index => $email) {
    $stmt = $pdo->prepare("SELECT id, name, email, email_verified_at, password, created_at, updated_at FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo ($index + 1) . ". USER ADMIN\n";
        echo "   ID: {$user['id']}\n";
        echo "   Nama: {$user['name']}\n";
        echo "   Email: {$user['email']}\n";
        echo "   Status Email: " . ($user['email_verified_at'] ? '✅ TERVERIFIKASI' : '⚠️ BELUM TERVERIFIKASI') . "\n";
        echo "   Password: " . (empty($user['password']) ? '❌ BELUM DI-SET' : '✅ SUDAH DI-SET (hashed)') . "\n";
        echo "   Dibuat: {$user['created_at']}\n";
        echo "   Diupdate: {$user['updated_at']}\n";

        if ($email === 'multimedia.latihhobi@gmail.com') {
            echo "   🎯 STATUS: ADMIN UTAMA (berdasarkan kode aplikasi)\n";
        } else {
            echo "   📋 STATUS: ADMIN CADANGAN\n";
        }

        echo "\n   === KREDENSIAL LOGIN ===\n";
        echo "   Email: {$user['email']}\n";
        echo "   Password: [gunakan password yang sudah di-set di database]\n\n";

        if (!$user['email_verified_at']) {
            echo "   ⚠️ CATATAN: Email belum diverifikasi. Anda mungkin perlu verifikasi email terlebih dahulu.\n\n";
        }

    } else {
        echo ($index + 1) . ". USER ADMIN {$email} - ❌ TIDAK DITEMUKAN\n\n";
    }
}

echo "=== CARA LOGIN SEBAGAI ADMIN ===\n";
echo "1. Buka browser dan akses: http://127.0.0.1:8000/login\n";
echo "2. Masukkan email admin (pilih salah satu di atas)\n";
echo "3. Masukkan password yang sesuai\n";
echo "4. Klik tombol 'Login'\n\n";

echo "=== JIKA PERLU SET PASSWORD BARU ===\n";
echo "Jalankan perintah berikut di terminal:\n";
echo "php artisan tinker\n";
echo "Kemudian ketik:\n";
echo "User::where('email', 'multimedia.latihhobi@gmail.com')->update(['password' => Hash::make('passwordbaru123'), 'email_verified_at' => now()]);\n\n";

echo "=== JIKA PERLU VERIFIKASI EMAIL ===\n";
echo "1. Login dengan email dan password\n";
echo "2. Jika diarahkan ke halaman verifikasi, klik 'Kirim Ulang Email Verifikasi'\n";
echo "3. Atau gunakan verifikasi manual: http://127.0.0.1:8000/manual-verify\n\n";

echo "=== FITUR ADMIN YANG TERSEDIA ===\n";
echo "- Dashboard Admin: /admin/dashboard\n";
echo "- Kelola E-courses: /admin/ecourses\n";
echo "- Kelola Events: /admin/events\n";
echo "- Kelola Podcasts: /admin/podcasts\n\n";

?>