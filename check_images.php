<?php

// Check image_url values in database
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

echo "=== CHECK IMAGE_URL VALUES ===\n\n";

$stmt = $pdo->query('SELECT id_course, name, image_url FROM course ORDER BY id_course LIMIT 20');
$courses = $stmt->fetchAll();

foreach ($courses as $course) {
    $imagePath = 'images/' . $course['image_url'];
    $fullPath = __DIR__ . '/public/' . $imagePath;
    $exists = file_exists($fullPath) ? '✅ EXISTS' : '❌ MISSING';

    echo "ID: {$course['id_course']} - {$course['name']}\n";
    echo "  Image URL: {$course['image_url']}\n";
    echo "  Full Path: {$imagePath}\n";
    echo "  File Status: {$exists}\n\n";
}