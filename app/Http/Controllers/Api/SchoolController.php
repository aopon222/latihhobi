<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    /**
     * Get all schools
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $type = $request->get('type');
        $search = $request->get('search');

        $schools = School::where('status', 'active')
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $schools
        ]);
    }

    /**
     * Get a specific school
     */
    public function show($id)
    {
        $school = School::where('status', 'active')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $school
        ]);
    }
}