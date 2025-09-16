@extends('layout.app')

@section('title', 'Ekskul Reguler - LatihHobi')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
                
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="/ekskul-reguler" class="active">Ekskul Reguler</a></li>
                <li class="nav-item dropdown">
                    <a href="#">E-course <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🤖</span>
                            Ecourse Robotik
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🎬</span>
                            Ecourse Film & Kont...
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">📖</span>
                            Ecourse Komik
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="/event">Event <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🏆</span>
                            LHEC IV 2025
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">💼</span>
                            WORKSHOP & BOOTCAMP
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🎉</span>
                            HOLIDAY FUN CLASS
                        </a>
                    </div>
                </li>
            </ul>
            <div class="user-menu">
                <a href="#" class="user-icon">🔍</a>
                <a href="#" class="user-icon">🛒</a>
                @php
                    $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                    $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                    $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
                @endphp
                @auth
                    <span class="username">{{ auth()->user()->name }}</span>
                    @if($hasLogoutRoute)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-signin">Logout</button>
                    </form>
                    @endif
                @else
                    @if($hasLoginRoute)
                    <a href="{{ route('login') }}" class="btn-signin">Sign in</a>
                    @endif
                    @if($hasRegisterRoute)
                    <a href="{{ route('register') }}" class="btn-signup">Sign up</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="ekskul-hero">
        <div class="ekskul-hero-content">
            <h1>EKSKUL REGULER</h1>
        </div>
    </section>

    <!-- Ekskul Reguler Section -->
    <section class="ekskul-section">
        <div class="ekskul-container">
            <div class="ekskul-grid">
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-robotik.svg') }}" alt="Robotik" class="ekskul-icon-img">
                    </div>
                    <h3>Robotik</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-panahan.svg') }}" alt="Panahan" class="ekskul-icon-img">
                    </div>
                    <h3>Panahan</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-komik.svg') }}" alt="Komik" class="ekskul-icon-img">
                    </div>
                    <h3>Komik</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-film.svg') }}" alt="Film & Konten Kreator" class="ekskul-icon-img">
                    </div>
                    <h3>Film & Konten Kreator</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-taekwondo.svg') }}" alt="Taekwondo" class="ekskul-icon-img">
                    </div>
                    <h3>Taekwondo</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-pencak-silat.svg') }}" alt="Pencak Silat" class="ekskul-icon-img">
                    </div>
                    <h3>Pencak Silat</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-karate.svg') }}" alt="Karate" class="ekskul-icon-img">
                    </div>
                    <h3>Karate</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/placeholder-tahsin.svg') }}" alt="Tahsin & Tahfidz" class="ekskul-icon-img">
                    </div>
                    <h3>Tahsin & Tahfidz</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Ekskul Section -->
    <section class="galeri-section">
        <div class="galeri-container">
            <h2>GALERI EKSKUL</h2>
            <div class="galeri-grid">
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-1.jpg') }}" alt="Galeri 1" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-2.jpg') }}" alt="Galeri 2" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-3.jpg') }}" alt="Galeri 3" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-4.jpg') }}" alt="Galeri 4" class="galeri-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="social-section">
        <div class="social-container">
            <h2>Ikuti Kami</h2>
            <div class="social-icons">
                <a href="#" class="social-icon instagram">📷</a>
                <a href="#" class="social-icon facebook">📘</a>
                <a href="#" class="social-icon youtube">📺</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <p>© 2025 - Latihhobi</p>
            </div>
            <div class="footer-right">
                <a href="#" class="footer-social">📷</a>
                <a href="#" class="footer-social">📘</a>
                <a href="#" class="footer-social">📺</a>
            </div>
        </div>
    </footer>
@endsection
