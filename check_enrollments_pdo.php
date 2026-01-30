<?php

// Check enrollments using PDO
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

echo "=== CHECK ENROLLMENTS ===\n\n";

$stmt = $pdo->query("SELECT COUNT(*) as total FROM ecourse_enrollments");
$result = $stmt->fetch();
echo "Total enrollments: " . $result['total'] . "\n\n";

$stmt = $pdo->query("
    SELECT e.*, u.email, c.name as course_name, c.image_url
    FROM ecourse_enrollments e
    JOIN users u ON e.user_id = u.id
    JOIN course c ON e.id_course = c.id_course
    ORDER BY e.created_at DESC
    LIMIT 10
");

$enrollments = $stmt->fetchAll();

foreach ($enrollments as $e) {
    $imageUrl = $e['image_url'] ? "http://127.0.0.1:8000/images/" . urlencode($e['image_url']) : 'No image';
    echo "User: {$e['email']} - Course: {$e['course_name']} - Thumbnail: {$imageUrl} - Locked: " . ($e['is_locked'] ? 'Yes' : 'No') . " - Status: {$e['status']}\n";
}