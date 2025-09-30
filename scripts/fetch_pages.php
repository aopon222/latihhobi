<?php
$pages = [
    '/' => 'home',
    '/login' => 'login',
    '/admin/dashboard' => 'admin_dashboard'
];
foreach ($pages as $path => $name) {
    $url = 'http://127.0.0.1:8000' . $path;
    echo "Fetching $url...\n";
    $c = @file_get_contents($url);
    if ($c === false) {
        echo "ERROR: failed to fetch $url\n";
        continue;
    }
    file_put_contents(__DIR__ . '/../tmp_' . $name . '.html', $c);
    echo "Saved tmp_{$name}.html\n";
}
echo "Done.\n";
