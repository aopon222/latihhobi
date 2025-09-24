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

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Search berdasarkan title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $ecourses = $query->orderBy('created_at', 'desc')->paginate(10);

        // Ambil data untuk filter dropdown
        $categories = Ecourse::distinct()->pluck('category')->filter();
        $levels = Ecourse::distinct()->pluck('level')->filter();

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
            'Robotics' => 'Robotics',
            'Film' => 'Film',
            'Content Creation' => 'Content Creation'
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

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);
        
        // Pastikan slug unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Ecourse::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle file uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ecourses/images', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('ecourses/thumbnails', 'public');
        }

        // Convert string inputs to arrays
        if (!empty($validated['prerequisites'])) {
            $validated['prerequisites'] = array_map('trim', explode("\n", $validated['prerequisites']));
        }

        if (!empty($validated['learning_outcomes'])) {
            $validated['learning_outcomes'] = array_map('trim', explode("\n", $validated['learning_outcomes']));
        }

        if (!empty($validated['tools_needed'])) {
            $validated['tools_needed'] = array_map('trim', explode("\n", $validated['tools_needed']));
        }

        // Set default values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

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
            'Robotics' => 'Robotics',
            'Film' => 'Film',
            'Content Creation' => 'Content Creation'
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

        // Update slug jika title berubah
        if ($validated['title'] !== $ecourse->title) {
            $baseSlug = Str::slug($validated['title']);
            $validated['slug'] = $baseSlug;
            
            // Pastikan slug unique (kecuali untuk ecourse yang sedang diedit)
            $counter = 1;
            while (Ecourse::where('slug', $validated['slug'])->where('id', '!=', $ecourse->id)->exists()) {
                $validated['slug'] = $baseSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle file uploads
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($ecourse->image) {
                Storage::disk('public')->delete($ecourse->image);
            }
            $validated['image'] = $request->file('image')->store('ecourses/images', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($ecourse->thumbnail) {
                Storage::disk('public')->delete($ecourse->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('ecourses/thumbnails', 'public');
        }

        // Convert string inputs to arrays
        if (!empty($validated['prerequisites'])) {
            $validated['prerequisites'] = array_map('trim', explode("\n", $validated['prerequisites']));
        } else {
            $validated['prerequisites'] = null;
        }

        if (!empty($validated['learning_outcomes'])) {
            $validated['learning_outcomes'] = array_map('trim', explode("\n", $validated['learning_outcomes']));
        } else {
            $validated['learning_outcomes'] = null;
        }

        if (!empty($validated['tools_needed'])) {
            $validated['tools_needed'] = array_map('trim', explode("\n", $validated['tools_needed']));
        } else {
            $validated['tools_needed'] = null;
        }

        // Set boolean values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $ecourse->update($validated);

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecourse $ecourse)
    {
        // Hapus file gambar jika ada
        if ($ecourse->image) {
            Storage::disk('public')->delete($ecourse->image);
        }

        if ($ecourse->thumbnail) {
            Storage::disk('public')->delete($ecourse->thumbnail);
        }

        $ecourse->delete();

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil dihapus!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Ecourse $ecourse)
    {
        $ecourse->update(['is_featured' => !$ecourse->is_featured]);

        return response()->json([
            'success' => true,
            'message' => 'Status featured berhasil diubah!',
            'is_featured' => $ecourse->is_featured
        ]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Ecourse $ecourse)
    {
        $ecourse->update(['is_active' => !$ecourse->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status aktif berhasil diubah!',
            'is_active' => $ecourse->is_active
        ]);
    }
}