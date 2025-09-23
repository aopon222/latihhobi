<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PodcastController;

// E-Course Robotik landing page
Route::view('/ecourse/robotik', 'ecourse-robotik')->name('course.robotik');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/ekskul-reguler', function () {
    return view('ekskul-reguler');
});

Route::get('/ecourse', function () {
    return view('ecourse');
});

Route::get('/event', function () {
    return view('event');
});

// Podcast Routes
Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts.index');
Route::get('/podcasts/{podcast}', [PodcastController::class, 'show'])->name('podcasts.show');

// E-Course: Film & Konten Kreator landing page
Route::view('/course-film-konten-kreator', 'course-film-konten-kreator')->name('course.film_konten_kreator');
// Backward-compatible paths to avoid 404s from older links
Route::redirect('/ecourse/film', '/course-film-konten-kreator');
Route::redirect('/ecourse/film-konten-kreator', '/course-film-konten-kreator');

// E-Course: Komik landing page
Route::view('/ecourse-komik', 'course-Komik')->name('course.komik');
Route::view('/course-komik', 'course-Komik');
Route::redirect('/ecourse/komik', '/course-komik');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email Verification Routes (must be accessible to authenticated but unverified users)
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
        Route::post('/profile', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('profile.update');
    });
});

// LHEC 2025 landing page
Route::view('/lhec2025', 'lhec2025')->name('lhec2025');

// Workshop & Bootcamp landing page
Route::get('/workshop-bootcamp', function () {
    return view('workshop-bootcamp');
})->name('workshop-bootcamp');

Route::get('/karier', function () {
    return view('podcasts.karier');
});

Route::view('/magang', 'podcasts.magang')->name('magang');
Route::view('/profil', 'podcasts.profil')->name('profil');
Route::view('/holiday-fun-class', 'podcasts.holiday-fun-class')->name('holiday-fun-class');
