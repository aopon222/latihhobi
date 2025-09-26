<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=latihhobi;charset=utf8mb4','root','');
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute(['multimedia.latihhobi@gmail.com']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        print_r($row);
    } else {
        echo "NOT FOUND\n";
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
