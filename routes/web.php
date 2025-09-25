<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\EcourseController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\EmailTestController;

Route::get('/manual-verify', [EmailTestController::class, 'showManualVerify'])->name('manual.verify');
Route::post('/manual-verify', [EmailTestController::class, 'manualVerify'])->name('manual.verify.submit');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/ekskul-reguler', function () {
    return view('ekskul-reguler');
});

Route::get('/ecourse', [EcourseController::class, 'index']);
Route::get('/ecourse/robotik', [EcourseController::class, 'robotik'])->name('course.robotik');
Route::get('/ecourse-komik', function () {
    return view('course-Komik');
});

Route::get('/event', function () {
    return view('event');
});

// Podcast Routes
Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts.index');
Route::get('/podcasts/{podcast}', [PodcastController::class, 'show'])->name('podcasts.show');

// Search Route
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// E-Course: Film & Konten Kreator landing page
Route::view('/course-film-konten-kreator', 'course-film-konten-kreator')->name('course.film_konten_kreator');
// Backward-compatible paths to avoid 404s from older links
Route::redirect('/ecourse/film', '/course-film-konten-kreator');
Route::redirect('/ecourse/film-konten-kreator', '/course-film-konten-kreator');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    
    // Password Reset Routes
    Route::get('/password/forgot', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

// LHEC 2025 Route
Route::get('/lhec2025', function () {
    return view('lhec2025');
})->name('lhec2025');

// Workshop & Bootcamp landing page
Route::get('/workshop-bootcamp', function () {
    return view('workshop-bootcamp');
})->name('workshop-bootcamp');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Email Testing Routes
    Route::get('/email/status', [EmailTestController::class, 'showEmailStatus'])->name('email.status');
    Route::post('/email/test', [EmailTestController::class, 'testEmail'])->name('email.test');
    
    // Change Password Routes (available to all authenticated users)
    Route::get('/password/change', [PasswordResetController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/password/change', [PasswordResetController::class, 'changePassword'])->name('password.change');
    
    // Email Verification Routes
    Route::get('/email/verify', [AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    
    // Protected routes that require email verification
    Route::middleware('verified')->group(function () {
        // Dashboard Routes
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('profile.update');
    });
});

Route::get('/karier', function () {
    return view('karier');
});

Route::view('/magang', 'podcasts.magang')->name('magang');
Route::view('/profil', 'podcasts.profil')->name('profil');
Route::view('/holiday-fun-class', 'podcasts.holiday-fun-class')->name('holiday-fun-class');
Route::view('/contact', 'contact')->name('contact');

// Admin Dashboard Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Admin E-course Routes - Separate group for admin access
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('ecourses', App\Http\Controllers\Admin\EcourseController::class);
    Route::post('ecourses/{ecourse}/toggle-featured', [App\Http\Controllers\Admin\EcourseController::class, 'toggleFeatured'])
        ->name('ecourses.toggle-featured');
    Route::post('ecourses/{ecourse}/toggle-active', [App\Http\Controllers\Admin\EcourseController::class, 'toggleActive'])
        ->name('ecourses.toggle-active');
    
    // Alternative delete route if resource route fails
    Route::post('ecourses/{ecourse}/delete', [App\Http\Controllers\Admin\EcourseController::class, 'destroy'])
        ->name('ecourses.delete');

    // Podcast management routes
    Route::resource('podcasts', App\Http\Controllers\Admin\PodcastController::class);
    Route::post('podcasts/{podcast}/toggle-featured', [App\Http\Controllers\Admin\PodcastController::class, 'toggleFeatured'])
        ->name('podcasts.toggle-featured');
    Route::post('podcasts/{podcast}/toggle-active', [App\Http\Controllers\Admin\PodcastController::class, 'toggleActive'])
        ->name('podcasts.toggle-active');
});

// Ekskul Routes
Route::get('/ekskul/robotik', function () {
    return view('ekskul.robotik');
});
Route::get('/ekskul/panahan', function () {
    return view('ekskul.panahan');
});
Route::get('/ekskul/komik', function () {
    return view('ekskul.komik');
});
Route::get('/ekskul/film-konten-kreator', function () {
    return view('ekskul.film-konten-kreator');
});
Route::get('/ekskul/taekwondo', function () {
    return view('ekskul.taekwondo');
});
Route::get('/ekskul/pencak-silat', function () {
    return view('ekskul.pencak-silat');
});
Route::get('/ekskul/karate', function () {
    return view('ekskul.karate');
});
Route::get('/ekskul/tahsin-tahfidz', function () {
    return view('ekskul.tahsin-tahfidz');
});
