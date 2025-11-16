<?php

namespace Database\Seeders;

use App\Models\Ecourse;
use App\Models\Category;
use Illuminate\Database\Seeder;

class EcourseSeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(['id_category' => 1], ['name' => 'Robotik', 'icon' => 'ROBONESIA.svg']);
        Category::firstOrCreate(['id_category' => 2], ['name' => 'Komik', 'icon' => 'Asset 1.svg']);
        Category::firstOrCreate(['id_category' => 3], ['name' => 'Film & Konten Kreator', 'icon' => 'KIDS CC.svg']);

        Ecourse::firstOrCreate(['id_course' => 1], ['id_category' => 1, 'name' => 'Dasar Robotik Arduino', 'course_by' => 'Tim Latihhobi', 'price' => 150000, 'image_url' => 'robotik-1.jpg']);
        Ecourse::firstOrCreate(['id_course' => 2], ['id_category' => 1, 'name' => 'Robotik Lanjutan: AI & IoT', 'course_by' => 'Tim Latihhobi', 'price' => 250000, 'image_url' => 'robotik-2.jpg']);
        Ecourse::firstOrCreate(['id_course' => 3], ['id_category' => 2, 'name' => 'Membuat Komik Dasar', 'course_by' => 'Ilustrator Pro', 'price' => 120000, 'image_url' => 'komik-1.jpg']);
        Ecourse::firstOrCreate(['id_course' => 4], ['id_category' => 2, 'name' => 'Komik Digital dengan Clip Studio Paint', 'course_by' => 'Digital Artist', 'price' => 180000, 'image_url' => 'komik-2.jpg']);
        Ecourse::firstOrCreate(['id_course' => 5], ['id_category' => 3, 'name' => 'Sinematografi Dasar', 'course_by' => 'Sineas Profesional', 'price' => 200000, 'image_url' => 'film-1.jpg']);
        Ecourse::firstOrCreate(['id_course' => 6], ['id_category' => 3, 'name' => 'Membuat Konten Viral di TikTok & Instagram', 'course_by' => 'Content Creator', 'price' => 99000, 'image_url' => 'film-2.jpg']);
    }
}
