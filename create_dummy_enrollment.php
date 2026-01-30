<?php

// Create dummy enrollment for testing
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

echo "=== CREATE DUMMY ENROLLMENT ===\n\n";

// Get first user and first course
$userStmt = $pdo->query("SELECT id, email FROM users LIMIT 1");
$user = $userStmt->fetch();

$courseStmt = $pdo->query("SELECT id_course, name FROM course LIMIT 1");
$course = $courseStmt->fetch();

if (!$user || !$course) {
    echo "❌ Tidak ada user atau course untuk testing\n";
    exit(1);
}

echo "User: {$user['email']} (ID: {$user['id']})\n";
echo "Course: {$course['name']} (ID: {$course['id_course']})\n\n";

// Check if enrollment already exists
$checkStmt = $pdo->prepare("SELECT id FROM ecourse_enrollments WHERE user_id = ? AND id_course = ?");
$checkStmt->execute([$user['id'], $course['id_course']]);
$existing = $checkStmt->fetch();

if ($existing) {
    echo "✅ Enrollment sudah ada (ID: {$existing['id']})\n";
} else {
    // Create enrollment
    $insertStmt = $pdo->prepare("
        INSERT INTO ecourse_enrollments (user_id, id_course, status, is_locked, enrolled_at, created_at, updated_at)
        VALUES (?, ?, 'active', 1, NOW(), NOW(), NOW())
    ");
    $insertStmt->execute([$user['id'], $course['id_course']]);
    echo "✅ Enrollment berhasil dibuat\n";
}

echo "\n=== CURRENT ENROLLMENTS ===\n";
$stmt = $pdo->query("
    SELECT e.*, u.email, c.name as course_name
    FROM ecourse_enrollments e
    JOIN users u ON e.user_id = u.id
    JOIN course c ON e.id_course = c.id_course
");

$enrollments = $stmt->fetchAll();
foreach ($enrollments as $e) {
    echo "ID: {$e['id']} - User: {$e['email']} - Course: {$e['course_name']} - Locked: " . ($e['is_locked'] ? 'Yes' : 'No') . "\n";
}