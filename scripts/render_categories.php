<?php

// Render three category routes to tmp HTML files and count article.card occurrences.

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$requestPaths = [
    '/ecourse/robotik' => 'tmp_robotik.html',
    '/course-film-konten-kreator' => 'tmp_film.html',
    '/ecourse-komik' => 'tmp_komik.html',
];

foreach ($requestPaths as $path => $outFile) {
    // Create a request to the application
    $request = Illuminate\Http\Request::create($path, 'GET');
    $response = $kernel->handle($request);

    file_put_contents(__DIR__ . '/../' . $outFile, $response->getContent());

    // Count occurrences of <article class="card"
    $content = $response->getContent();
    preg_match_all('/<article[^>]*class="card/', $content, $matches);
    $count = count($matches[0]);

    echo "$path -> $outFile : $count cards\n";

    $kernel->terminate($request, $response);
}

echo "Done.\n";
