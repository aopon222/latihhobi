<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Post;
use App\Models\ClassModel;

class DashboardController extends ApiBaseController
{
    /**
     * Get dashboard statistics
     */
    public function stats(Request $request)
    {
        $user = $request->user();

        // Get user's enrollments count
        $enrollmentsCount = Enrollment::where('student_id', $user->id)
            ->count();

        // Get user's posts count
        $postsCount = Post::where('user_id', $user->id)
            ->count();

        // Get user's active enrollments
        $activeEnrollments = Enrollment::where('student_id', $user->id)
            ->whereIn('status', ['active', 'pending'])
            ->count();

        return $this->success([
            'enrollments_count' => $enrollmentsCount,
            'posts_count' => $postsCount,
            'active_enrollments' => $activeEnrollments
        ]);
    }

    /**
     * Get upcoming classes
     */
    public function upcomingClasses(Request $request)
    {
        $user = $request->user();

        $classes = ClassModel::whereHas('enrollments', function ($query) use ($user) {
                $query->where('student_id', $user->id)
                    ->whereIn('status', ['active', 'pending']);
            })
            ->where('start_date', '>=', now())
            ->with(['program', 'schedules'])
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        return $this->success($classes);
    }

    /**
     * Get user's enrollments
     */
    public function myEnrollments(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 5);

        $enrollments = Enrollment::where('student_id', $user->id)
            ->with(['classModel.program', 'classModel.tutor'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $this->success($enrollments);
    }

    /**
     * Get user's posts
     */
    public function myPosts(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 5);

        $posts = Post::where('user_id', $user->id)
            ->with(['community'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $this->success($posts);
    }
}