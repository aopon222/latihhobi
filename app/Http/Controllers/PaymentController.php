<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\EcourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show payment page
     */
    public function show(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order');
        }

        // Load order items with courses
        $order->load('orderItems.course');

        return view('payment.show', compact('order'));
    }

    /**
     * Process payment
     */
    public function process(Request $request, Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        // Check if order is still pending
        if ($order->payment_status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order sudah diproses sebelumnya'
            ]);
        }

        $request->validate([
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
        ]);

        DB::beginTransaction();

        try {
            // Simulate payment processing based on method
            $paymentResult = $this->processPaymentByMethod($request->payment_method, $order);

            if ($paymentResult['success']) {
                // Update order status
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'completed',
                    'paid_at' => now(),
                    'payment_reference' => $paymentResult['reference']
                ]);

                // Create enrollments for purchased ecourses
                $order->load('orderItems.course');
                foreach ($order->orderItems as $item) {
                    // Check if the purchased item is an ecourse
                    if ($item->course && $item->course instanceof \App\Models\Ecourse) {
                        // Create enrollment if not already exists
                        $existingEnrollment = \App\Models\EcourseEnrollment::where('user_id', $order->user_id)
                            ->where('ecourse_id', $item->course->id_course)
                            ->first();

                        if (!$existingEnrollment) {
                            \App\Models\EcourseEnrollment::create([
                                'user_id' => $order->user_id,
                                'id_course' => $item->course->id_course,
                                'status' => 'active',
                                'is_locked' => true, // Default locked, admin must unlock
                                'enrolled_at' => now(),
                            ]);
                        }
                    }
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran berhasil diproses',
                    'redirect_url' => route('payment.success', $order->id)
                ]);
            } else {
                DB::rollback();
                
                return response()->json([
                    'success' => false,
                    'message' => $paymentResult['message']
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment processing error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam memproses pembayaran'
            ]);
        }
    }

    /**
     * Payment success page
     */
    public function success(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Load order items with courses
        $order->load('orderItems.course');

        return view('payment.success', compact('order'));
    }

    /**
     * Payment failed page
     */
    public function failed(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('payment.failed', compact('order'));
    }

    /**
     * Process payment by method (simulation)
     */
    private function processPaymentByMethod($method, $order)
    {
        switch ($method) {
            case 'bank_transfer':
                return $this->processBankTransfer($order);
            case 'credit_card':
                return $this->processCreditCard($order);
            case 'e_wallet':
                return $this->processEWallet($order);
            default:
                return [
                    'success' => false,
                    'message' => 'Metode pembayaran tidak valid'
                ];
        }
    }

    /**
     * Process bank transfer payment
     */
    private function processBankTransfer($order)
    {
        // Simulate bank transfer processing
        // In real implementation, you would integrate with payment gateway
        
        return [
            'success' => true,
            'reference' => 'BT-' . time() . '-' . $order->id,
            'message' => 'Transfer bank berhasil diproses'
        ];
    }

    /**
     * Process credit card payment
     */
    private function processCreditCard($order)
    {
        // Simulate credit card processing
        // In real implementation, you would integrate with payment gateway like Stripe, Midtrans, etc.
        
        // Simulate 95% success rate
        if (rand(1, 100) <= 95) {
            return [
                'success' => true,
                'reference' => 'CC-' . time() . '-' . $order->id,
                'message' => 'Pembayaran kartu kredit berhasil'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Pembayaran kartu kredit ditolak'
            ];
        }
    }

    /**
     * Process e-wallet payment
     */
    private function processEWallet($order)
    {
        // Simulate e-wallet processing (OVO, GoPay, DANA, etc.)
        // In real implementation, you would integrate with respective APIs
        
        return [
            'success' => true,
            'reference' => 'EW-' . time() . '-' . $order->id,
            'message' => 'Pembayaran e-wallet berhasil'
        ];
    }

    /**
     * Handle payment webhook (for real payment gateways)
     */
    public function webhook(Request $request)
    {
        // This would handle webhooks from payment gateways
        // For now, it's just a placeholder
        
        Log::info('Payment webhook received', $request->all());
        
        return response()->json(['status' => 'received']);
    }

    /**
     * Check payment status
     */
    public function checkStatus(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        return response()->json([
            'success' => true,
            'payment_status' => $order->payment_status,
            'order_status' => $order->status,
            'paid_at' => $order->paid_at
        ]);
    }

    /**
     * Cancel payment
     */
    public function cancel(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        // Check if order can be cancelled
        if ($order->payment_status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak dapat dibatalkan'
            ]);
        }

        DB::beginTransaction();

        try {
            // Update order status
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'cancelled'
            ]);

            // Restore items to cart (optional)
            foreach ($order->orderItems as $item) {
                \App\Models\Cart::create([
                    'user_id' => $order->user_id,
                    'course_id' => $item->course_id,
                    'quantity' => $item->quantity
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibatalkan',
                'redirect_url' => route('cart.index')
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam membatalkan order'
            ]);
        }
    }
}
