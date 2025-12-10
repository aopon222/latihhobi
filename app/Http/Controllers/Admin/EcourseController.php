<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEcourseRequest;
use App\Http\Requests\UpdateEcourseRequest;
use App\Models\Ecourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EcourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->email !== 'multimedia.latihhobi@gmail.com') {
                return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki izin admin.');
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ecourse::query();

        // Filter berdasarkan kategori - TODO: Fix - category is not a direct column, need id_category
        // if ($request->filled('category')) {
        //     // Support combined 'Film & Konten Kreator' filter (maps to two DB categories)
        //     if ($request->category === 'film_and_konten') {
        //         $query->whereIn('category', ['Film', 'Content Creation']);
        //     } else {
        //         $query->where('category', $request->category);
        //     }
        // }

        // Filter berdasarkan level - TODO: Fix - level is not in course table
        // if ($request->filled('level')) {
        //     $query->where('level', $request->level);
        // }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            // Note: is_active column tidak ada di tabel course, skip filter ini untuk sekarang
            // $query->where('is_active', $request->status === 'active');
        }

        // Search berdasarkan name (table `course` uses `name`)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $ecourses = $query->orderBy('created_at', 'desc')->paginate(10);

        // Define canonical categories mapping (stored DB value => display label)
        $categories = [
            // combined option (non-destructive filtering)
            'film_and_konten' => 'Film & Konten Kreator',
            'Robotics' => 'Robotik',
            'Film' => 'Film',
            'Content Creation' => 'Konten Kreator',
            'Programming' => 'Programming',
            'Design' => 'Design',
            'Marketing' => 'Marketing',
            'Business' => 'Business',
            'Photography' => 'Photography',
            'Music' => 'Music',
        ];

        // Levels: use static list (table does not have `level` column)
        $levels = [
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced',
        ];

        return view('admin.ecourses.index', compact('ecourses', 'categories', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'Programming' => 'Programming',
            'Design' => 'Design', 
            'Marketing' => 'Marketing',
            'Business' => 'Business',
            'Photography' => 'Photography',
            'Music' => 'Music',
            // Stored DB value => Display label (Indonesian)
            'Robotics' => 'Robotik',
            'Film' => 'Film',
            'Content Creation' => 'Konten Kreator'
        ];

        $levels = [
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced'
        ];

        return view('admin.ecourses.create', compact('categories', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEcourseRequest $request)
    {
        $validated = $request->validated();

        Ecourse::create($validated);

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ecourse $ecourse)
    {
        $ecourse->load(['lessons', 'enrollments']);
        return view('admin.ecourses.show', compact('ecourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ecourse $ecourse)
    {
        $categories = [
            'Programming' => 'Programming',
            'Design' => 'Design', 
            'Marketing' => 'Marketing',
            'Business' => 'Business',
            'Photography' => 'Photography',
            'Music' => 'Music',
            // Stored DB value => Display label (Indonesian)
            'Robotics' => 'Robotik',
            'Film' => 'Film',
            'Content Creation' => 'Konten Kreator'
        ];

        $levels = [
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced'
        ];

        return view('admin.ecourses.edit', compact('ecourse', 'categories', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEcourseRequest $request, Ecourse $ecourse)
    {
        $validated = $request->validated();

        $ecourse->update($validated);

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecourse $ecourse)
    {
        $ecourse->delete();

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil dihapus!');
    }
}