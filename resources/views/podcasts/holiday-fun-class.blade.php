@extends('layout.app')

@section('title', 'Holiday Fun Class 2025')

@push('styles')
    <style>
        :root {
            --holiday-primary: #3B82F6;
            --holiday-blue: #1E40AF;
            --holiday-orange: #F59E0B;
            --holiday-green: #10B981;
            --holiday-white: #FFFFFF;
            --holiday-gray-100: #F3F4F6;
            --holiday-gray-600: #6B7280;
            --holiday-gray-800: #1F2937;
            --holiday-text-dark: #111827;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: var(--holiday-white);
        }

        /* Holiday Hero Section dengan Layout 2 Kolom */
        .holiday-hero-section {
            padding: 80px 20px 60px;
            background: var(--holiday-white);
            min-height: 80vh;
            margin-top: 20px;
        }

        .holiday-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .holiday-hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        /* Poster Card */
        .holiday-poster-card {
            background: var(--holiday-white);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .holiday-poster-card:hover {
            transform: translateY(-5px);
        }

        .holiday-poster-image {
            width: 100%;
            height: auto;
            border-radius: 15px;
            display: block;
        }

        /* Holiday Content */
        .holiday-content {
            padding: 20px 0;
        }

        .holiday-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--holiday-text-dark);
            margin-bottom: 30px;
            line-height: 1.2;
        }

        .holiday-description {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--holiday-gray-600);
            margin-bottom: 40px;
            text-align: justify;
        }

        .holiday-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 250px;
        }

        .btn-holiday-primary {
            background: var(--holiday-primary);
            color: var(--holiday-white);
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-holiday-primary:hover {
            background: var(--holiday-blue);
            transform: translateY(-2px);
            color: var(--holiday-white);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-holiday-info {
            background: var(--holiday-gray-800);
            color: var(--holiday-white);
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-holiday-info:hover {
            background: #374151;
            transform: translateY(-2px);
            color: var(--holiday-white);
            box-shadow: 0 8px 20px rgba(31, 41, 55, 0.3);
        }

        .btn-holiday-location {
            background: var(--holiday-orange);
            color: var(--holiday-white);
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-holiday-location:hover {
            background: #D97706;
            transform: translateY(-2px);
            color: var(--holiday-white);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .holiday-hero-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .holiday-title {
                font-size: 2rem;
            }

            .holiday-poster-card {
                order: 2;
            }

            .holiday-content {
                order: 1;
            }

            .holiday-hero-section {
                padding: 100px 20px 40px;
                margin-top: 10px;
            }

            .holiday-description {
                text-align: left;
            }

            .holiday-buttons {
                max-width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Holiday Hero Section dengan Layout 2 Kolom -->
    <section class="holiday-hero-section">
        <div class="holiday-container">
            <div class="holiday-hero-grid">
                <!-- Kolom Kiri - Poster Card -->
                <div class="holiday-poster-card">
                    <img src="{{ asset('images/Holiday Fun Class.png') }}" alt="Holiday Fun Class 2025 Poster"
                        class="holiday-poster-image">
                </div>

                <!-- Kolom Kanan - Konten Holiday -->
                <div class="holiday-content">
                    <h1 class="holiday-title">Holiday Fun Class 2025</h1>

                    <p class="holiday-description">
                        Memilih aktivitas saat liburan untuk anak emang ga mudah, harus menyenangkan, edukatif, aman dan
                        bikin bunda ga repot. Apa lagi kalo minat anak berbeda beda. Kali ini latih hobi hadir dengan
                        program HOLIDAY FUN CLASS, di sini anak bisa mengeksplor bakat dari hobinya. Bunda bisa pilih kelas
                        robotik, panahan, komik, serta film dan konten kreator, tinggal sesuai dengan minat anak.
                    </p>

                    <div class="holiday-buttons">
                        <a href="https://docs.google.com/forms/u/1/d/e/1FAIpQLSehm1885Qn9yZkuJiavddyRtp12ndsi_n1Hev9sakQVG4ZY1A/viewform?usp=send_form"
                            target="_blank" class="btn-holiday-primary">
                            Daftar Sekarang!
                        </a>

                        <a href="https://latithobid/holiday-fun-class/" target="_blank" class="btn-holiday-info">
                            More Info
                        </a>

                        <a href="https://goo.gl/maps/8QwK7gQKkF2wQZbJ7" target="_blank" class="btn-holiday-location">
                            Lokasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
