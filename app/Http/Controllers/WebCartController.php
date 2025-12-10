<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function update(Request $request, $id)
    {
        Log::info('WebCartController@update called', ['user_id' => Auth::id(), 'id' => $id, 'payload' => $request->all()]);
        $request->validate([
            'quantity' => 'required|integer|min:1|max:999',
        ]);

        $item = CartItem::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
        }

        if (!$item->cart || $item->cart->id_user != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $item->quantity = (int) $request->quantity;
        $item->sub_total = $item->quantity * $item->price;
        $item->save();

        $cart = Cart::with('items')->where('id_user', Auth::id())->first();
        $items = $cart ? $cart->items : collect();

        $total_items = $items->sum('quantity');
        $subtotal = $items->sum(function ($it) { return $it->quantity * $it->price; });
        $cart_count = $items->count();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'total_items' => $total_items,
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'cart_count' => $cart_count,
        ]);
    }

    public function remove(Request $request, $id)
    {
        Log::info('WebCartController@remove called', ['user_id' => Auth::id(), 'id' => $id, 'payload' => $request->all()]);
        $item = CartItem::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
        }

        if (!$item->cart || $item->cart->id_user != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $item->delete();

        $cart = Cart::with('items')->where('id_user', Auth::id())->first();
        $items = $cart ? $cart->items : collect();

        $total_items = $items->sum('quantity');
        $subtotal = $items->sum(function ($it) { return $it->quantity * $it->price; });
        $cart_count = $items->count();

        return response()->json([
            'success' => true,
            'message' => 'Item removed',
            'total_items' => $total_items,
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'cart_count' => $cart_count,
        ]);
    }

    public function clear(Request $request)
    {
        Log::info('WebCartController@clear called', ['user_id' => Auth::id(), 'payload' => $request->all()]);
        $cart = Cart::with('items')->where('id_user', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
            'total_items' => 0,
            'subtotal' => 0,
            'total' => 0,
            'cart_count' => 0,
        ]);
    }
}
