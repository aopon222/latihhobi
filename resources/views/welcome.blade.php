@extends('layout.app')

@section('title', 'LatihHobi - Platform Pembelajaran')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">LatihHobi</div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="active">🏠 Home</a></li>
                <li class="nav-item"><a href="#">📚 Ekskul Reguler</a></li>
                <li class="nav-item"><a href="#">▶️ E-course</a></li>
                <li class="nav-item"><a href="#">📅 Event</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="#" class="btn-signin">Sign In</a>
                <a href="#" class="btn-signup">Sign up</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1>LATIH HOBI</h1>
            <p>Merupakan platform pengembangan bakat yang membantu anak orang tua dan sekolah untuk mengembangkan potensi kemampuan anak di bidangnya masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang kompeten.</p>
            <a href="#" class="btn-start">START E-COURSE</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-container">
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon">📚</div>
                    <div class="service-title">Ekskul Reguler</div>
                    <div class="service-subtitle">Sekolah</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon">✅</div>
                    <div class="service-title">E-Course</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon">👥</div>
                    <div class="service-title">Komunitas &</div>
                    <div class="service-subtitle">Club</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon">👨‍🏫</div>
                    <div class="service-title">Private Class</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon">👥</div>
                    <div class="service-title">LHEC 2025</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="about-container">
            <h2>Ekskul Reguler</h2>
            <p>"Ekskul Reguler LatihHobi adalah program ekstrakurikuler mingguan berbasis proyek yang berlangsung berdasarkan silabus yang sistematis & berlevel. Program ini dirancang untuk anak-anak usia sekolah dan didampingi oleh tutor kompeten, serta melibatkan peran aktif orang tua dan sekolah. Dilaksanakan secara rutin setiap minggu, ekskul ini bisa dijalankan di sekolah mitra LatihHobi."</p>
            <a href="#" class="btn-show-all">SHOW ALL EKSKUL</a>
        </div>
    </section>
@endsection