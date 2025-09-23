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
                'slug' => 'mengembangkan-bakat-robotik-sejak-dini',
                'description' => 'Podcast episode pertama membahas tentang pentingnya mengembangkan bakat robotik pada anak sejak usia dini. Kami akan berbagi tips dan strategi untuk orang tua dalam mendukung minat anak di bidang teknologi.',
                'short_description' => 'Tips mengembangkan bakat robotik pada anak sejak dini',
                'youtube_url' => 'https://www.youtube.com/watch?v=WGYhFezEUU8',
                'audio_url' => 'https://example.com/audio/1.mp3',
                'duration' => 1530, // 25:30 in seconds
                'episode_number' => 1,
                'season' => 'Season 1',
                'published_at' => now()->subDays(7),
                'published_date' => now()->subDays(7),
                'is_featured' => true,
                'sort_order' => 1,
                'status' => 'published',
                'guests' => json_encode(['Dr. Sarah Putri (Host)', 'Prof. Ahmad Robotic (Guest)']),
                'topics' => json_encode(['Robotik', 'Pendidikan Anak', 'Teknologi']),
            ],
            [
                'title' => 'Seni Film dan Konten Kreatif untuk Generasi Muda',
                'slug' => 'seni-film-dan-konten-kreatif-untuk-generasi-muda',
                'description' => 'Episode kedua membahas tentang dunia film dan konten kreatif. Kami akan mengupas bagaimana generasi muda bisa memulai karir di industri kreatif dan mengembangkan skill filmmaking.',
                'short_description' => 'Mengupas dunia film dan konten kreatif untuk generasi muda',
                'youtube_url' => 'https://www.youtube.com/watch?v=pI0az6-8g1A',
                'audio_url' => 'https://example.com/audio/2.mp3',
                'duration' => 1935, // 32:15 in seconds
                'episode_number' => 2,
                'season' => 'Season 1',
                'published_at' => now()->subDays(5),
                'published_date' => now()->subDays(5),
                'is_featured' => true,
                'sort_order' => 2,
                'status' => 'published',
                'guests' => json_encode(['Maya Film Director (Host)', 'Budi Content Creator (Guest)']),
                'topics' => json_encode(['Film', 'Konten Kreatif', 'Karir']),
            ],
            [
                'title' => 'Komik sebagai Media Pembelajaran yang Menyenangkan',
                'slug' => 'komik-sebagai-media-pembelajaran-yang-menyenangkan',
                'description' => 'Podcast episode ketiga membahas tentang penggunaan komik sebagai media pembelajaran yang efektif dan menyenangkan. Kami akan berbagi pengalaman dalam membuat komik edukatif.',
                'short_description' => 'Penggunaan komik sebagai media pembelajaran yang efektif',
                'youtube_url' => 'https://www.youtube.com/watch?v=Jlzxd77ti_I',
                'audio_url' => 'https://example.com/audio/3.mp3',
                'duration' => 1725, // 28:45 in seconds
                'episode_number' => 3,
                'season' => 'Season 1',
                'published_at' => now()->subDays(3),
                'published_date' => now()->subDays(3),
                'is_featured' => true,
                'sort_order' => 3,
                'status' => 'published',
                'guests' => json_encode(['Komikus Andi (Host)', 'Guru Siti (Guest)']),
                'topics' => json_encode(['Komik', 'Pembelajaran', 'Edukasi']),
            ],
            [
                'title' => 'Membangun Komunitas Pembelajar yang Solid',
                'slug' => 'membangun-komunitas-pembelajar-yang-solid',
                'description' => 'Episode keempat membahas tentang pentingnya membangun komunitas pembelajar yang solid. Kami akan berbagi tips dalam menciptakan lingkungan belajar yang suportif dan kolaboratif.',
                'short_description' => 'Tips membangun komunitas pembelajar yang solid',
                'youtube_url' => 'https://www.youtube.com/watch?v=PBxrGxMmy-4',
                'audio_url' => 'https://example.com/audio/4.mp3',
                'duration' => 2120, // 35:20 in seconds
                'episode_number' => 4,
                'season' => 'Season 1',
                'published_at' => now()->subDays(1),
                'published_date' => now()->subDays(1),
                'is_featured' => true,
                'sort_order' => 4,
                'status' => 'published',
                'guests' => json_encode(['Community Manager Lisa (Host)', 'Mentor Rudi (Guest)']),
                'topics' => json_encode(['Komunitas', 'Pembelajaran', 'Kolaborasi']),
            ],
        ];

        foreach ($podcasts as $podcast) {
            Podcast::create($podcast);
        }
    }
}
