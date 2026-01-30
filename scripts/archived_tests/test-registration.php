<?php
// Archived copy of test-registration.php — moved to scripts/archived_tests
// Original script tested registration flow, email and DB connectivity.

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "[Archived] Registration test script.\n";
