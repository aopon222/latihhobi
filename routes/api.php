<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PodcastController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EcourseController;
use App\Http\Controllers\Api\EcourseLessonController;
use App\Http\Controllers\Api\EcourseEnrollmentController;
use App\Http\Controllers\Api\EcourseProgressController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Public - View categories and courses
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::get('/courses/category/{categoryId}', [CourseController::class, 'byCategory']);

// Podcast routes (public)
Route::get('/podcasts', [PodcastController::class, 'index']);
Route::get('/podcasts/{id}', [PodcastController::class, 'show']);
Route::get('/podcasts/featured', [PodcastController::class, 'featured']);

// Search routes (public)
Route::get('/search', [SearchController::class, 'index']);
Route::get('/search/ecourses', [SearchController::class, 'ecourses']);
Route::get('/search/programs', [SearchController::class, 'programs']);
Route::get('/search/events', [SearchController::class, 'events']);
Route::get('/search/podcasts', [SearchController::class, 'podcasts']);
Route::get('/search/posts', [SearchController::class, 'posts']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar']);
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword']);
    Route::get('/profile/enrollments', [ProfileController::class, 'enrollments']);
    Route::get('/profile/communities', [ProfileController::class, 'communities']);

    // Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addItem']);
    Route::put('/cart/items/{id}', [CartController::class, 'updateItem']);
    Route::delete('/cart/items/{id}', [CartController::class, 'removeItem']);
    Route::delete('/cart/clear', [CartController::class, 'clear']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);

    // Coupon validation
    Route::post('/coupons/validate', [CouponController::class, 'validate']);
    
    // Category routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    
    // Program routes
    Route::get('/programs', [ProgramController::class, 'index']);
    Route::get('/programs/{id}', [ProgramController::class, 'show']);
    Route::get('/programs/category/{categoryId}', [ProgramController::class, 'byCategory']);
    Route::get('/programs/search', [ProgramController::class, 'search']);
    
    // Class routes
    Route::get('/classes', [ClassController::class, 'index']);
    Route::get('/classes/{id}', [ClassController::class, 'show']);
    Route::get('/classes/program/{programId}', [ClassController::class, 'byProgram']);
    
    // Enrollment routes
    Route::get('/enrollments', [EnrollmentController::class, 'index']);
    Route::get('/enrollments/{id}', [EnrollmentController::class, 'show']);
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
    Route::put('/enrollments/{id}/cancel', [EnrollmentController::class, 'cancel']);
    
    // School routes
    Route::get('/schools', [SchoolController::class, 'index']);
    Route::get('/schools/{id}', [SchoolController::class, 'show']);
    Route::get('/schools/search', [SchoolController::class, 'search']);
    Route::get('/schools/city/{city}', [SchoolController::class, 'byCity']);
    Route::post('/schools/register-interest', [SchoolController::class, 'registerInterest']);
    
    // Community routes
    Route::get('/communities', [CommunityController::class, 'index']);
    Route::get('/communities/{id}', [CommunityController::class, 'show']);
    Route::post('/communities', [CommunityController::class, 'store']);
    Route::post('/communities/{id}/join', [CommunityController::class, 'join']);
    Route::post('/communities/{id}/leave', [CommunityController::class, 'leave']);
    Route::get('/communities/{id}/members', [CommunityController::class, 'members']);
    
    // Post routes
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::get('/posts/community/{communityId}', [PostController::class, 'byCommunity']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::post('/posts/{id}/like', [PostController::class, 'like']);
    Route::get('/posts/my-posts', [PostController::class, 'myPosts']);
    
    // Dashboard routes
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/upcoming-classes', [DashboardController::class, 'upcomingClasses']);
    Route::get('/dashboard/my-enrollments', [DashboardController::class, 'myEcourses']);
    Route::get('/dashboard/my-posts', [DashboardController::class, 'myPosts']);
    Route::get('/dashboard/my-communities', [DashboardController::class, 'myCommunities']);
    Route::get('/dashboard/my-payments', [DashboardController::class, 'myPayments']);
    
    // E-course routes
    Route::get('/ecourses', [EcourseController::class, 'index']);
    Route::get('/ecourses/{id}', [EcourseController::class, 'show']);
    Route::get('/ecourses/featured', [EcourseController::class, 'featured']);
    Route::get('/ecourses/category/{category}', [EcourseController::class, 'byCategory']);
    Route::get('/ecourses/search', [EcourseController::class, 'search']);
    Route::get('/ecourses/my-ecourses', [EcourseController::class, 'myEcourses']);
    
    // E-course lesson routes
    Route::get('/ecourse-lessons/ecourse/{ecourseId}', [EcourseLessonController::class, 'index']);
    Route::get('/ecourse-lessons/{id}', [EcourseLessonController::class, 'show']);
    Route::get('/ecourse-lessons/{lessonId}/content', [EcourseLessonController::class, 'getContent']);
    Route::post('/ecourse-lessons/{lessonId}/complete', [EcourseLessonController::class, 'markAsCompleted']);
    
    // E-course enrollment routes
    Route::get('/ecourse-enrollments', [EcourseEnrollmentController::class, 'index']);
    Route::get('/ecourse-enrollments/{id}', [EcourseEnrollmentController::class, 'show']);
    Route::post('/ecourse-enrollments', [EcourseEnrollmentController::class, 'store']);
    Route::put('/ecourse-enrollments/{id}/cancel', [EcourseEnrollmentController::class, 'cancel']);
    Route::get('/ecourse-enrollments/{id}/progress', [EcourseEnrollmentController::class, 'progress']);
    
    // E-course progress routes
    Route::get('/ecourse-progress', [EcourseProgressController::class, 'index']);
    Route::get('/ecourse-progress/enrollment/{enrollmentId}', [EcourseProgressController::class, 'show']);
    Route::post('/ecourse-progress/lesson/{lessonId}/reset', [EcourseProgressController::class, 'resetLesson']);
    
    // Event routes
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::get('/events/featured', [EventController::class, 'featured']);
    Route::get('/events/upcoming', [EventController::class, 'upcoming']);
    Route::get('/events/search', [EventController::class, 'search']);
    Route::post('/events/{eventId}/register', [EventController::class, 'register']);
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    
    // Analytics routes
    Route::get('/analytics/overview', [AnalyticsController::class, 'overview']);
    Route::get('/analytics/user-engagement', [AnalyticsController::class, 'userEngagement']);
    Route::get('/analytics/content-engagement', [AnalyticsController::class, 'contentEngagement']);
    Route::get('/analytics/user-activity', [AnalyticsController::class, 'userActivity']);
    Route::get('/analytics/enrollment-trends', [AnalyticsController::class, 'enrollmentTrends']);
    Route::get('/analytics/popular-content', [AnalyticsController::class, 'popularContent']);
    
    // File routes
    Route::post('/files/upload', [FileController::class, 'upload']);
    Route::get('/files/download/{id}', [FileController::class, 'download']);
    Route::get('/files/{fileableType}/{fileableId}', [FileController::class, 'forModel']);
    Route::delete('/files/{id}', [FileController::class, 'destroy']);

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        // Categories
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Courses
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{id}', [CourseController::class, 'update']);
        Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

        // Coupons
        Route::get('/coupons', [CouponController::class, 'index']);
        Route::post('/coupons', [CouponController::class, 'store']);
        Route::get('/coupons/{id}', [CouponController::class, 'show']);
        Route::delete('/coupons/{id}', [CouponController::class, 'destroy']);

        // All orders (admin view)
        Route::get('/admin/orders', [OrderController::class, 'allOrders']);
    });
});