<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class WebCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = Cart::with(['items.course'])->where('id_user', Auth::id())->first();

        $items = $cart ? $cart->items : collect();

        $total = $items->sum(function ($it) {
            return $it->quantity * $it->price;
        });

        // The existing cart view expects $cartItems variable
        $cartItems = $items;

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function getCartData()
    {
        if (!Auth::check()) {
            return response()->json(['items' => [], 'total' => 0, 'count' => 0]);
        }

        $cart = Cart::with(['items.course'])->where('id_user', Auth::id())->first();
        $items = $cart ? $cart->items : collect();

        $total = $items->sum(function ($it) {
            return $it->quantity * $it->price;
        });

        $count = $items->sum('quantity');

        $formattedItems = $items->map(function ($item) {
            return [
                'id' => $item->id_cart_items,
                'name' => $item->course ? $item->course->name : 'Product',
                'quantity' => $item->quantity,
                'price' => (float)$item->price,
                'subtotal' => $item->quantity * $item->price,
            ];
        });

        return response()->json([
            'items' => $formattedItems,
            'total' => (float)$total,
            'count' => $count,
        ]);
    }
}
