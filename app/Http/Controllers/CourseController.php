<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(Request $request)
    {
        $query = Course::where('is_active', true);

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by price or rating
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $courses = $query->paginate(12);
        
        // Get unique categories for filter
        $categories = Course::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('courses.index', compact('courses', 'categories'));
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {
        // Check if course is active
        if (!$course->is_active) {
            abort(404);
        }

        // Get related courses (same category, excluding current course)
        $relatedCourses = Course::where('category', $course->category)
            ->where('id', '!=', $course->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        // Check if user already has this course in cart
        $inCart = false;
        if (Auth::check()) {
            $inCart = Cart::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        return view('courses.show', compact('course', 'relatedCourses', 'inCart'));
    }

    /**
     * Get courses by category (AJAX)
     */
    public function getByCategory(Request $request)
    {
        $category = $request->get('category');
        
        $courses = Course::where('is_active', true)
            ->when($category, function($query) use ($category) {
                return $query->where('category', $category);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'courses' => $courses->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'category' => $course->category,
                    'price' => $course->price,
                    'formatted_price' => $course->formatted_price,
                    'rating' => $course->rating,
                    'total_reviews' => $course->total_reviews,
                    'image' => $course->image,
                    'url' => route('courses.show', $course->id)
                ];
            })
        ]);
    }

    /**
     * Search courses (AJAX)
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Query terlalu pendek'
            ]);
        }

        $courses = Course::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('category', 'like', '%' . $query . '%');
            })
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'courses' => $courses->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'category' => $course->category,
                    'formatted_price' => $course->formatted_price,
                    'rating' => $course->rating,
                    'image' => $course->image,
                    'url' => route('courses.show', $course->id)
                ];
            })
        ]);
    }

    /**
     * Get featured courses for homepage
     */
    public function featured()
    {
        $featuredCourses = Course::where('is_active', true)
            ->where('rating', '>=', 4.5)
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        return view('welcome', compact('featuredCourses'));
    }

    /**
     * Get course statistics
     */
    public function getStats()
    {
        $stats = [
            'total_courses' => Course::where('is_active', true)->count(),
            'categories' => Course::where('is_active', true)->distinct()->count('category'),
            'average_rating' => Course::where('is_active', true)->avg('rating'),
            'total_reviews' => Course::where('is_active', true)->sum('total_reviews')
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Check if course is in user's cart
     */
    public function checkInCart(Course $course)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'in_cart' => false,
                'message' => 'User not authenticated'
            ]);
        }

        $inCart = Cart::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        return response()->json([
            'success' => true,
            'in_cart' => $inCart
        ]);
    }

    /**
     * Get popular courses
     */
    public function popular()
    {
        $popularCourses = Course::where('is_active', true)
            ->orderBy('total_reviews', 'desc')
            ->orderBy('rating', 'desc')
            ->limit(8)
            ->get();

        return response()->json([
            'success' => true,
            'courses' => $popularCourses
        ]);
    }

    /**
     * Get courses by price range
     */
    public function getByPriceRange(Request $request)
    {
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 1000000);

        $courses = Course::where('is_active', true)
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->orderBy('price', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'courses' => $courses
        ]);
    }
}
