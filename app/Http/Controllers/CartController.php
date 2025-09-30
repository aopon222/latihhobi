<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Cart::with('course')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'quantity' => 'integer|min:1|max:10'
        ]);

        $course = Course::findOrFail($request->course_id);
        $quantity = $request->quantity ?? 1;

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'quantity' => $quantity,
                'price' => $course->price
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kursus berhasil ditambahkan ke keranjang',
                'cart_count' => $this->getCartCount()
            ]);
        }

        return redirect()->back()->with('success', 'Kursus berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if ($cart->user_id !== Auth::id()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diupdate',
                'total' => $cart->formatted_total,
                'cart_total' => $this->getCartTotal()
            ]);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diupdate');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $cart->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang',
                'cart_count' => $this->getCartCount(),
                'cart_total' => $this->getCartTotal()
            ]);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan'
            ]);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function getCartCount()
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }

    public function getCartTotal()
    {
        return Cart::where('user_id', Auth::id())
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->price;
            });
    }

    public function cartData()
    {
        return response()->json([
            'count' => $this->getCartCount(),
            'total' => $this->getCartTotal(),
            'formatted_total' => 'Rp ' . number_format($this->getCartTotal(), 0, ',', '.')
        ]);
    }
}
