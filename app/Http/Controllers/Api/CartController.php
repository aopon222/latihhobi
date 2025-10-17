<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CourseCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = Cart::with(['items.course'])->firstOrCreate(
            ['id_user' => $request->user()->id]
        );

        return response()->json([
            'cart' => $cart,
            'total' => $cart->total
        ]);
    }

    public function addItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_course' => 'required|exists:course_card,id_course',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = CourseCard::find($request->id_course);
        $cart = Cart::firstOrCreate(['id_user' => $request->user()->id]);

        $existingItem = CartItem::where('id_cart', $cart->id_cart)
            ->where('id_course', $request->id_course)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->sub_total = $existingItem->quantity * $course->price;
            $existingItem->save();

            return response()->json([
                'message' => 'Quantity berhasil diupdate',
                'item' => $existingItem
            ]);
        }

        $cartItem = CartItem::create([
            'id_cart' => $cart->id_cart,
            'id_course' => $request->id_course,
            'quantity' => $request->quantity,
            'price' => $course->price,
            'sub_total' => $request->quantity * $course->price,
        ]);

        return response()->json([
            'message' => 'Item berhasil ditambahkan ke cart',
            'item' => $cartItem->load('course')
        ], 201);
    }

    public function updateItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        // Verify ownership
        if ($cartItem->cart->id_user !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->sub_total = $cartItem->quantity * $cartItem->price;
        $cartItem->save();

        return response()->json([
            'message' => 'Item berhasil diupdate',
            'item' => $cartItem->load('course')
        ]);
    }

    public function removeItem(Request $request, $id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        // Verify ownership
        if ($cartItem->cart->id_user !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item berhasil dihapus dari cart']);
    }

    public function clear(Request $request)
    {
        $cart = Cart::where('id_user', $request->user()->id)->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json(['message' => 'Cart berhasil dikosongkan']);
    }
}