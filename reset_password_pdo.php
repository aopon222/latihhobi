<?php

// Script untuk reset password admin menggunakan PDO
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

$adminEmail = 'multimedia.latihhobi@gmail.com';
$newPassword = 'admin123';
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = ?, email_verified_at = NOW() WHERE email = ?");
$stmt->execute([$hashedPassword, $adminEmail]);

if ($stmt->rowCount() > 0) {
    echo "✅ Password berhasil direset!\n";
    echo "Email: {$adminEmail}\n";
    echo "Password Baru: {$newPassword}\n";
} else {
    echo "❌ Gagal reset password atau email tidak ditemukan.\n";
}