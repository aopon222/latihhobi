<?php
// Check course table structure and ordering
$mysqli = new mysqli("localhost", "root", "", "latihhobi");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "=== Course Table Structure ===\n";
$result = $mysqli->query("DESCRIBE course");
while($row = $result->fetch_assoc()) {
    echo "{$row['Field']} ({$row['Type']}) " . ($row['Null'] == 'NO' ? 'NOT NULL' : 'NULL') . "\n";
}

echo "\n=== Course Table with Timestamps ===\n";
$result = $mysqli->query("SELECT id_course, name, created_at, updated_at FROM course ORDER BY id_course");
while($row = $result->fetch_assoc()) {
    echo "ID {$row['id_course']}: {$row['name']} | Created: {$row['created_at']} | Updated: {$row['updated_at']}\n";
}

echo "\n=== Check for NULL created_at ===\n";
$result = $mysqli->query("SELECT COUNT(*) as cnt FROM course WHERE created_at IS NULL OR updated_at IS NULL");
$row = $result->fetch_assoc();
echo "Rows with NULL timestamps: {$row['cnt']}\n";

$mysqli->close();
