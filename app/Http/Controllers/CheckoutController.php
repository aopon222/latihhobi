<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout page
     */
    public function index()
    {
        $cartItems = Cart::with('course')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->course->price * $item->quantity;
        });

        $tax = $subtotal * 0.11; // PPN 11%
        $total = $subtotal + $tax;

        return view('checkout.index', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:500',
        ]);

        $cartItems = Cart::with('course')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ]);
        }

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = $cartItems->sum(function($item) {
                return $item->course->price * $item->quantity;
            });
            $tax = $subtotal * 0.11;
            $total = $subtotal + $tax;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $this->generateOrderNumber(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'billing_name' => $request->billing_name,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'billing_address' => $request->billing_address,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'course_id' => $cartItem->course_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->course->price,
                    'total' => $cartItem->course->price * $cartItem->quantity,
                ]);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Redirect to payment page
            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'redirect_url' => route('payment.show', $order->id)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Generate unique order number
     */
    private function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        // Simple coupon system - you can expand this
        $validCoupons = [
            'WELCOME10' => 10, // 10% discount
            'SAVE20' => 20,    // 20% discount
            'STUDENT15' => 15  // 15% discount
        ];

        $couponCode = strtoupper($request->coupon_code);

        if (!isset($validCoupons[$couponCode])) {
            return response()->json([
                'success' => false,
                'message' => 'Kode kupon tidak valid'
            ]);
        }

        $discount = $validCoupons[$couponCode];

        return response()->json([
            'success' => true,
            'message' => 'Kupon berhasil diterapkan',
            'discount' => $discount,
            'coupon_code' => $couponCode
        ]);
    }

    /**
     * Calculate shipping cost (if needed)
     */
    public function calculateShipping(Request $request)
    {
        // For digital products, shipping is usually 0
        // But you can implement logic for physical products
        
        return response()->json([
            'success' => true,
            'shipping_cost' => 0,
            'message' => 'Gratis ongkir untuk produk digital'
        ]);
    }

    /**
     * Validate checkout data
     */
    public function validateCheckout(Request $request)
    {
        $cartItems = Cart::with('course')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ]);
        }

        // Check if all courses are still available
        foreach ($cartItems as $item) {
            if (!$item->course->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kursus "' . $item->course->title . '" tidak lagi tersedia'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Checkout data valid'
        ]);
    }
}
