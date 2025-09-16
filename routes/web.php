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