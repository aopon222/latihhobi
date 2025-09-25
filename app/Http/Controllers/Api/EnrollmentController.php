<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Enrollment;
use App\Models\ClassModel;
use App\Models\Payment;

class EnrollmentController extends Controller
{
    /**
     * Get user's enrollments
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 12);
        $status = $request->get('status');

        $enrollments = Enrollment::where('student_id', $user->id)
            ->with(['classModel.program', 'classModel.tutor'])
            ->when($status, function ($query) use ($status) {
                return $query->byStatus($status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $enrollments
        ]);
    }

    /**
     * Get a specific enrollment
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $enrollment = Enrollment::where('student_id', $user->id)
            ->with(['classModel.program', 'classModel.tutor', 'payments'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $enrollment
        ]);
    }

    /**
     * Create a new enrollment
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
            'parent_id' => 'nullable|exists:users,id',
            'emergency_contact' => 'nullable|array',
            'special_needs' => 'nullable|array',
            'parent_notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $class = ClassModel::active()->findOrFail($request->class_id);

        // Check if class is available
        if (!$class->isAvailable()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Class is not available for enrollment'
            ], 400);
        }

        // Check if user is already enrolled
        $existingEnrollment = Enrollment::where('student_id', $user->id)
            ->where('class_id', $class->id)
            ->whereIn('status', ['pending', 'active'])
            ->first();

        if ($existingEnrollment) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already enrolled in this class'
            ], 400);
        }

        // Create enrollment
        $enrollment = new Enrollment([
            'enrollment_number' => 'ENR-' . now()->format('Ymd') . '-' . strtoupper(uniqid()),
            'student_id' => $user->id,
            'class_id' => $class->id,
            'parent_id' => $request->parent_id,
            'original_price' => $class->price,
            'discount_amount' => 0,
            'final_price' => $class->price,
            'paid_amount' => 0,
            'payment_status' => 'pending',
            'status' => 'pending',
            'enrolled_at' => now(),
            'emergency_contact' => $request->emergency_contact,
            'special_needs' => $request->special_needs,
            'parent_notes' => $request->parent_notes,
        ]);

        $enrollment->save();

        // Update class student count
        $class->increment('current_students');

        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment created successfully',
            'data' => $enrollment->load(['classModel.program', 'classModel.tutor'])
        ], 201);
    }

    /**
     * Cancel an enrollment
     */
    public function cancel(Request $request, $id)
    {
        $user = $request->user();

        $enrollment = Enrollment::where('student_id', $user->id)
            ->findOrFail($id);

        // Check if enrollment can be cancelled
        if (!in_array($enrollment->status, ['pending', 'active'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Enrollment cannot be cancelled'
            ], 400);
        }

        // Update enrollment status
        $enrollment->status = 'cancelled';
        $enrollment->save();

        // Update class student count
        $class = $enrollment->classModel;
        if ($class && $class->current_students > 0) {
            $class->decrement('current_students');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment cancelled successfully',
            'data' => $enrollment
        ]);
    }
}