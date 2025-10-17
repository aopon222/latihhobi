<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json(['coupons' => $coupons]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:coupon,code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $coupon = Coupon::create($request->all());

        return response()->json([
            'message' => 'Coupon berhasil dibuat',
            'coupon' => $coupon
        ], 201);
    }

    public function show($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Coupon tidak ditemukan'], 404);
        }

        return response()->json(['coupon' => $coupon]);
    }

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['message' => 'Kode coupon tidak valid'], 404);
        }

        if (!$coupon->isValid()) {
            return response()->json(['message' => 'Coupon sudah tidak berlaku'], 400);
        }

        $discount = $coupon->calculateDiscount($request->subtotal);

        if ($discount == 0) {
            return response()->json([
                'message' => 'Minimum order belum terpenuhi',
                'min_order_amount' => $coupon->min_order_amount
            ], 400);
        }

        return response()->json([
            'message' => 'Coupon valid',
            'coupon' => $coupon,
            'discount_amount' => $discount,
            'final_total' => $request->subtotal - $discount
        ]);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Coupon tidak ditemukan'], 404);
        }

        $coupon->delete();

        return response()->json(['message' => 'Coupon berhasil dihapus']);
    }
}
