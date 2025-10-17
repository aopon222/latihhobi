<?php

namespace App\Http\Controllers;

use App\Models\Ecourse;
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
}
