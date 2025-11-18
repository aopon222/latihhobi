<?php

namespace Database\Seeders;

use App\Models\Ecourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan category sudah ada
        $robotikCategory = \App\Models\Category::where('name', 'Robotik')->first();
        $komikCategory = \App\Models\Category::where('name', 'Komik')->first();
        $filmCategory = \App\Models\Category::where('name', 'Film & Konten Kreator')->first();

        if (!$robotikCategory || !$komikCategory || !$filmCategory) {
            $this->command->error('Please run CategorySeeder first');
            return;
        }

        $courses = [
            // Robotik Courses - sesuai gambar dengan asset yang benar
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Arthuro',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 280000,
                'original_price' => 300000,
                'image_url' => 'THUMBNAIL E COURSE ATHUTO.svg',
            ],
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Hemiptera',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 289000,
                'original_price' => 300000,
                'image_url' => 'THUMBNAIL E COURSE HEMIPTERA.svg',
            ],
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Robofan',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 339000,
                'original_price' => 350000,
                'image_url' => 'THUMBNAIL E COURSE ROBOFAN.svg',
            ],
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Robodust',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 480000,
                'original_price' => 500000,
                'image_url' => 'THUMBNAIL E COURSE ROBODUST.svg',
            ],
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Avoider',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 289000,
                'original_price' => 300000,
                'image_url' => 'THUMBNAIL E COURSE AVOIDER.svg',
            ],
            [
                'id_category' => $robotikCategory->id_category,
                'name' => 'Robot Soccer Bot',
                'course_by' => 'Latih Hobi in Robotik',
                'price' => 580000,
                'original_price' => 600000,
                'image_url' => 'THUMBNAIL E COURSE ATHUTO.svg', // Using ATHUTO as placeholder for Soccer Bot
            ],
            // Komik Courses - hanya yang memiliki asset gambar
            [
                'id_category' => $komikCategory->id_category,
                'name' => 'Kelas Komik Level 1',
                'course_by' => 'Latih Hobi in Komik',
                'price' => 269000,
                'original_price' => 300000,
                'image_url' => 'KOMIK 1.svg',
            ],
            [
                'id_category' => $komikCategory->id_category,
                'name' => 'Kelas Komik Level 2',
                'course_by' => 'Latih Hobi in Komik',
                'price' => 269000,
                'original_price' => 300000,
                'image_url' => 'KOMIK 2.svg',
            ],
            [
                'id_category' => $komikCategory->id_category,
                'name' => 'Kelas Komik Level 3',
                'course_by' => 'Latih Hobi in Komik',
                'price' => 269000,
                'original_price' => 350000,
                'image_url' => 'KOMIK 3.svg',
            ],
            [
                'id_category' => $komikCategory->id_category,
                'name' => 'Kelas Komik Level 4',
                'course_by' => 'Latih Hobi in Komik',
                'price' => 269000,
                'original_price' => 500000,
                'image_url' => 'KOMIK 4.svg',
            ],
            // Film Courses - sesuai dengan gambar dan asset yang tersedia
            [
                'id_category' => $filmCategory->id_category,
                'name' => 'Kelas Film dan Konten Kreator Level 1',
                'course_by' => 'Latih Hobi in FKK',
                'price' => 269000,
                'original_price' => 300000,
                'image_url' => 'FILM 1.svg',
            ],
            [
                'id_category' => $filmCategory->id_category,
                'name' => 'Kelas Film dan Konten Kreator Level 2',
                'course_by' => 'Latih Hobi in FKK',
                'price' => 269000,
                'original_price' => 300000,
                'image_url' => 'FILM 2.svg',
            ],
            [
                'id_category' => $filmCategory->id_category,
                'name' => 'Kelas Film dan Konten Kreator Level 3',
                'course_by' => 'Latih Hobi in FKK',
                'price' => 269000,
                'original_price' => 350000,
                'image_url' => 'FILM 3.svg',
            ],
            [
                'id_category' => $filmCategory->id_category,
                'name' => 'Kelas Film dan Konten Kreator Level 4',
                'course_by' => 'Latih Hobi in FKK',
                'price' => 269000,
                'original_price' => 500000,
                'image_url' => 'FILM 4.svg',
            ],
            [
                'id_category' => $filmCategory->id_category,
                'name' => 'Kelas Film dan Konten Kreator Level 5',
                'course_by' => 'Latih Hobi in FKK',
                'price' => 269000,
                'original_price' => 300000,
                'image_url' => 'FILM 5.svg',
            ],
        ];

        foreach ($courses as $course) {
            Ecourse::create($course);
        }
    }
}
