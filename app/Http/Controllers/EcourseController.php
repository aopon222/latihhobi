<?php

namespace App\Http\Controllers;

use App\Models\Ecourse;
use Illuminate\Http\Request;

class EcourseController extends Controller
{
    /**
     * Display e-course listing page
     */
    public function index()
    {
        $ecourses = Ecourse::active()->get();
        return view('ecourse', compact('ecourses'));
    }

    /**
     * Display robotik e-course page
     */
    public function robotik()
    {
        $robotikCourses = Ecourse::active()
            ->where('category', 'Robotics')
            ->orderBy('level', 'asc')
            ->get();
        
        return view('ecourse-robotik', compact('robotikCourses'));
    }

    /**
     * Display specific e-course details
     */
    public function show($slug)
    {
        $ecourse = Ecourse::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        return view('ecourse-detail', compact('ecourse'));
    }

    /**
     * Display e-courses by category
     */
    public function category($category)
    {
        $ecourses = Ecourse::active()
            ->where('category', $category)
            ->get();
        
        return view('ecourse-category', compact('ecourses', 'category'));
    }
}
