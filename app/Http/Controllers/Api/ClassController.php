<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Program;

class ClassController extends Controller
{
    /**
     * Get all classes
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $programId = $request->get('program_id');
        $type = $request->get('type');
        $status = $request->get('status');

        $classes = ClassModel::active()
            ->with(['program', 'tutor', 'schedules'])
            ->when($programId, function ($query) use ($programId) {
                return $query->where('program_id', $programId);
            })
            ->when($type, function ($query) use ($type) {
                return $query->byType($type);
            })
            ->when($status, function ($query) use ($status) {
                return $query->byStatus($status);
            })
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $classes
        ]);
    }

    /**
     * Get a specific class
     */
    public function show($id)
    {
        $class = ClassModel::with(['program', 'tutor', 'schedules', 'serviceArea'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $class
        ]);
    }

    /**
     * Get classes by program
     */
    public function byProgram($programId)
    {
        $program = Program::active()->findOrFail($programId);

        $classes = ClassModel::active()
            ->where('program_id', $programId)
            ->with(['program', 'tutor', 'schedules'])
            ->paginate(12);

        return response()->json([
            'status' => 'success',
            'data' => [
                'program' => $program,
                'classes' => $classes
            ]
        ]);
    }
}