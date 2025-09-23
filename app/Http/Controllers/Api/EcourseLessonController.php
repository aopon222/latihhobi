<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcourseLesson;
use App\Models\Ecourse;
use App\Models\EcourseProgress;
use Illuminate\Support\Facades\Validator;
use App\Services\NotificationService;

class EcourseLessonController extends ApiBaseController
{
    protected $notificationService;
    
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * Get all lessons for an ecourse
     */
    public function index($ecourseId)
    {
        try {
            $ecourse = Ecourse::active()->findOrFail($ecourseId);
            
            $lessons = EcourseLesson::where('ecourse_id', $ecourseId)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            return $this->success($lessons, 'Lessons retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve lessons', $e->getMessage(), 404);
        }
    }

    /**
     * Get a specific lesson
     */
    public function show($id)
    {
        try {
            $lesson = EcourseLesson::where('is_active', true)
                ->with('ecourse')
                ->findOrFail($id);

            return $this->success($lesson, 'Lesson retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Lesson not found', $e->getMessage(), 404);
        }
    }

    /**
     * Get lesson content for enrolled users
     */
    public function getContent(Request $request, $lessonId)
    {
        try {
            $user = $request->user();
            
            $lesson = EcourseLesson::where('is_active', true)
                ->findOrFail($lessonId);
            
            // Check if user is enrolled in the ecourse
            $enrollment = $user->ecourseEnrollments()
                ->where('ecourse_id', $lesson->ecourse_id)
                ->where('status', 'active')
                ->first();
            
            if (!$enrollment && !$lesson->is_free) {
                return $this->error('You must be enrolled in this course to access this lesson', null, 403);
            }
            
            // Mark lesson as started if not already tracked
            $progress = EcourseProgress::firstOrCreate([
                'user_id' => $user->id,
                'ecourse_id' => $lesson->ecourse_id,
                'lesson_id' => $lesson->id
            ], [
                'started_at' => now()
            ]);
            
            return $this->success([
                'lesson' => $lesson,
                'progress' => $progress
            ], 'Lesson content retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve lesson content', $e->getMessage(), 500);
        }
    }

    /**
     * Mark lesson as completed
     */
    public function markAsCompleted(Request $request, $lessonId)
    {
        try {
            $user = $request->user();
            
            $lesson = EcourseLesson::findOrFail($lessonId);
            
            // Check if user is enrolled in the ecourse
            $enrollment = $user->ecourseEnrollments()
                ->where('ecourse_id', $lesson->ecourse_id)
                ->where('status', 'active')
                ->first();
            
            if (!$enrollment) {
                return $this->error('You must be enrolled in this course to mark lessons as completed', null, 403);
            }
            
            // Mark lesson as completed
            $progress = EcourseProgress::updateOrCreate([
                'user_id' => $user->id,
                'ecourse_id' => $lesson->ecourse_id,
                'lesson_id' => $lesson->id
            ], [
                'completed_at' => now(),
                'is_completed' => true
            ]);
            
            // Send lesson completion notification
            $this->notificationService->sendLessonCompletion($user, $lesson, $lesson->ecourse);

            return $this->success($progress, 'Lesson marked as completed successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to mark lesson as completed', $e->getMessage(), 500);
        }
    }
}