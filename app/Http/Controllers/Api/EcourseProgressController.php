<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcourseProgress;
use App\Models\EcourseEnrollment;
use App\Services\NotificationService;

class EcourseProgressController extends ApiBaseController
{
    protected $notificationService;
    
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * Get progress for all enrolled ecourses
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            $enrollments = EcourseEnrollment::where('user_id', $user->id)
                ->with(['ecourse', 'ecourse.lessons'])
                ->where('status', 'active')
                ->get();
                
            $progressData = [];
            
            foreach ($enrollments as $enrollment) {
                $totalLessons = $enrollment->ecourse->lessons->count();
                
                if ($totalLessons > 0) {
                    $completedLessons = $enrollment->ecourse->lessons()
                        ->whereHas('progress', function ($query) use ($user) {
                            $query->where('user_id', $user->id)
                                ->where('is_completed', true);
                        })
                        ->count();
                        
                    $progress = ($completedLessons / $totalLessons) * 100;
                } else {
                    $progress = 0;
                    $completedLessons = 0;
                    $totalLessons = 0;
                }
                
                $progressData[] = [
                    'enrollment' => $enrollment,
                    'progress_percentage' => round($progress, 2),
                    'completed_lessons' => $completedLessons,
                    'total_lessons' => $totalLessons
                ];
            }

            return $this->success($progressData, 'Progress data retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve progress data', $e->getMessage(), 500);
        }
    }

    /**
     * Get detailed progress for a specific ecourse
     */
    public function show(Request $request, $enrollmentId)
    {
        try {
            $user = $request->user();
            
            $enrollment = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse.lessons')
                ->findOrFail($enrollmentId);
                
            $lessons = $enrollment->ecourse->lessons;
            $lessonProgress = [];
            
            foreach ($lessons as $lesson) {
                $progress = EcourseProgress::where('user_id', $user->id)
                    ->where('ecourse_id', $enrollment->ecourse_id)
                    ->where('lesson_id', $lesson->id)
                    ->first();
                    
                $lessonProgress[] = [
                    'lesson' => $lesson,
                    'progress' => $progress,
                    'is_completed' => $progress ? $progress->is_completed : false,
                    'started_at' => $progress ? $progress->started_at : null,
                    'completed_at' => $progress ? $progress->completed_at : null,
                ];
            }

            return $this->success([
                'enrollment' => $enrollment,
                'lessons' => $lessonProgress
            ], 'Detailed progress retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve detailed progress', $e->getMessage(), 500);
        }
    }

    /**
     * Reset progress for a lesson
     */
    public function resetLesson(Request $request, $lessonId)
    {
        try {
            $user = $request->user();
            
            $progress = EcourseProgress::where('user_id', $user->id)
                ->where('lesson_id', $lessonId)
                ->first();
                
            if ($progress) {
                $progress->update([
                    'is_completed' => false,
                    'started_at' => null,
                    'completed_at' => null,
                ]);
                
                return $this->success($progress, 'Lesson progress reset successfully');
            }
            
            return $this->success(null, 'No progress found for this lesson');
        } catch (\Exception $e) {
            return $this->error('Failed to reset lesson progress', $e->getMessage(), 500);
        }
    }
}