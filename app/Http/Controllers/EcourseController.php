<?php

namespace App\Http\Controllers;

use App\Models\Ecourse;
use App\Models\Category;
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

    public function robotik()
    {
        // Cari kategori Robotik
        $category = Category::where('name', 'Robotik')
            ->orWhere('name', 'LIKE', '%Robotik%')
            ->first();

        // Ambil courses robotik - urutkan berdasarkan id_course (sesuai urutan seeding)
        $robotikCourses = $category
            ? Ecourse::active()->where('id_category', $category->id_category)->orderBy('id_course', 'asc')->get()
            : collect();

        return view('ecourse.ecourse-robotik', compact('robotikCourses'));
    }

    public function komik()
    {
        // Cari kategori Komik
        $category = Category::where('name', 'Komik')
            ->orWhere('name', 'LIKE', '%Komik%')
            ->first();

        // Ambil courses komik
        $komikCourses = $category
            ? Ecourse::active()->where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
            : collect();

        return view('ecourse.ecourse-komik', compact('komikCourses'));
    }

    public function filmKontenKreator()
    {
        // Cari kategori Film & Konten Kreator
        $category = Category::where('name', 'Film & Konten Kreator')
            ->orWhere('name', 'Film')
            ->orWhere('name', 'LIKE', '%Film%')
            ->first();

        // Ambil courses film
        $filmCourses = $category
            ? Ecourse::active()->where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
            : collect();

        return view('ecourse.ecourse-film-konten-kreator', compact('filmCourses'));
    }

    public function show($id)
    {
        /**
         * Show detail course
         */
        $course = Ecourse::findOrFail($id);
        return view('ecourse.show', compact('course'));
    }

    public function addToCart($id)
    {
        /**
         * Add course to cart
         */
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $course = Ecourse::findOrFail($id);
        $user = auth()->user();

        // Ambil atau buat cart user (gunakan id dari model User)
        $cart = \App\Models\Cart::firstOrCreate([
            'id_user' => $user->id,
        ]);

        // Cek apakah course sudah ada di cart
        $cartItem = \App\Models\CartItem::where('id_cart', $cart->id_cart)
            ->where('id_course', $id)
            ->first();

        if ($cartItem) {
            return redirect()->back()->with('info', 'Course sudah ada di keranjang');
        }

        // Tambah ke cart — sertakan harga dan subtotal agar insert tidak gagal (kolom NOT NULL)
        $quantity = 1;
        $price = $course->price;
        $subTotal = $price * $quantity;

        \App\Models\CartItem::create([
            'id_cart' => $cart->id_cart,
            'id_course' => $id,
            'quantity' => $quantity,
            'price' => $price,
            'sub_total' => $subTotal,
        ]);

        return redirect()->back()->with('success', 'Course berhasil ditambahkan ke keranjang');
    }
}
