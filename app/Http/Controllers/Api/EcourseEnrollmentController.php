<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcourseEnrollment;
use App\Models\Ecourse;
use Illuminate\Support\Facades\Validator;
use App\Services\NotificationService;

class EcourseEnrollmentController extends ApiBaseController
{
    protected $notificationService;
    
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * Get all enrollments for the authenticated user
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            $enrollments = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($enrollments, 'Enrollments retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve enrollments', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific enrollment
     */
    public function show(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $enrollment = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse')
                ->findOrFail($id);

            return $this->success($enrollment, 'Enrollment retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Enrollment not found', $e->getMessage(), 404);
        }
    }

    /**
     * Create a new enrollment
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'ecourse_id' => 'required|exists:ecourses,id',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $ecourse = Ecourse::active()->findOrFail($request->ecourse_id);
            
            // Check if user is already enrolled
            $existingEnrollment = EcourseEnrollment::where('user_id', $user->id)
                ->where('ecourse_id', $ecourse->id)
                ->whereIn('status', ['active', 'completed'])
                ->first();
                
            if ($existingEnrollment) {
                return $this->error('You are already enrolled in this course');
            }
            
            // Check if ecourse is free
            $price = $ecourse->discount_price ?? $ecourse->price;
            
            $enrollment = EcourseEnrollment::create([
                'user_id' => $user->id,
                'ecourse_id' => $ecourse->id,
                'price' => $price,
                'status' => $price == 0 ? 'active' : 'pending_payment',
                'enrolled_at' => now(),
            ]);
            
            // Send notification for enrollment
            if ($price == 0) {
                $this->notificationService->sendCourseEnrollment($user, $enrollment);
            }

            return $this->success($enrollment, 'Enrollment created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create enrollment', $e->getMessage(), 500);
        }
    }

    /**
     * Cancel an enrollment
     */
    public function cancel(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $enrollment = EcourseEnrollment::where('user_id', $user->id)
                ->findOrFail($id);
                
            if ($enrollment->status !== 'active') {
                return $this->error('Only active enrollments can be cancelled');
            }
            
            $enrollment->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            return $this->success($enrollment, 'Enrollment cancelled successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to cancel enrollment', $e->getMessage(), 500);
        }
    }

    /**
     * Get enrollment progress
     */
    public function progress(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $enrollment = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse.lessons')
                ->findOrFail($id);
                
            $totalLessons = $enrollment->ecourse->lessons->count();
            
            if ($totalLessons == 0) {
                return $this->success([
                    'enrollment' => $enrollment,
                    'progress' => 0,
                    'completed_lessons' => 0,
                    'total_lessons' => 0
                ], 'Progress retrieved successfully');
            }
            
            $completedLessons = $enrollment->ecourse->lessons()
                ->whereHas('progress', function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->where('is_completed', true);
                })
                ->count();
                
            $progress = ($completedLessons / $totalLessons) * 100;

            return $this->success([
                'enrollment' => $enrollment,
                'progress' => round($progress, 2),
                'completed_lessons' => $completedLessons,
                'total_lessons' => $totalLessons
            ], 'Progress retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve progress', $e->getMessage(), 500);
        }
    }
}