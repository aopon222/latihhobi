<?php
$mysqli = new mysqli("localhost", "root", "", "latihhobi");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Test exact query dari controller
$result = $mysqli->query("SELECT id_course, name, created_at FROM course ORDER BY created_at DESC LIMIT 10");

echo "=== Query: SELECT id_course, name, created_at FROM course ORDER BY created_at DESC LIMIT 10 ===\n\n";
if ($result->num_rows > 0) {
    $i = 1;
    while($row = $result->fetch_assoc()) {
        echo "$i. ID: {$row['id_course']}, Name: {$row['name']}, Created: {$row['created_at']}\n";
        $i++;
    }
} else {
    echo "No results\n";
}

$mysqli->close();
