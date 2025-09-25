<?php
$url = 'http://127.0.0.1:8000/';
$ctx = stream_context_create(['http' => ['timeout' => 5]]);
$body = @file_get_contents($url, false, $ctx);
if ($body === false) {
    echo "Request failed\n";
    exit(1);
}
echo strlen($body) . " bytes\n";
echo substr($body, 0, 400) . "\n";
