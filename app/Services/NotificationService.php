<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send a notification to a user
     */
    public function sendToUser(User $user, string $type, string $title, string $message, array $data = [])
    {
        try {
            // Create database notification
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'is_read' => false,
            ]);
            
            // Send email notification if user has email notifications enabled
            // In a real implementation, you would check user preferences
            $this->sendEmailNotification($user, $type, $title, $message, $data);
            
            return $notification;
        } catch (\Exception $e) {
            Log::error('Failed to send notification', [
                'user_id' => $user->id,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);
            
            return null;
        }
    }
    
    /**
     * Send a notification to multiple users
     */
    public function sendToUsers($users, string $type, string $title, string $message, array $data = [])
    {
        $notifications = [];
        
        foreach ($users as $user) {
            $notification = $this->sendToUser($user, $type, $title, $message, $data);
            if ($notification) {
                $notifications[] = $notification;
            }
        }
        
        return $notifications;
    }
    
    /**
     * Send an email notification
     */
    protected function sendEmailNotification(User $user, string $type, string $title, string $message, array $data = [])
    {
        try {
            // In a real implementation, you would use a mailable class
            // For now, we'll just log the email
            Log::info('Email notification sent', [
                'to' => $user->email,
                'subject' => $title,
                'message' => $message,
            ]);
            
            // Example of how you might send an actual email:
            /*
            Mail::send('emails.notification', [
                'title' => $title,
                'message' => $message,
                'data' => $data,
            ], function ($mail) use ($user, $title) {
                $mail->to($user->email)
                     ->subject($title);
            });
            */
        } catch (\Exception $e) {
            Log::error('Failed to send email notification', [
                'user_id' => $user->id,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);
        }
    }
    
    /**
     * Send a payment confirmation notification
     */
    public function sendPaymentConfirmation(User $user, $payment)
    {
        $title = 'Payment Confirmation';
        $message = 'Your payment of Rp ' . number_format($payment->amount, 0, ',', '.') . ' has been confirmed.';
        $data = [
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
        ];
        
        return $this->sendToUser($user, 'payment_confirmation', $title, $message, $data);
    }
    
    /**
     * Send a course enrollment notification
     */
    public function sendCourseEnrollment(User $user, $enrollment)
    {
        $title = 'Course Enrollment Confirmation';
        $message = 'You have been successfully enrolled in ' . $enrollment->ecourse->title . '.';
        $data = [
            'enrollment_id' => $enrollment->id,
            'ecourse_id' => $enrollment->ecourse_id,
            'ecourse_title' => $enrollment->ecourse->title,
        ];
        
        return $this->sendToUser($user, 'course_enrollment', $title, $message, $data);
    }
    
    /**
     * Send a lesson completion notification
     */
    public function sendLessonCompletion(User $user, $lesson, $ecourse)
    {
        $title = 'Lesson Completed';
        $message = 'You have completed the lesson "' . $lesson->title . '" in ' . $ecourse->title . '.';
        $data = [
            'lesson_id' => $lesson->id,
            'lesson_title' => $lesson->title,
            'ecourse_id' => $ecourse->id,
            'ecourse_title' => $ecourse->title,
        ];
        
        return $this->sendToUser($user, 'lesson_completion', $title, $message, $data);
    }
    
    /**
     * Send an event registration notification
     */
    public function sendEventRegistration(User $user, $event)
    {
        $title = 'Event Registration Confirmation';
        $message = 'You have been successfully registered for ' . $event->title . '.';
        $data = [
            'event_id' => $event->id,
            'event_title' => $event->title,
            'event_date' => $event->start_date,
        ];
        
        return $this->sendToUser($user, 'event_registration', $title, $message, $data);
    }
}