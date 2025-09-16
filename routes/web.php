<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

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

// Auth pages (temporary views)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Handle auth form submissions (temporary handlers)
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);

    return redirect()->intended('/')
        ->with('status', 'Akun berhasil dibuat. Selamat datang, ' . $user->name . '!');
})->name('register.store');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! Auth::attempt($credentials, remember: true)) {
        throw ValidationException::withMessages([
            'email' => __('Email atau password salah.'),
        ]);
    }

    $request->session()->regenerate();
    return redirect()->intended('/')
        ->with('status', 'Berhasil masuk.');
})->name('login.attempt');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')
        ->with('status', 'Berhasil keluar.');
})->name('logout');