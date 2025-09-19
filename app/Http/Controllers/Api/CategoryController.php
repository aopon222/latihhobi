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
        $categories = Category::active()
            ->featured()
            ->ordered()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Get a specific category
     */
    public function show($id)
    {
        $category = Category::active()->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }
}