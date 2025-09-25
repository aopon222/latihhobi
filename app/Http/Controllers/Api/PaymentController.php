<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\EcourseEnrollment;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;

class PaymentController extends ApiBaseController
{
    protected $notificationService;
    
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * Get all payments for the authenticated user
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            $payments = Payment::where('user_id', $user->id)
                ->with(['ecourseEnrollment.ecourse', 'event'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($payments, 'Payments retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve payments', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific payment
     */
    public function show(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $payment = Payment::where('user_id', $user->id)
                ->with(['ecourseEnrollment.ecourse', 'event'])
                ->findOrFail($id);

            return $this->success($payment, 'Payment retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Payment not found', $e->getMessage(), 404);
        }
    }

    /**
     * Create a new payment for an e-course enrollment
     */
    public function storeForEcourse(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'ecourse_enrollment_id' => 'required|exists:ecourse_enrollments,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string|in:bank_transfer,e_wallet,credit_card',
                'transaction_id' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Get the enrollment
            $enrollment = EcourseEnrollment::findOrFail($request->ecourse_enrollment_id);
            
            // Verify the enrollment belongs to the user
            if ($enrollment->user_id !== $user->id) {
                return $this->error('Invalid enrollment', null, 403);
            }
            
            // Check if enrollment is already paid
            if ($enrollment->status !== 'pending_payment') {
                return $this->error('This enrollment does not require payment');
            }
            
            // Check if amount matches enrollment price
            if ($request->amount != $enrollment->price) {
                return $this->error('Payment amount does not match enrollment price');
            }
            
            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'ecourse_enrollment_id' => $enrollment->id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'status' => 'pending',
                'paid_at' => now(),
            ]);
            
            // Update enrollment status
            $enrollment->update([
                'status' => 'active',
                'activated_at' => now(),
            ]);
            
            // Send payment confirmation notification
            $this->notificationService->sendPaymentConfirmation($user, $payment);

            return $this->success($payment, 'Payment created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create payment', $e->getMessage(), 500);
        }
    }

    /**
     * Create a new payment for an event registration
     */
    public function storeForEvent(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'event_id' => 'required|exists:events,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string|in:bank_transfer,e_wallet,credit_card',
                'transaction_id' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Get the event
            $event = Event::where('is_active', true)
                ->where('status', 'open')
                ->findOrFail($request->event_id);
            
            // Check if amount matches event price
            if ($request->amount != $event->price) {
                return $this->error('Payment amount does not match event price');
            }
            
            // Check if user is registered for the event
            $registration = $user->eventRegistrations()
                ->where('event_id', $event->id)
                ->where('status', 'pending')
                ->first();
                
            if (!$registration) {
                return $this->error('You are not registered for this event or payment has already been made');
            }
            
            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'status' => 'pending',
                'paid_at' => now(),
            ]);
            
            // Update registration status
            $registration->update([
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ]);
            
            // Send event registration notification
            $this->notificationService->sendEventRegistration($user, $event);

            return $this->success($payment, 'Payment created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create payment', $e->getMessage(), 500);
        }
    }

    /**
     * Confirm payment
     */
    public function confirm(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $payment = Payment::where('user_id', $user->id)
                ->findOrFail($id);
                
            // Update payment status
            $payment->update([
                'status' => 'completed',
                'confirmed_at' => now(),
            ]);

            return $this->success($payment, 'Payment confirmed successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to confirm payment', $e->getMessage(), 500);
        }
    }

    /**
     * Upload payment proof
     */
    public function uploadProof(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'payment_proof' => 'required|string', // In a real implementation, this would be a file upload
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $payment = Payment::where('user_id', $user->id)
                ->findOrFail($id);
                
            // Update payment with proof
            $payment->update([
                'payment_proof' => $request->payment_proof,
                'status' => 'pending_verification',
            ]);

            return $this->success($payment, 'Payment proof uploaded successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to upload payment proof', $e->getMessage(), 500);
        }
    }
}