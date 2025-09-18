@extends('layout.app')

@section('title', 'Event - LatihHobi')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="/ekskul-reguler">Ekskul Reguler</a></li>
                <li class="nav-item dropdown">
                    <a href="/ecourse">E-course <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="/ecourse/robotik" class="dropdown-item">
                            <span class="dropdown-icon">🤖</span>
                            Ecourse Robotik
                        </a>
                        <a href="/ecourse/film" class="dropdown-item">
                            <span class="dropdown-icon">🎬</span>
                            Ecourse Film & Konten Kreator
                        </a>
                        <a href="/ecourse/komik" class="dropdown-item">
                            <span class="dropdown-icon">📖</span>
                            Ecourse Komik
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="/event" class="active">Event <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="/event/lhec-2025" class="dropdown-item">
                            <span class="dropdown-icon">🏆</span>
                            LHEC IV 2025
                        </a>
                        <a href="/event/workshop" class="dropdown-item">
                            <span class="dropdown-icon">💼</span>
                            WORKSHOP & BOOTCAMP
                        </a>
                        <a href="/event/holiday" class="dropdown-item">
                            <span class="dropdown-icon">🎉</span>
                            HOLIDAY FUN CLASS
                        </a>
                    </div>
                </li>
            </ul>
            <div class="user-menu">
                <a href="#" class="user-icon">🔍</a>
                <a href="#" class="user-icon">🛒</a>
                <a href="#" class="btn-signin">Sign in</a>
                <a href="#" class="btn-signup">Sign up</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="event-hero">
        <div class="event-hero-content">
            <h1>EVENT</h1>
            <p>Ikuti berbagai event menarik dari LatihHobi untuk mengembangkan bakat dan hobi Anda</p>
        </div>
    </section>

    <!-- Event Categories -->
    <section class="event-categories">
        <div class="event-container">
            <div class="event-grid">
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">🏆</span>
                    </div>
                    <h3>LHEC IV 2025</h3>
                    <p>Kompetisi robotik tingkat nasional yang menantang kreativitas dan inovasi anak-anak Indonesia</p>
                    <a href="/event/lhec-2025" class="btn-event">Lihat Detail</a>
                </div>
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">💼</span>
                    </div>
                    <h3>WORKSHOP & BOOTCAMP</h3>
                    <p>Program intensif untuk mengembangkan keterampilan dalam berbagai bidang teknologi dan kreativitas</p>
                    <a href="/event/workshop" class="btn-event">Lihat Detail</a>
                </div>
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">🎉</span>
                    </div>
                    <h3>HOLIDAY FUN CLASS</h3>
                    <p>Kelas seru selama liburan sekolah untuk mengisi waktu dengan kegiatan yang bermanfaat dan menyenangkan</p>
                    <a href="/event/holiday" class="btn-event">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="upcoming-events">
        <div class="upcoming-container">
            <h2>Event Mendatang</h2>
            <div class="events-timeline">
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">MAR</span>
                        <span class="day">15</span>
                    </div>
                    <div class="event-details">
                        <h4>LHEC IV 2025 - Pendaftaran Dibuka</h4>
                        <p>Pendaftaran kompetisi robotik tingkat nasional sudah dibuka. Segera daftarkan tim Anda!</p>
                        <span class="event-status">Pendaftaran Dibuka</span>
                    </div>
                </div>
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">APR</span>
                        <span class="day">20</span>
                    </div>
                    <div class="event-details">
                        <h4>Workshop Robotik untuk Pemula</h4>
                        <p>Workshop intensif 2 hari untuk mempelajari dasar-dasar robotik dan pemrograman.</p>
                        <span class="event-status">Coming Soon</span>
                    </div>
                </div>
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">JUN</span>
                        <span class="day">10</span>
                    </div>
                    <div class="event-details">
                        <h4>Holiday Fun Class - Summer Edition</h4>
                        <p>Berbagai kelas seru selama liburan musim panas dengan tema teknologi dan kreativitas.</p>
                        <span class="event-status">Coming Soon</span>
                    </div>
                </div>
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

