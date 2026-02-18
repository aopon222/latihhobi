<?php

namespace App\Http\Controllers;

use App\Models\Ecourse;
use App\Models\Category;
use App\Models\EcourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EcourseController extends Controller
{
    public function index()
    {
        $dbError = false;
        try {
            $ecourses = Ecourse::with('category')->get();
        } catch (\Throwable $e) {
            $ecourses = collect();
            $dbError = true;
        }

        // Kirim ke view (jika error, view akan menampilkan pesan)
        return view('ecourse', compact('ecourses', 'dbError'));
    }

    public function robotik()
    {
        // Cari kategori Robotik
        $category = Category::where('name', 'Robotik')
            ->orWhere('name', 'LIKE', '%Robotik%')
            ->first();

        // Ambil courses robotik - urutkan menurut level yang tertera pada thumbnail.
        // Karena file thumbnail mengikuti pola nama tertentu, kita map thumbnail -> level.
        // Jika mapping tidak cocok, kursus akan berada di urutan akhir.
        $robotikCourses = collect();
        $courses = collect();
        if ($category) {
            $mapping = [
                'THUMBNAIL E COURSE ATHUTO.svg' => 1, // Robot Arthuro (Level 1)
                'THUMBNAIL E COURSE ROBOFAN.svg' => 2, // Robot Robofan (Level 2)
                'THUMBNAIL E COURSE ROBODUST.svg' => 3, // Robot Robodust (Level 3)
                'THUMBNAIL E COURSE HEMIPTERA.svg' => 4, // Robot Hemiptera (Level 4)
                'THUMBNAIL E COURSE AVOIDER.svg' => 5, // Robot Avoider (Level 5)
            ];

            // Build a CASE expression to order by mapping
            $caseSql = "CASE ";
            foreach ($mapping as $file => $pos) {
                // escape single quotes
                $fileEsc = str_replace("'", "\\'", $file);
                $caseSql .= "WHEN image_url = '" . $fileEsc . "' THEN " . intval($pos) . " ";
            }
            $caseSql .= "ELSE 999 END";

            $robotikCourses = Ecourse::active()
                ->where('id_category', $category->id_category)
                ->orderByRaw($caseSql)
                ->orderBy('id_course', 'asc')
                ->get();
            $courses = $robotikCourses; // Also provide as 'courses' for generic views
        }

        return view('ecourse.ecourse-robotik', compact('robotikCourses', 'courses'));
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

        $courses = $komikCourses; // Also provide as 'courses' for generic views

        return view('ecourse.ecourse-komik', compact('komikCourses', 'courses'));
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

        $courses = $filmCourses; // Also provide as 'courses' for generic views

        return view('ecourse.ecourse-film-konten-kreator', compact('filmCourses', 'courses'));
    }

    /**
     * Handle dynamic category views (auto-generated)
     */
    public function category($slug)
    {
        // Try to find category - start from slug variations
        $category = null;
        
        // Get all categories and find best match
        $allCategories = Category::all();
        
        foreach ($allCategories as $cat) {
            $catSlug = Str::slug($cat->name); // Slugify the actual category name
            if ($catSlug === $slug) {
                $category = $cat;
                break;
            }
        }

        if (!$category) {
            abort(404, 'Kategori tidak ditemukan: ' . $slug);
        }

        // Get courses for this category
        $courses = Ecourse::active()
            ->where('id_category', $category->id_category)
            ->orderBy('price', 'asc')
            ->get();

        // Try to load the auto-generated view
        $viewPath = 'ecourse.ecourse-' . $slug;
        if (view()->exists($viewPath)) {
            return view($viewPath, compact('courses'));
        }

        // If view doesn't exist, generate it
        \App\Services\EcourseCategoryViewService::generateCategoryView(
            $category->name,
            $category->id_category
        );

        // Return the generated view
        return view($viewPath, compact('courses'));
    }

    public function show($id)
    {
        /**
         * Show detail course - bisa diakses oleh semua orang (login atau tidak)
         * Konten kursus (materi, video) akan di-restrict di view jika user tidak memiliki akses
         */
        $course = Ecourse::findOrFail($id);

        // Cek apakah user login dan memiliki akses
        $enrollment = null;
        $isAdmin = false;
        
        if (auth()->check()) {
            $user = auth()->user();
            
            // Check if user is admin
            if ((isset($user->role) && in_array($user->role, ['admin', 'super_admin'])) || 
                (isset($user->is_admin) && $user->is_admin == 1)) {
                $isAdmin = true;
            }
            
            // Check enrollment jika bukan admin
            if (!$isAdmin) {
                $enrollment = EcourseEnrollment::where('user_id', $user->id)
                    ->where('id_course', $id)
                    ->where('is_locked', false)
                    ->first();
            }
        }

        return view('ecourse.show', compact('course', 'enrollment', 'isAdmin'));
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

        $message = 'Course berhasil ditambahkan ke keranjang. <a href="' . route('cart.index') . '">Lihat Keranjang</a>';
        return redirect()->back()->with('success', $message);
    }
}
