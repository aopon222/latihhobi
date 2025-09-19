<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Get all categories
     */
    public function index()
    {
        try {
            $categories = Category::active()
                ->featured()
                ->ordered()
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve categories',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific category
     */
    public function show($id)
    {
        try {
            $category = Category::active()->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $category
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve category',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}