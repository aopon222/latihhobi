@extends('layout.app')

@section('title', 'Ekskul Reguler - LatihHobi')

@push('styles')
    <style>
        :root {
            --ekskul-primary: #1E3A8A;
            --ekskul-blue: #3B82F6;
            --ekskul-orange: #F97316;
            --ekskul-white: #FFFFFF;
            --ekskul-gray-100: #F3F4F6;
            --ekskul-gray-600: #6B7280;
            --ekskul-gray-800: #1F2937;
            --ekskul-text-dark: #111827;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        /* Hero Section with Background */
        .ekskul-hero {
            position: relative;
            height: 500px;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.6), rgba(59, 130, 246, 0.6)),
                url('{{ asset('images/Hero Ekskul Reguler.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ekskul-white);
            margin-top: 80px;
        }

        .ekskul-hero-overlay {
            text-align: center;
            z-index: 2;
        }

        .ekskul-hero h1 {
            font-size: 4rem;
            font-weight: 900;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
        }

        /* Ekskul Reguler Section */
        .ekskul-section {
            padding: 80px 20px;
            background: var(--ekskul-white);
        }

        .ekskul-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .ekskul-intro {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: flex-start;
        }

        .ekskul-main-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .ekskul-main-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .ekskul-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--ekskul-text-dark);
            margin-bottom: 30px;
        }

        .ekskul-content p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ekskul-gray-600);
            margin-bottom: 20px;
            text-align: justify;
        }

        /* Blue Cards Section */
        .blue-cards-section {
            background: #2B4A87;
            padding: 80px 20px;
        }

        .blue-cards-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .card-item {
            background: var(--ekskul-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card-item:hover {
            transform: translateY(-10px);
        }

        .card-item img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .card-item h3 {
            padding: 25px;
            margin: 0;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--ekskul-text-dark);
            background: var(--ekskul-white);
        }

        /* Galeri Ekskul Section */
        .galeri-section {
            padding: 80px 20px;
            background: var(--ekskul-gray-100);
        }

        .galeri-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .galeri-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--ekskul-text-dark);
            margin-bottom: 50px;
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .galeri-item {
            background: var(--ekskul-white);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .galeri-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .galeri-item a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .galeri-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .galeri-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .galeri-item h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--ekskul-text-dark);
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .ekskul-hero h1 {
                font-size: 2.5rem;
            }

            .ekskul-intro {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .ekskul-main-image {
                order: -1;
            }

            .blue-cards-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .ekskul-content h2 {
                font-size: 2rem;
            }

            .galeri-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .galeri-section h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .galeri-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="ekskul-hero">
        <div class="ekskul-hero-overlay">
            <h1>Ekskul Reguler</h1>
        </div>
    </section>

    <!-- Ekskul Reguler Section -->
    <section class="ekskul-section">
        <div class="ekskul-container">
            <div class="ekskul-intro">
                <div class="ekskul-main-image">
                    <img src="{{ asset('images/Ekskul Reguler.png') }}" alt="Ekskul Reguler Group Photo">
                </div>

                <div class="ekskul-content">
                    <h2>Ekskul Reguler</h2>
                    <p>
                        Ekskul Reguler LatihHobi merupakan kegiatan ekstrakurikuler mingguan berbasis proyek, yang disusun
                        berdasarkan silabus terstruktur dan bertingkat. Program ini ditujukan bagi anak-anak usia sekolah,
                        didampingi oleh tutor berpengalaman, serta melibatkan peran aktif dari orang tua dan pihak sekolah.
                        Kegiatan ini dilaksanakan secara rutin setiap minggu di sekolah mitra LatihHobi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blue Cards Section -->
    <section class="blue-cards-section">
        <div class="blue-cards-container">
            <div class="card-item">
                <img src="{{ asset('images/Kerjasama Sekolah.png') }}" alt="Kerjasama Sekolah">
                <h3>Kerjasama Sekolah</h3>
            </div>
            <div class="card-item">
                <img src="{{ asset('images/Kelas Privat.png') }}" alt="Kelas Privat">
                <h3>Kelas Privat</h3>
            </div>
        </div>
    </section>

    <!-- Galeri Ekskul Section -->
    <section class="galeri-section">
        <div class="galeri-container">
            <h2>Galeri Ekskul</h2>
            <div class="galeri-grid">
                <a href="/ekskul/robotik" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/robotik.svg') }}" alt="Robotik">
                    </div>
                    <h3>Robotik</h3>
                </a>

                <a href="/ekskul/komik" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/komik.svg') }}" alt="Komik">
                    </div>
                    <h3>Komik</h3>
                </a>

                <a href="/ekskul/panahan" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/ARCHERY CLUB.svg') }}" alt="Panahan">
                    </div>
                    <h3>Panahan</h3>
                </a>

                <a href="/ekskul/film-konten-kreator" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/film.svg') }}" alt="Film & Konten Kreator">
                    </div>
                    <h3>Film & Konten Kreator</h3>
                </a>

                <a href="/ekskul/pencak-silat" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/SILAT.svg') }}" alt="Pencak Silat">
                    </div>
                    <h3>Pencak Silat</h3>
                </a>

                <a href="/ekskul/karate" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/KARATE.svg') }}" alt="Karate">
                    </div>
                    <h3>Karate</h3>
                </a>

                <a href="/ekskul/taekwondo" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/TAEKWONDO.svg') }}" alt="Taekwondo">
                    </div>
                    <h3>Taekwondo</h3>
                </a>

                <a href="/ekskul/tahsin-tahfidz" class="galeri-item">
                    <div class="galeri-icon">
                        <img src="{{ asset('images/TAHFIDZ.svg') }}" alt="Tahsin & Tahfidz">
                    </div>
                    <h3>Tahsin & Tahfidz</h3>
                </a>
            </div>
        </div>
    </section>

@endsection
