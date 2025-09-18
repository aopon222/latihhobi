<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin LatihHobi',
            'email' => 'admin@latihhobi.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@latihhobi.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Create unverified user
        User::create([
            'name' => 'Unverified User',
            'email' => 'unverified@latihhobi.id',
            'email_verified_at' => null, // Not verified
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}