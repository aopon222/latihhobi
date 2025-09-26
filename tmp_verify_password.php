<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=latihhobi;charset=utf8mb4','root','');
    $stmt = $pdo->prepare('SELECT password FROM users WHERE email = ? LIMIT 1');
    $stmt->execute(['multimedia.latihhobi@gmail.com']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "USER NOT FOUND\n";
        exit(0);
    }
    $hash = $row['password'];
    $plain = 'password123';
    echo "Stored hash: " . substr($hash,0,60) . "...\n";
    if (password_verify($plain, $hash)) {
        echo "MATCH: 'password123' is valid.\n";
    } else {
        echo "NO MATCH: 'password123' is NOT valid.\n";
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
