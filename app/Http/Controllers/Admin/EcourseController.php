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
use Illuminate\Support\Facades\Schema;

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
        $dbError = false;
        $query = null;

        try {
            $query = Ecourse::query();
        } catch (\Throwable $e) {
            $dbError = true;
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('id_category', $request->category);
        }

        // Filter berdasarkan level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            // Note: is_active column tidak ada di tabel course, skip filter ini untuk sekarang
            // $query->where('is_active', $request->status === 'active');
        }

        // Search berdasarkan name (table `course` uses `name`)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if (! $dbError) {
            try {
                $ecourses = $query->orderBy('created_at', 'desc')->paginate(10);
            } catch (\Throwable $e) {
                $ecourses = collect();
                $dbError = true;
            }
        } else {
            $ecourses = collect();
        }

        // Define canonical categories mapping (stored DB value => display label)
        // Load categories from DB (id => name)
        $categories = \Illuminate\Support\Facades\DB::table('category')
            ->orderBy('name')
            ->pluck('name', 'id_category')
            ->toArray();

        // Levels: use static list (table does not have `level` column)
        $levels = [
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced',
        ];

        return view('admin.ecourses.index', compact('ecourses', 'categories', 'levels', 'dbError'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Load categories from DB (id => name)
        $categories = \Illuminate\Support\Facades\DB::table('category')
            ->orderBy('name')
            ->pluck('name', 'id_category')
            ->toArray();

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

        // Handle new category creation
        $categoryId = $validated['id_category'] ?? $request->input('id_category');
        if ($request->filled('new_category_name')) {
            $categoryName = $request->input('new_category_name');
            // Create new category
            $category = \App\Models\Category::create([
                'name' => $categoryName,
            ]);
            $categoryId = $category->id_category;
            
            // Auto-generate view file for the new category
            \App\Services\EcourseCategoryViewService::generateCategoryView($categoryName, $categoryId);
        }

        // Map form fields to DB columns
        $data = [
            'id_category' => $categoryId,
            'name' => $validated['name'] ?? $request->input('name'),
            'course_by' => $validated['course_by'] ?? $request->input('course_by'),
            'price' => $validated['price'] ?? $request->input('price'),
            'original_price' => $validated['original_price'] ?? $request->input('original_price'),
            'level' => $validated['level'] ?? $request->input('level'),
        ];

        // Handle uploaded image file if present and set image_url
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('public/course_images');
            $rel = str_replace('public/', '', $path);
            $data['image_url'] = $rel;
        }

        $ecourse = Ecourse::create($data);

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ecourse $ecourse)
    {
        // Only eager-load relations that have corresponding tables to avoid QueryException
        $relations = ['enrollments'];
        try {
            if (Schema::hasTable('course_content') || Schema::hasTable('ecourse_lessons')) {
                $relations[] = 'lessons';
            }
        } catch (\Throwable $e) {
            // If checking schema fails, skip eager-loading lessons
        }

        try {
            $ecourse->load($relations);
        } catch (\Throwable $e) {
            // swallow exceptions to keep admin page working; view has further fallbacks
        }

        // Flags to indicate whether underlying tables exist (used by view to show helpful notices)
        try {
            $lessonsTableExists = Schema::hasTable('course_content') || Schema::hasTable('ecourse_lessons');
        } catch (\Throwable $e) {
            $lessonsTableExists = false;
        }

        try {
            $enrollmentsTableExists = Schema::hasTable('ecourse_enrollments');
        } catch (\Throwable $e) {
            $enrollmentsTableExists = false;
        }

        return view('admin.ecourses.show', compact('ecourse', 'lessonsTableExists', 'enrollmentsTableExists'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ecourse $ecourse)
    {
        // Load categories from DB (id => name)
        $categories = \Illuminate\Support\Facades\DB::table('category')
            ->orderBy('name')
            ->pluck('name', 'id_category')
            ->toArray();

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

        // Handle new category creation
        $categoryId = $validated['id_category'] ?? $request->input('id_category');
        if ($request->filled('new_category_name')) {
            $categoryName = $request->input('new_category_name');
            // Create new category
            $category = \App\Models\Category::create([
                'name' => $categoryName,
            ]);
            $categoryId = $category->id_category;
            
            // Auto-generate view file for the new category
            \App\Services\EcourseCategoryViewService::generateCategoryView($categoryName, $categoryId);
        }

        $data = [
            'id_category' => $categoryId,
            'name' => $validated['name'] ?? $request->input('name'),
            'course_by' => $validated['course_by'] ?? $request->input('course_by'),
            'price' => $validated['price'] ?? $request->input('price'),
            'original_price' => $validated['original_price'] ?? $request->input('original_price'),
            'level' => $validated['level'] ?? $request->input('level'),
        ];

        // Capture attributes before update for diff display
        $before = $ecourse->getAttributes();

        // Handle uploaded image if provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('public/course_images');
            $rel = str_replace('public/', '', $path);
            $data['image_url'] = $rel;
        }

        // Merge validated additional fields that may exist
        $updatePayload = array_merge($validated, $data);

        $ecourse->update($updatePayload);

        // Refresh and capture after state
        $ecourse->refresh();
        $after = $ecourse->getAttributes();

        // Store diff in session flash so view can present before/after
        session()->flash('ecourse_update_diff', [
            'before' => $before,
            'after' => $after,
            'id' => $ecourse->id
        ]);

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecourse $ecourse)
    {
        $deletedName = $ecourse->name;
        $ecourse->delete();

        // Jika yang dihapus adalah Robotik Level 1, jalankan seeder untuk menambahkannya kembali
        try {
            if (stripos($deletedName, 'robotik level 1') !== false) {
                // Run seeder to re-create Robotik Level 1 if missing
                (new \Database\Seeders\RobotikCourseSeeder())->run();
            }
        } catch (\Throwable $e) {
            // swallow errors but log if possible
        }

        return redirect()->route('admin.ecourses.index')
            ->with('success', 'E-course berhasil dihapus!');
    }
}