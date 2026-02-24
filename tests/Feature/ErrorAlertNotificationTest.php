<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ErrorAlert;

class ErrorAlertNotificationTest extends TestCase
{
    /**
     * Test that error alert notification can be sent
     */
    public function test_error_alert_notification_sends(): void
    {
        Notification::fake();

        $exception = new \Exception('Test error message', 0);
        
        Notification::route('mail', 'admin@latihhobi.com')
            ->notify(new ErrorAlert($exception));

        Notification::assertSentTo(
            ['admin@latihhobi.com'],
            ErrorAlert::class
        );
    }

    /**
     * Test that error alert contains exception details
     */
    public function test_error_alert_contains_exception_details(): void
    {
        Notification::fake();

        $errorMessage = 'Database connection failed';
        $exception = new \Exception($errorMessage);
        
        Notification::route('mail', 'admin@test.com')
            ->notify(new ErrorAlert($exception));

        Notification::assertSentTo(
            ['admin@test.com'],
            ErrorAlert::class,
            function ($notification) use ($errorMessage) {
                $mail = $notification->toMail(new class {
                    public $email = 'admin@test.com';
                });
                
                return strpos($mail->render(), $errorMessage) !== false;
            }
        );
    }
}