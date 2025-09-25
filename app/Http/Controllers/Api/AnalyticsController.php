<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ecourse;
use App\Models\EcourseEnrollment;
use App\Models\Event;
use App\Models\Post;
use App\Models\CommunityMember;
use Carbon\Carbon;

class AnalyticsController extends ApiBaseController
{
    /**
     * Get overall platform statistics
     */
    public function overview(Request $request)
    {
        try {
            // Get date range
            $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
            $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
            
            // Total users
            $totalUsers = User::count();
            
            // Total e-courses
            $totalEcourses = Ecourse::active()->count();
            
            // Total events
            $totalEvents = Event::where('is_active', true)->count();
            
            // Total enrollments
            $totalEnrollments = EcourseEnrollment::count();
            
            // Total community members
            $totalCommunityMembers = CommunityMember::where('status', 'active')->count();
            
            // Total posts
            $totalPosts = Post::where('is_active', true)->count();

            return $this->success([
                'total_users' => $totalUsers,
                'total_ecourses' => $totalEcourses,
                'total_events' => $totalEvents,
                'total_enrollments' => $totalEnrollments,
                'total_community_members' => $totalCommunityMembers,
                'total_posts' => $totalPosts,
            ], 'Platform overview statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve platform overview statistics', $e->getMessage(), 500);
        }
    }

    /**
     * Get user engagement statistics
     */
    public function userEngagement(Request $request)
    {
        try {
            // Get date range
            $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
            $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
            
            // New users
            $newUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();
            
            // Active users (users who logged in within the last 30 days)
            $activeUsers = User::where('login_terakhir', '>=', Carbon::now()->subDays(30))->count();
            
            // Users with enrollments
            $usersWithEnrollments = User::whereHas('ecourseEnrollments')->count();
            
            // Users with community memberships
            $usersWithCommunities = User::whereHas('communityMemberships', function ($query) {
                $query->where('status', 'active');
            })->count();

            return $this->success([
                'new_users' => $newUsers,
                'active_users' => $activeUsers,
                'users_with_enrollments' => $usersWithEnrollments,
                'users_with_communities' => $usersWithCommunities,
            ], 'User engagement statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve user engagement statistics', $e->getMessage(), 500);
        }
    }

    /**
     * Get content engagement statistics
     */
    public function contentEngagement(Request $request)
    {
        try {
            // Get date range
            $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
            $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
            
            // New e-courses
            $newEcourses = Ecourse::active()
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            
            // New events
            $newEvents = Event::where('is_active', true)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            
            // New enrollments
            $newEnrollments = EcourseEnrollment::whereBetween('created_at', [$startDate, $endDate])
                ->count();
            
            // New posts
            $newPosts = Post::where('is_active', true)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            return $this->success([
                'new_ecourses' => $newEcourses,
                'new_events' => $newEvents,
                'new_enrollments' => $newEnrollments,
                'new_posts' => $newPosts,
            ], 'Content engagement statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve content engagement statistics', $e->getMessage(), 500);
        }
    }

    /**
     * Get user activity over time
     */
    public function userActivity(Request $request)
    {
        try {
            // Get date range
            $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
            $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
            $interval = $request->get('interval', 'day'); // day, week, month
            
            $activityData = [];
            
            // Generate date range
            $period = Carbon::parse($startDate)->toPeriod($endDate, $interval === 'day' ? '1 day' : ($interval === 'week' ? '1 week' : '1 month'));
            
            foreach ($period as $date) {
                $count = User::whereDate('created_at', $date)->count();
                
                $activityData[] = [
                    'date' => $date->format('Y-m-d'),
                    'count' => $count,
                ];
            }

            return $this->success($activityData, 'User activity data retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve user activity data', $e->getMessage(), 500);
        }
    }

    /**
     * Get enrollment trends
     */
    public function enrollmentTrends(Request $request)
    {
        try {
            // Get date range
            $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
            $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
            $interval = $request->get('interval', 'day'); // day, week, month
            
            $trendData = [];
            
            // Generate date range
            $period = Carbon::parse($startDate)->toPeriod($endDate, $interval === 'day' ? '1 day' : ($interval === 'week' ? '1 week' : '1 month'));
            
            foreach ($period as $date) {
                $count = EcourseEnrollment::whereDate('created_at', $date)->count();
                
                $trendData[] = [
                    'date' => $date->format('Y-m-d'),
                    'count' => $count,
                ];
            }

            return $this->success($trendData, 'Enrollment trend data retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve enrollment trend data', $e->getMessage(), 500);
        }
    }

    /**
     * Get popular content
     */
    public function popularContent(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            
            // Get popular e-courses by enrollment count
            $popularEcourses = Ecourse::active()
                ->withCount('enrollments')
                ->orderBy('enrollments_count', 'desc')
                ->limit($limit)
                ->get();
            
            // Get popular events by registration count
            $popularEvents = Event::where('is_active', true)
                ->orderBy('current_participants', 'desc')
                ->limit($limit)
                ->get();
            
            // Get popular posts by like count
            $popularPosts = Post::where('is_active', true)
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->limit($limit)
                ->get();

            return $this->success([
                'popular_ecourses' => $popularEcourses,
                'popular_events' => $popularEvents,
                'popular_posts' => $popularPosts,
            ], 'Popular content retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve popular content', $e->getMessage(), 500);
        }
    }
}