<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TestLogin extends Command
{
    protected $signature = 'test:login {email} {password}';
    protected $description = 'Test login functionality';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $this->info("Testing login for: {$email}");

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $this->info("✅ Login BERHASIL!");
            $this->info("User: " . Auth::user()->name);
            $this->info("Email: " . Auth::user()->email);
            $this->info("Verified: " . (Auth::user()->hasVerifiedEmail() ? 'Yes' : 'No'));
        } else {
            $this->error("❌ Login GAGAL!");
            
            $user = User::where('email', $email)->first();
            if ($user) {
                $this->info("User ditemukan di database");
                $this->info("Cek password hash...");
                if (\Hash::check($password, $user->password)) {
                    $this->info("Password benar");
                } else {
                    $this->error("Password salah");
                }
            } else {
                $this->error("User tidak ditemukan di database");
            }
        }
    }
}