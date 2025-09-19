<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcourseEnrollment;
use App\Models\Post;
use App\Models\CommunityMember;
use App\Models\Payment;
use App\Models\Event;

class DashboardController extends ApiBaseController
{
    /**
     * Get dashboard statistics
     */
    public function stats(Request $request)
    {
        try {
            $user = $request->user();
            
            // Get user's e-course enrollments
            $ecourseEnrollments = EcourseEnrollment::where('user_id', $user->id)
                ->count();
                
            // Get user's community memberships
            $communityMemberships = CommunityMember::where('user_id', $user->id)
                ->where('status', 'active')
                ->count();
                
            // Get user's posts
            $posts = Post::where('user_id', $user->id)
                ->where('is_active', true)
                ->count();
                
            // Get user's payments
            $payments = Payment::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count();

            return $this->success([
                'ecourse_enrollments' => $ecourseEnrollments,
                'community_memberships' => $communityMemberships,
                'posts' => $posts,
                'payments' => $payments,
            ], 'Dashboard statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve dashboard statistics', $e->getMessage(), 500);
        }
    }

    /**
     * Get upcoming classes/events
     */
    public function upcomingClasses(Request $request)
    {
        try {
            $user = $request->user();
            
            // Get user's event registrations
            $eventRegistrations = $user->eventRegistrations()
                ->where('status', 'confirmed')
                ->with('event')
                ->whereHas('event', function ($query) {
                    $query->where('start_date', '>', now())
                        ->where('status', 'open');
                })
                ->orderBy('event.start_date')
                ->limit(5)
                ->get();
                
            // Get user's e-course enrollments with progress
            $ecourseEnrollments = EcourseEnrollment::where('user_id', $user->id)
                ->where('status', 'active')
                ->with('ecourse')
                ->limit(5)
                ->get();

            return $this->success([
                'upcoming_events' => $eventRegistrations,
                'active_ecourses' => $ecourseEnrollments,
            ], 'Upcoming classes retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve upcoming classes', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's e-course enrollments
     */
    public function myEcourses(Request $request)
    {
        try {
            $user = $request->user();
            
            $enrollments = EcourseEnrollment::where('user_id', $user->id)
                ->with('ecourse')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($enrollments, 'My e-courses retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my e-courses', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's community posts
     */
    public function myPosts(Request $request)
    {
        try {
            $user = $request->user();
            
            $posts = Post::where('user_id', $user->id)
                ->where('is_active', true)
                ->with(['community'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($posts, 'My posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my posts', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's community memberships
     */
    public function myCommunities(Request $request)
    {
        try {
            $user = $request->user();
            
            $memberships = CommunityMember::where('user_id', $user->id)
                ->where('status', 'active')
                ->with(['community'])
                ->orderBy('joined_at', 'desc')
                ->paginate(12);

            return $this->success($memberships, 'My communities retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my communities', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's payments
     */
    public function myPayments(Request $request)
    {
        try {
            $user = $request->user();
            
            $payments = Payment::where('user_id', $user->id)
                ->with(['ecourseEnrollment.ecourse', 'event'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($payments, 'My payments retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my payments', $e->getMessage(), 500);
        }
    }
}