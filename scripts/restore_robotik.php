<?php

// Script to restore Robotik Level 1 course by running the seeder.
// Usage: php scripts/restore_robotik.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Running RobotikCourseSeeder...\n";

try {
    (new \Database\Seeders\RobotikCourseSeeder())->run();
    echo "Seeder finished. If no errors, 'Robotik Level 1' should be present (if it wasn't already).\n";
} catch (Throwable $e) {
    echo "Seeder failed: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}

// Also ensure any older placeholder name 'Robotik Level 1' is normalized to robot name and thumbnail
try {
    $db = \Illuminate\Support\Facades\DB::connection();
    // Ensure Level 1 uses the ATHUTO thumbnail and Robot Arthuro naming
    $category = $db->table('category')->where('name', 'Robotik')->orWhere('name', 'Robotics')->first();
    if ($category) {
        $robotCourses = $db->table('course')->where('id_category', $category->id_category)->orderBy('id_course', 'asc')->get();

        // Desired first course properties
        $desiredName = 'Robot Arthuro';
        $desiredThumb = 'THUMBNAIL E COURSE ATHUTO.svg';

        // If no course already has the ATHUTO thumbnail, update the first robot course to be Level 1 (Athuto)
        $hasAthuto = $db->table('course')->where('id_category', $category->id_category)->where('image_url', $desiredThumb)->exists();

        if (! $hasAthuto && $robotCourses->count() > 0) {
            $first = $robotCourses->first();
            echo "Normalizing first Robotik course (id {$first->id_course}) -> {$desiredName} with thumb {$desiredThumb}\n";
            $db->table('course')->where('id_course', $first->id_course)->update([
                'name' => $desiredName,
                'image_url' => $desiredThumb,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            echo "Updated course id {$first->id_course}.\n";
        } else {
            if ($hasAthuto) {
                echo "ATHUTO thumbnail already present for a Robotik course — no change needed.\n";
            } else {
                echo "No Robotik courses found to normalize.\n";
            }
        }
    } else {
        echo "Robotik category not found — cannot normalize Level 1.\n";
    }
} catch (Throwable $e) {
    echo "Post-seed update failed: " . $e->getMessage() . "\n";
}

echo "Done.\n";
return 0;

