<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Tambahin ini biar route login ada
Route::get('/login', function () {
    return "Halaman Login sementara";
})->name('login');
Route::get('/register', function () {
    return "Halaman Register sementara";
})->name('register');