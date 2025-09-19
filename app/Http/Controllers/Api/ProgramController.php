<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Category;

class ProgramController extends Controller
{
    /**
     * Get all programs
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $type = $request->get('type');
        $categoryId = $request->get('category_id');
        $search = $request->get('search');

        $programs = Program::active()
            ->with('categories')
            ->when($type, function ($query) use ($type) {
                return $query->byType($type);
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->ordered()
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $programs
        ]);
    }

    /**
     * Get a specific program
     */
    public function show($id)
    {
        $program = Program::active()
            ->with('categories')
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $program
        ]);
    }

    /**
     * Get programs by category
     */
    public function byCategory($categoryId)
    {
        $category = Category::active()->findOrFail($categoryId);

        $programs = Program::active()
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })
            ->with('categories')
            ->ordered()
            ->paginate(12);

        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category,
                'programs' => $programs
            ]
        ]);
    }

    /**
     * Search programs
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        if (!$search) {
            return response()->json([
                'status' => 'success',
                'data' => []
            ]);
        }

        $programs = Program::active()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->with('categories')
            ->ordered()
            ->paginate(12);

        return response()->json([
            'status' => 'success',
            'data' => $programs
        ]);
    }
}