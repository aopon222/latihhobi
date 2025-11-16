<?php

namespace App\Http\Controllers;

use App\Models\Ecourse;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class EcourseController extends Controller
{
    public function index()
    {
        // Ambil semua data course
        $ecourses = Ecourse::with('category')->get();

        // Kirim ke view
        return view('ecourse', compact('ecourses'));
    }

    /**
     * Show Robotik courses
     */
    public function robotik()
    {
        $category = Category::where('name', 'Robotik')
            ->orWhere('name', 'LIKE', '%Robotik%')
            ->first();
        
        $robotikCourses = $category 
            ? Ecourse::where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
            : collect();
        
        return view('ecourse.ecourse-robotik', compact('robotikCourses'));
    }

    /**
     * Show Komik courses
     */
    public function komik()
    {
        $category = Category::where('name', 'Komik')
            ->orWhere('name', 'LIKE', '%Komik%')
            ->first();
        
        $komikCourses = $category 
            ? Ecourse::where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
            : collect();
        
        return view('ecourse.ecourse-komik', compact('komikCourses'));
    }

    /**
     * Show Film & Konten Kreator courses
     */
    public function film()
    {
        $category = Category::where('name', 'Film')
            ->orWhere('name', 'Film & Konten Kreator')
            ->orWhere('name', 'LIKE', '%Film%')
            ->first();
        
        $filmCourses = $category 
            ? Ecourse::where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
            : collect();
        
        return view('ecourse.ecourse-film-konten-kreator', compact('filmCourses'));
    }

    /**
     * Show detail course
     */
    public function show($id)
    {
        $course = Ecourse::findOrFail($id);
        return view('ecourse.show', compact('course'));
    }

    /**
     * Add course to cart
     */
    public function addToCart($id)
    {
        $course = Ecourse::findOrFail($id);
        
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = auth()->user();
        
        // Check if user already has this course in cart
        $cartItem = CartItem::whereHas('cart', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->where('id_course', $id)->first();

        if ($cartItem) {
            return back()->with('info', 'Course sudah ada di keranjang Anda');
        }

        // Get or create user cart
        $cart = Cart::firstOrCreate(
            ['id_user' => $user->id]
        );

        // Add course to cart
        CartItem::create([
            'id_cart' => $cart->id_cart,
            'id_course' => $id,
            'quantity' => 1,
            'price' => $course->price,
            'sub_total' => $course->price
        ]);

        return redirect()->route('cart.index')->with('success', 'Course berhasil ditambahkan ke keranjang!');
    }
}
