<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Validator;

class SchoolController extends ApiBaseController
{
    /**
     * Get all schools
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $search = $request->get('search');
            $city = $request->get('city');

            $schools = School::where('is_active', true)
                ->when($search, function ($query) use ($search) {
                    return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                })
                ->when($city, function ($query) use ($city) {
                    return $query->where('city', $city);
                })
                ->orderBy('name')
                ->paginate($perPage);

            return $this->success($schools, 'Schools retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve schools', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific school
     */
    public function show($id)
    {
        try {
            $school = School::where('is_active', true)
                ->findOrFail($id);

            return $this->success($school, 'School retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('School not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve school', $e->getMessage(), 500);
        }
    }

    /**
     * Search schools
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('q');

            if (!$search) {
                return $this->success([], 'No search term provided');
            }

            $schools = School::where('is_active', true)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orderBy('name')
                ->paginate(12);

            return $this->success($schools, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to search schools', $e->getMessage(), 500);
        }
    }

    /**
     * Get schools by city
     */
    public function byCity($city)
    {
        try {
            $schools = School::where('is_active', true)
                ->where('city', $city)
                ->orderBy('name')
                ->paginate(12);

            return $this->success([
                'city' => $city,
                'schools' => $schools
            ], 'Schools by city retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve schools by city', $e->getMessage(), 500);
        }
    }

    /**
     * Register interest in partnership
     */
    public function registerInterest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'school_name' => 'required|string|max:255',
                'contact_person' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'city' => 'required|string|max:100',
                'message' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // In a real implementation, you would save this to a partnership interest table
            // and send notifications to the admin team
            
            // For now, we'll just return a success response
            return $this->success(null, 'Partnership interest registered successfully. We will contact you soon.');
        } catch (\Exception $e) {
            return $this->error('Failed to register partnership interest', $e->getMessage(), 500);
        }
    }
}