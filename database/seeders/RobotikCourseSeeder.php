<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RobotikCourseSeeder extends Seeder
{
    public function run(): void
    {
        // Find an existing Robotics/Robotik category or create one
        $category = DB::table('category')
            ->where('name', 'Robotics')
            ->orWhere('name', 'Robotik')
            ->first();

        if (! $category) {
            $id = DB::table('category')->insertGetId([
                'name' => 'Robotics',
                'icon' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $id = $category->id_category;
        }

        // Prefer robot-specific naming and thumbnail filename used elsewhere in seeders
        $courseName = 'Robot Robofan';
        $thumbnail = 'THUMBNAIL E COURSE ROBOFAN.svg';

        // Avoid duplicate course with same name
        $exists = DB::table('course')->where('name', $courseName)->first();
        if ($exists) {
            return;
        }

        DB::table('course')->insert([
            'id_category' => $id,
            'name' => $courseName,
            'course_by' => 'Latih Hobi in Robotik',
            'price' => 339000,
            'original_price' => null,
            'image_url' => $thumbnail,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
