<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        $adminEmail = 'multimedia.latihhobi@gmail.com';
        
        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin Latih Hobi',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}