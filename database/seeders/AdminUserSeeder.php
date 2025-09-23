<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'multimedia.latihhobi@gmail.com'],
            [
                'name' => 'Admin LatihHobi',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
