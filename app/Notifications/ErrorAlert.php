<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ErrorAlert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private \Throwable $exception)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Application Error Alert')
            ->line('An error occurred in the application:')
            ->line('**Message:** ' . $this->exception->getMessage())
            ->line('**File:** ' . $this->exception->getFile())
            ->line('**Line:** ' . $this->exception->getLine())
            ->line('**Stack Trace:**')
            ->line('```')
            ->line($this->exception->getTraceAsString())
            ->line('```')
            ->action('View Application', url('/'))
            ->line('Please check the application logs for more details.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
