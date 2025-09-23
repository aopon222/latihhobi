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
        $courses = [
            [
                'title' => 'Robotics untuk Pemula',
                'slug' => 'robotics-untuk-pemula',
                'description' => 'Kursus lengkap robotika dari dasar hingga mahir. Pelajari konsep-konsep fundamental robotika, pemrograman robot, dan implementasi proyek robotik yang menarik.',
                'short_description' => 'Kursus robotika lengkap dari dasar hingga mahir untuk pemula',
                'category' => 'Robotics',
                'price' => 199000,
                'discount_price' => 149000,
                'duration' => '4 Minggu',
                'total_lessons' => 16,
                'level' => 'Beginner',
                'is_featured' => true,
                'is_active' => true,
                'prerequisites' => [
                    'Pengetahuan dasar elektronika',
                    'Kemampuan menggunakan komputer',
                    'Minat terhadap teknologi'
                ],
                'learning_outcomes' => [
                    'Memahami konsep dasar robotika',
                    'Mampu memprogram robot sederhana',
                    'Dapat merakit robot dari komponen dasar',
                    'Memahami sensor dan aktuator'
                ],
                'tools_needed' => [
                    'Arduino Uno',
                    'Breadboard',
                    'Komponen elektronika dasar',
                    'Laptop/PC'
                ],
                'demo_video' => 'https://youtube.com/watch?v=example1'
            ],
            [
                'title' => 'Film Making Complete Course',
                'slug' => 'film-making-complete-course',
                'description' => 'Kursus pembuatan film lengkap mulai dari konsep, scripting, shooting, editing hingga post-production. Cocok untuk content creator dan filmmaker pemula.',
                'short_description' => 'Kursus lengkap pembuatan film untuk content creator',
                'category' => 'Film',
                'price' => 299000,
                'discount_price' => null,
                'duration' => '6 Minggu',
                'total_lessons' => 24,
                'level' => 'Intermediate',
                'is_featured' => true,
                'is_active' => true,
                'prerequisites' => [
                    'Basic video editing knowledge',
                    'Akses ke kamera (smartphone pun cukup)',
                    'Kreativitas dan dedikasi'
                ],
                'learning_outcomes' => [
                    'Mampu membuat film pendek berkualitas',
                    'Menguasai teknik cinematography',
                    'Ahli dalam video editing',
                    'Memahami storytelling yang baik'
                ],
                'tools_needed' => [
                    'Kamera/Smartphone',
                    'Adobe Premiere Pro atau DaVinci Resolve',
                    'Tripod',
                    'Lighting equipment (opsional)'
                ],
                'demo_video' => 'https://youtube.com/watch?v=example2'
            ],
            [
                'title' => 'Content Creation Mastery',
                'slug' => 'content-creation-mastery',
                'description' => 'Pelajari seni membuat konten yang engaging dan viral di media sosial. Dari planning, production, hingga distribution strategy.',
                'short_description' => 'Master content creation untuk media sosial dan digital marketing',
                'category' => 'Content Creation',
                'price' => 179000,
                'discount_price' => 129000,
                'duration' => '3 Minggu',
                'total_lessons' => 12,
                'level' => 'Beginner',
                'is_featured' => false,
                'is_active' => true,
                'prerequisites' => [
                    'Memiliki akun media sosial',
                    'Basic understanding of social media',
                    'Kreativitas'
                ],
                'learning_outcomes' => [
                    'Membuat konten yang engaging',
                    'Memahami algorithm media sosial',
                    'Strategi content planning',
                    'Analytics dan optimization'
                ],
                'tools_needed' => [
                    'Smartphone',
                    'Canva atau Photoshop',
                    'Content planning tools',
                    'Akses internet'
                ],
                'demo_video' => null
            ],
            [
                'title' => 'Programming Fundamentals',
                'slug' => 'programming-fundamentals',
                'description' => 'Kursus dasar pemrograman dengan Python. Cocok untuk pemula yang ingin memulai karir di bidang teknologi.',
                'short_description' => 'Belajar programming dari nol dengan Python',
                'category' => 'Programming',
                'price' => 249000,
                'discount_price' => 199000,
                'duration' => '5 Minggu',
                'total_lessons' => 20,
                'level' => 'Beginner',
                'is_featured' => false,
                'is_active' => true,
                'prerequisites' => [
                    'Pengetahuan dasar komputer',
                    'Logika berpikir',
                    'Dedikasi untuk belajar'
                ],
                'learning_outcomes' => [
                    'Memahami konsep programming',
                    'Menguasai Python basics',
                    'Dapat membuat program sederhana',
                    'Siap untuk advanced programming'
                ],
                'tools_needed' => [
                    'Python 3.x',
                    'Visual Studio Code',
                    'Git',
                    'Terminal/Command Prompt'
                ],
                'demo_video' => 'https://youtube.com/watch?v=example4'
            ],
            [
                'title' => 'Graphic Design with Adobe Creative Suite',
                'slug' => 'graphic-design-adobe-creative',
                'description' => 'Kursus design grafis menggunakan Adobe Creative Suite (Photoshop, Illustrator, InDesign). Dari basic hingga advanced techniques.',
                'short_description' => 'Master graphic design dengan Adobe Creative Suite',
                'category' => 'Design',
                'price' => 349000,
                'discount_price' => 279000,
                'duration' => '8 Minggu',
                'total_lessons' => 32,
                'level' => 'Advanced',
                'is_featured' => true,
                'is_active' => true,
                'prerequisites' => [
                    'Basic computer skills',
                    'Access to Adobe Creative Suite',
                    'Design sense and creativity'
                ],
                'learning_outcomes' => [
                    'Professional graphic design skills',
                    'Adobe software mastery',
                    'Brand identity design',
                    'Print and digital design'
                ],
                'tools_needed' => [
                    'Adobe Creative Suite',
                    'High-performance computer',
                    'Graphics tablet (recommended)',
                    'Color calibrated monitor'
                ],
                'demo_video' => 'https://youtube.com/watch?v=example5'
            ]
        ];

        foreach ($courses as $course) {
            Ecourse::create($course);
        }
    }
}
