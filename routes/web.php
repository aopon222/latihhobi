<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\EcourseController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\EmailTestController;
use App\Models\Ecourse;
use App\Models\Category;

Route::get('/manual-verify', [EmailTestController::class, 'showManualVerify'])->name('manual.verify');
Route::post('/manual-verify', [EmailTestController::class, 'manualVerify'])->name('manual.verify.submit');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/ekskul-reguler', function () {
    return view('ekskul-reguler');
});

// E-Course Routes - Menggunakan Controller (Best Practice)
Route::get('/ecourse', [EcourseController::class, 'index'])->name('ecourse.index');

// E-Course: Komik (sebelum wildcard agar tidak tertangkap oleh {id})
Route::get('/ecourse/komik', [EcourseController::class, 'komik'])->name('course.komik');
Route::redirect('/ecourse-komik', '/ecourse/komik');

// E-Course: Film & Konten Kreator (sebelum wildcard)
Route::get('/course-film-konten-kreator', [EcourseController::class, 'filmKontenKreator'])->name('course.film_konten_kreator');
Route::redirect('/ecourse/film', '/course-film-konten-kreator');
Route::redirect('/ecourse/film-konten-kreator', '/course-film-konten-kreator');

// E-Course: Robotik (sebelum wildcard)
Route::get('/ecourse/robotik', [EcourseController::class, 'robotik'])->name('course.robotik');
Route::redirect('/ecourse-robotik', '/ecourse/robotik');

// E-Course: Dynamic category routes (auto-generated views) - HARUS SEBELUM /{id}
Route::get('/ecourse/category/{slug}', [EcourseController::class, 'category'])->name('ecourse.category');

// E-Course: Detail dan Cart (wildcard terakhir)
Route::get('/ecourse/{id}', [EcourseController::class, 'show'])->name('ecourse.show');
Route::post('/ecourse/{id}/add-to-cart', [EcourseController::class, 'addToCart'])->name('ecourse.addToCart')->middleware('auth');

// Web cart page (show items)
Route::get('/cart', [App\Http\Controllers\WebCartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::get('/cart-data', [App\Http\Controllers\WebCartController::class, 'getCartData'])->name('cart.data');
// Cart modification endpoints used by AJAX in the cart page
Route::patch('/cart/update/{id}', [App\Http\Controllers\WebCartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\WebCartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::delete('/cart/clear', [App\Http\Controllers\WebCartController::class, 'clear'])->name('cart.clear')->middleware('auth');

Route::get('/event', function () {
    return view('event');
});

// Event Routes (Frontend)
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');

// Podcast Routes
Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts.index');
Route::get('/podcasts/{podcast}', [PodcastController::class, 'show'])->name('podcasts.show');

// Search Route
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

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
    Route::get('/email/config-check', [EmailTestController::class, 'showEmailStatus'])->name('email.config.check');
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
    // Backward-compatible singular path: /admin/event -> /admin/events
    Route::get('event', function () {
        return redirect()->route('admin.events.index');
    })->name('events.redirect');
    Route::resource('ecourses', App\Http\Controllers\Admin\EcourseController::class);
    Route::post('ecourses/{ecourse}/toggle-featured', [App\Http\Controllers\Admin\EcourseController::class, 'toggleFeatured'])
        ->name('ecourses.toggle-featured');
    Route::post('ecourses/{ecourse}/toggle-active', [App\Http\Controllers\Admin\EcourseController::class, 'toggleActive'])
        ->name('ecourses.toggle-active');

    // Alternative delete route if resource route fails
    Route::post('ecourses/{ecourse}/delete', [App\Http\Controllers\Admin\EcourseController::class, 'destroy'])
        ->name('ecourses.delete');

    // Enrollment management routes
    Route::resource('enrollments', App\Http\Controllers\Admin\EcourseEnrollmentController::class)->only(['index', 'show']);
    Route::post('enrollments/{enrollment}/toggle-lock', [App\Http\Controllers\Admin\EcourseEnrollmentController::class, 'toggleLock'])
        ->name('enrollments.toggle-lock');

    // Podcast management routes
    Route::resource('podcasts', App\Http\Controllers\Admin\PodcastController::class);
    Route::post('podcasts/{podcast}/toggle-featured', [App\Http\Controllers\Admin\PodcastController::class, 'toggleFeatured'])
        ->name('podcasts.toggle-featured');
    Route::post('podcasts/{podcast}/toggle-active', [App\Http\Controllers\Admin\PodcastController::class, 'toggleActive'])
        ->name('podcasts.toggle-active');

    // Event management routes
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::post('events/{event}/toggle-featured', [App\Http\Controllers\Admin\EventController::class, 'toggleFeatured'])
        ->name('events.toggle-featured');
    Route::post('events/{event}/toggle-active', [App\Http\Controllers\Admin\EventController::class, 'toggleActive'])
        ->name('events.toggle-active');
    
    // Category management (delete only if unused)
    Route::delete('categories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])
        ->name('categories.destroy');
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


Route::get('/inforobot', function () {
    return view('inforobot');
})->name('inforobot');

// Test route for error alert notification
Route::get('/test-error', function () {
    \Illuminate\Support\Facades\Notification::route('mail', env('ADMIN_EMAIL', 'admin@latihhobi.com'))
        ->notify(new \App\Notifications\ErrorAlert(new \Exception('Test error for notification')));
    return 'Test notification sent!';
});
