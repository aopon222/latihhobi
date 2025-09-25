<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Podcast;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $podcasts = [
            [
                'title' => 'Mengembangkan Bakat Robotik Sejak Dini',
                'description' => 'Podcast episode pertama membahas tentang pentingnya mengembangkan bakat robotik pada anak sejak usia dini. Kami akan berbagi tips dan strategi untuk orang tua dalam mendukung minat anak di bidang teknologi.',
                'youtube_id' => 'WGYhFezEUU8',
                'duration' => '25:30',
                'host' => 'Dr. Sarah Putri',
                'guest' => 'Prof. Ahmad Robotic',
                'topics' => ['Robotik', 'Pendidikan Anak', 'Teknologi'],
                'published_date' => now()->subDays(7),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Seni Film dan Konten Kreatif untuk Generasi Muda',
                'description' => 'Episode kedua membahas tentang dunia film dan konten kreatif. Kami akan mengupas bagaimana generasi muda bisa memulai karir di industri kreatif dan mengembangkan skill filmmaking.',
                'youtube_id' => 'pI0az6-8g1A',
                'duration' => '32:15',
                'host' => 'Maya Film Director',
                'guest' => 'Budi Content Creator',
                'topics' => ['Film', 'Konten Kreatif', 'Karir'],
                'published_date' => now()->subDays(5),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Komik sebagai Media Pembelajaran yang Menyenangkan',
                'description' => 'Podcast episode ketiga membahas tentang penggunaan komik sebagai media pembelajaran yang efektif dan menyenangkan. Kami akan berbagi pengalaman dalam membuat komik edukatif.',
                'youtube_id' => 'Jlzxd77ti_I',
                'duration' => '28:45',
                'host' => 'Komikus Andi',
                'guest' => 'Guru Siti',
                'topics' => ['Komik', 'Pembelajaran', 'Edukasi'],
                'published_date' => now()->subDays(3),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Membangun Komunitas Pembelajar yang Solid',
                'description' => 'Episode keempat membahas tentang pentingnya membangun komunitas pembelajar yang solid. Kami akan berbagi tips dalam menciptakan lingkungan belajar yang suportif dan kolaboratif.',
                'youtube_id' => 'PBxrGxMmy-4',
                'duration' => '35:20',
                'host' => 'Lisa Community Manager',
                'guest' => 'Mentor Rudi',
                'topics' => ['Komunitas', 'Pembelajaran', 'Kolaborasi'],
                'published_date' => now()->subDays(1),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($podcasts as $podcast) {
            Podcast::create($podcast);
        }
    }
}
