<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality and email verification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';
        
        $this->info('Testing email configuration...');
        $this->info('Mail driver: ' . config('mail.default'));
        $this->info('Mail host: ' . config('mail.mailers.smtp.host'));
        $this->info('From address: ' . config('mail.from.address'));
        
        try {
            // Test basic email sending
            Mail::raw('Test email from LatihHobi - ' . now(), function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email - LatihHobi');
            });
            
            $this->info('Basic email test sent successfully!');
            
            // Test email verification if user exists
            $user = User::where('email', $email)->first();
            if ($user) {
                $this->info('Testing email verification for user: ' . $user->name);
                $user->sendEmailVerificationNotification();
                $this->info('Email verification sent successfully!');
            } else {
                $this->warn('No user found with email: ' . $email);
            }
            
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
