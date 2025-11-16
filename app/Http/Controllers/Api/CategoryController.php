<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'Categories retrieved successfully');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $category = Category::create($validated);
        return $this->sendResponse($category, 'Category created successfully', 201);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return $this->sendError('Category not found', 404);
        }

        return $this->sendResponse($category, 'Category retrieved successfully');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return $this->sendError('Category not found', 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $category->update($validated);
        return $this->sendResponse($category, 'Category updated successfully');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return $this->sendError('Category not found', 404);
        }

        $category->delete();
        return $this->sendResponse(null, 'Category deleted successfully');
    }
}