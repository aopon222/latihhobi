<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecourse;
use App\Models\EcourseEnrollment;
use Illuminate\Support\Facades\Validator;

class EcourseController extends ApiBaseController
{
    /**
     * Get all ecourses
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $category = $request->get('category');
            $level = $request->get('level');
            $search = $request->get('search');
            $featured = $request->get('featured');

            $ecourses = Ecourse::active()
                ->when($category, function ($query) use ($category) {
                    return $query->byCategory($category);
                })
                ->when($level, function ($query) use ($level) {
                    return $query->byLevel($level);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->when($featured, function ($query) use ($featured) {
                    return $query->featured();
                })
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return $this->success($ecourses, 'E-courses retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve e-courses', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific ecourse
     */
    public function show($id)
    {
        try {
            $ecourse = Ecourse::active()
                ->with('lessons')
                ->findOrFail($id);

            return $this->success($ecourse, 'E-course retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('E-course not found', $e->getMessage(), 404);
        }
    }

    /**
     * Get featured ecourses
     */
    public function featured()
    {
        try {
            $ecourses = Ecourse::active()
                ->featured()
                ->with('lessons')
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();

            return $this->success($ecourses, 'Featured e-courses retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve featured e-courses', $e->getMessage(), 500);
        }
    }

    /**
     * Get e-courses by category
     */
    public function byCategory($category)
    {
        try {
            $ecourses = Ecourse::active()
                ->byCategory($category)
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success([
                'category' => $category,
                'ecourses' => $ecourses
            ], 'E-courses by category retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve e-courses by category', $e->getMessage(), 500);
        }
    }

    /**
     * Search e-courses
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('q');

            if (!$search) {
                return $this->success([], 'No search term provided');
            }

            $ecourses = Ecourse::active()
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($ecourses, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to search e-courses', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's enrolled e-courses
     */
    public function myEcourses(Request $request)
    {
        try {
            $user = $request->user();
            $enrollments = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse')
                ->orderBy('created_at', 'desc')
                ->get();

            return $this->success($enrollments, 'My e-courses retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my e-courses', $e->getMessage(), 500);
        }
    }
}