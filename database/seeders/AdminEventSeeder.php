<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class AdminEventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'title' => 'Workshop Fotografi Pemula',
            'short_description' => 'Belajar dasar-dasar fotografi dan komposisi.',
            'description' => 'Workshop intensif selama 1 hari yang membahas teknik dasar fotografi, pencahayaan, dan editing ringan.',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(10)->addHours(6),
            'registration_start' => now(),
            'registration_end' => now()->addDays(9),
            'location' => 'Studio LatihHobi',
            'max_participants' => 30,
            'current_participants' => 0,
            'price' => 150000,
            'is_featured' => true,
            'is_active' => true,
            'status' => 'open',
        ]);
    }
}
