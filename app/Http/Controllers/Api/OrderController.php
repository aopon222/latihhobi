<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items.course', 'coupon'])
            ->where('id_user', $request->user()->id)
            ->orderBy('order_date', 'desc')
            ->get();

        return response()->json(['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'nullable|string|exists:coupon,code',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cart = Cart::with('items.course')->where('id_user', $request->user()->id)->first();

        if (!$cart || $cart->items->count() == 0) {
            return response()->json(['message' => 'Cart kosong'], 400);
        }

        DB::beginTransaction();
        try {
            $subtotal = $cart->items->sum('sub_total');
            $discountAmount = 0;
            $couponId = null;
            $couponCode = null;

            // Apply coupon if provided
            if ($request->coupon_code) {
                $coupon = Coupon::where('code', $request->coupon_code)->first();

                if (!$coupon || !$coupon->isValid()) {
                    DB::rollBack();
                    return response()->json(['message' => 'Coupon tidak valid'], 400);
                }

                $discountAmount = $coupon->calculateDiscount($subtotal);
                
                if ($discountAmount == 0) {
                    DB::rollBack();
                    return response()->json([
                        'message' => 'Minimum order belum terpenuhi',
                        'min_order_amount' => $coupon->min_order_amount
                    ], 400);
                }

                $couponId = $coupon->id_coupon;
                $couponCode = $coupon->code;

                // Increment coupon usage
                $coupon->increment('used_count');
            }

            $totalAmount = $subtotal - $discountAmount;

            // Create order
            $order = Order::create([
                'id_user' => $request->user()->id,
                'id_coupon' => $couponId,
                'coupon_code' => $couponCode,
                'discount_amount' => $discountAmount,
                'subtotal' => $subtotal,
                'total_amount' => $totalAmount,
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_course' => $item->id_course,
                    'course_name' => $item->course->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->sub_total,
                ]);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order berhasil dibuat',
                'order' => $order->load(['items', 'coupon'])
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $order = Order::with(['items.course', 'coupon', 'user'])
            ->where('id_order', $id)
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        // Check if user is authorized (owner or admin)
        if ($order->id_user !== $request->user()->id && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['order' => $order]);
    }

    public function allOrders(Request $request)
    {
        // Admin only
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $orders = Order::with(['items', 'user', 'coupon'])
            ->orderBy('order_date', 'desc')
            ->get();

        return response()->json(['orders' => $orders]);
    }
}
