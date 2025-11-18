<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Robotik', 'icon' => 'robotik.svg'],
            ['name' => 'Komik', 'icon' => 'komik.svg'],
            ['name' => 'Film & Konten Kreator', 'icon' => 'film.svg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
