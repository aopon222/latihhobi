<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ekskul-reguler', function () {
    return view('ekskul-reguler');
});

Route::get('/ecourse', function () {
    return view('ecourse');
});

Route::get('/event', function () {
    return view('event');
});

// E-Course: Film & Konten Kreator landing page
Route::view('/course-film-konten-kreator', 'course-film-konten-kreator')->name('course.film_konten_kreator');
// Backward-compatible paths to avoid 404s from older links
Route::redirect('/ecourse/film', '/course-film-konten-kreator');
Route::redirect('/ecourse/film-konten-kreator', '/course-film-konten-kreator');

// Auth pages (UI only) to resolve missing named routes and show sign-in/register screens
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Basic logout endpoint so the logout button does not error even without full auth wiring
Route::post('/logout', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect('/');
})->name('logout');