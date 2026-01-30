<?php
// Direct database query tanpa bootstrap
$mysqli = new mysqli("localhost", "root", "", "latihhobi");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id_course, name, image_url FROM course ORDER BY id_course");

echo "=== E-Course Image URLs in Database ===\n";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: {$row['id_course']}\n";
        echo "  Name: {$row['name']}\n";
        echo "  Image URL: {$row['image_url']}\n";
        echo "\n";
    }
} else {
    echo "No courses found\n";
}

$mysqli->close();
