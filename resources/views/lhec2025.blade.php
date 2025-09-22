@extends('layout.app')

@section('title', 'LHEC 2025 - LatihHobi Expo dan Competition')

@section('content')
    <!-- Header Section -->
    <header class="header lhec-header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="/ekskul-reguler">Ekskul Reguler</a></li>
                <li class="nav-item"><a href="/ecourse">E-course</a></li>
                <li class="nav-item active"><a href="/lhec2025">LHEC 2025</a></li>
                <li class="nav-item"><a href="/event">Event</a></li>
                <li class="nav-item"><a href="/profil">Tentang Kami</a></li>
            </ul>
            <div class="user-menu">
                @php
                    $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                    $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                @endphp
                @auth
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
        <div class="lhec-hero-content fade-in">
            <h1>LHEC 2025</h1>
            <p>LatihHobi Expo dan Competition 2025</p>
            <a href="#lhec-registration" class="btn-start">DAFTAR SEKARANG</a>
        </div>
    </header>

    <!-- Deskripsi Acara -->
    <section class="lhec-section lhec-description">
        <h2>Deskripsi Acara</h2>
        <p>
            LHEC 2025 adalah acara tahunan yang diselenggarakan oleh LatihHobi untuk mempertemukan para peserta, mentor, dan penggiat pendidikan. Acara ini bertujuan untuk mengembangkan bakat dan minat anak-anak dalam berbagai bidang melalui kompetisi dan workshop yang menarik.
        </p>
    </section>

    <!-- Jadwal Acara -->
    <section class="lhec-section lhec-schedule">
        <h2>Jadwal Acara</h2>
        <div class="lhec-schedule-list">
            <div class="lhec-schedule-day">
                <h3>Hari Pertama: 15 Agustus 2025</h3>
                <ul>
                    <li>09:00 - 10:00: Pembukaan</li>
                    <li>10:00 - 12:00: Workshop Robotik</li>
                    <li>13:00 - 15:00: Kompetisi Coding</li>
                </ul>
            </div>
            <div class="lhec-schedule-day">
                <h3>Hari Kedua: 16 Agustus 2025</h3>
                <ul>
                    <li>09:00 - 11:00: Workshop Desain</li>
                    <li>11:00 - 13:00: Kompetisi Film & Konten Kreator</li>
                    <li>14:00 - 16:00: Penutupan dan Pengumuman Pemenang</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Pembicara -->
    <section class="lhec-section lhec-speakers">
        <h2>Pembicara</h2>
        <div class="speaker-list">
            <div class="speaker">
                <img src="{{ asset('images/speaker1.png') }}" alt="Dr. Andi Setiawan" class="speaker-img">
                <h3>Dr. Andi Setiawan</h3>
                <p>Ahli Robotik dan Teknologi Pendidikan</p>
            </div>
            <div class="speaker">
                <img src="{{ asset('images/speaker2.png') }}" alt="Ms. Rina Sari" class="speaker-img">
                <h3>Ms. Rina Sari</h3>
                <p>Penggiat Konten Kreator dan Media Sosial</p>
            </div>
            <div class="speaker">
                <img src="{{ asset('images/speaker3.png') }}" alt="Mr. Budi Santoso" class="speaker-img">
                <h3>Mr. Budi Santoso</h3>
                <p>Mentor Desain Grafis dan Kreatif</p>
            </div>
        </div>
    </section>

    <!-- Registrasi -->
    <section class="lhec-section lhec-registration" id="lhec-registration">
        <h2>Registrasi</h2>
        <p>Daftarkan diri Anda untuk mengikuti LHEC 2025 dan dapatkan kesempatan untuk belajar langsung dari para ahli serta berkompetisi dengan peserta lainnya.</p>
        <a href="/register" class="btn-register">Daftar Sekarang</a>
    </section>

    <style>
        .lhec-header {
            background: linear-gradient(120deg, #f44336 0%, #ff9800 100%);
            color: #fff;
            padding-bottom: 40px;
            text-align: center;
        }
        .lhec-hero-content {
            margin-top: 40px;
        }
        .lhec-hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .lhec-hero-content p {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        .btn-start, .btn-register {
            background: #fff;
            color: #f44336;
            padding: 12px 32px;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-start:hover, .btn-register:hover {
            background: #f44336;
            color: #fff;
        }
        .lhec-section {
            padding: 48px 0 32px 0;
            max-width: 900px;
            margin: 0 auto;
        }
        .lhec-section h2 {
            color: #f44336;
            margin-bottom: 18px;
            font-size: 2rem;
        }
        .lhec-schedule-list {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
        }
        .lhec-schedule-day {
            background: #fff3e0;
            border-radius: 12px;
            padding: 24px;
            flex: 1 1 300px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .lhec-schedule-day h3 {
            margin-bottom: 10px;
            color: #ff9800;
        }
        .speaker-list {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .speaker {
            background: #fff;
            border-radius: 12px;
            padding: 24px 18px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            flex: 1 1 220px;
            max-width: 240px;
        }
        .speaker-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            background: #ffe0b2;
        }
        @media (max-width: 900px) {
            .lhec-schedule-list, .speaker-list {
                flex-direction: column;
                gap: 18px;
            }
        }
    </style>
@endsection
