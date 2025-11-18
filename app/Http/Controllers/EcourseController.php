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

        // Ambil courses robotik
        $robotikCourses = $category
            ? Ecourse::active()->where('id_category', $category->id_category)->orderBy('price', 'asc')->get()
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
}
