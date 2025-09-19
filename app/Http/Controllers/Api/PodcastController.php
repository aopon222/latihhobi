<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Validator;

class PodcastController extends ApiBaseController
{
    /**
     * Get all podcasts
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $search = $request->get('search');
            $featured = $request->get('featured');

            $podcasts = Podcast::where('is_active', true)
                ->when($search, function ($query) use ($search) {
                    return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->when($featured, function ($query) use ($featured) {
                    return $query->where('is_featured', $featured);
                })
                ->orderBy('published_at', 'desc')
                ->paginate($perPage);

            return $this->success($podcasts, 'Podcasts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve podcasts', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific podcast
     */
    public function show($id)
    {
        try {
            $podcast = Podcast::where('is_active', true)
                ->findOrFail($id);

            return $this->success($podcast, 'Podcast retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Podcast not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve podcast', $e->getMessage(), 500);
        }
    }

    /**
     * Get featured podcasts
     */
    public function featured()
    {
        try {
            $podcasts = Podcast::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('published_at', 'desc')
                ->limit(6)
                ->get();

            return $this->success($podcasts, 'Featured podcasts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve featured podcasts', $e->getMessage(), 500);
        }
    }

    /**
     * Get recent podcasts
     */
    public function recent()
    {
        try {
            $podcasts = Podcast::where('is_active', true)
                ->orderBy('published_at', 'desc')
                ->limit(10)
                ->get();

            return $this->success($podcasts, 'Recent podcasts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve recent podcasts', $e->getMessage(), 500);
        }
    }

    /**
     * Search podcasts
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('q');

            if (!$search) {
                return $this->success([], 'No search term provided');
            }

            $podcasts = Podcast::where('is_active', true)
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderBy('published_at', 'desc')
                ->paginate(12);

            return $this->success($podcasts, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to search podcasts', $e->getMessage(), 500);
        }
    }

    /**
     * Get podcasts by category
     */
    public function byCategory($category)
    {
        try {
            $podcasts = Podcast::where('is_active', true)
                ->where('category', $category)
                ->orderBy('published_at', 'desc')
                ->paginate(12);

            return $this->success([
                'category' => $category,
                'podcasts' => $podcasts
            ], 'Podcasts by category retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve podcasts by category', $e->getMessage(), 500);
        }
    }
}