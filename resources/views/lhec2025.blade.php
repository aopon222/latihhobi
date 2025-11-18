@extends('layout.app')

@section('title', 'LHEC IV 2025 - Latih Hobi Expo & Competition')

@push('styles')
    <style>
        :root {
            --lhec-primary: #1E3A8A;
            --lhec-blue: #3B82F6;
            --lhec-cyan: #06B6D4;
            --lhec-yellow: #F59E0B;
            --lhec-orange: #F97316;
            --lhec-purple: #8B5CF6;
            --lhec-white: #FFFFFF;
            --lhec-gray-100: #F3F4F6;
            --lhec-gray-800: #1F2937;
            --lhec-gray-600: #4B5563;
            --lhec-text-dark: #1F2937;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        /* Hero Section dengan Layout 2 Kolom */
        .lhec-hero-section {
            padding: 80px 20px 60px;
            background: var(--lhec-white);
            min-height: 70vh;
            margin-top: 20px;
        }

        .lhec-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .lhec-hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        /* Poster Card */
        .poster-card {
            background: var(--lhec-white);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .poster-card:hover {
            transform: translateY(-5px);
        }

        .poster-image {
            width: 100%;
            height: auto;
            border-radius: 15px;
            display: block;
        }

        /* Hero Content */
        .hero-content {
            padding: 20px 0;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--lhec-text-dark);
            margin-bottom: 30px;
            line-height: 1.2;
        }

        .hero-description {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--lhec-gray-600);
            margin-bottom: 40px;
            text-align: justify;
        }

        .btn-daftar {
            background: #17A2B8;
            color: var(--lhec-white);
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: none;
            letter-spacing: 0;
        }

        .btn-daftar:hover {
            background: #138496;
            transform: translateY(-2px);
            color: var(--lhec-white);
            box-shadow: 0 8px 20px rgba(23, 162, 184, 0.3);
        }

        /* Footer dan bagian lain tetap sama */
        .contact-info {
            background: linear-gradient(135deg, var(--lhec-primary), var(--lhec-blue));
            color: var(--lhec-white);
            text-align: center;
            padding: 60px 20px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-top: 40px;
            max-width: 800px;
            margin: 40px auto 0;
        }

        .contact-item {
            text-align: center;
        }

        .contact-item h4 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--lhec-yellow);
        }

        .contact-item p {
            font-size: 1.1rem;
            margin: 5px 0;
        }

        .contact-item a {
            color: var(--lhec-white);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item a:hover {
            color: var(--lhec-yellow);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .lhec-hero-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .poster-card {
                order: 2;
            }

            .hero-content {
                order: 1;
            }

            .lhec-hero-section {
                padding: 80px 20px 40px;
                margin-top: 10px;
            }

            .hero-description {
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Hero Banner dengan Layout 2 Kolom -->
    <section class="lhec-hero-section">
        <div class="lhec-container">
            <div class="lhec-hero-grid">
                <!-- Kolom Kiri - Poster Card -->
                <div class="poster-card">
                    <img src="{{ asset('images/FLYER LHEC.svg') }}" alt="LHEC 2025 Poster" class="poster-image">
                </div>

                <!-- Kolom Kanan - Konten Text -->
                <div class="hero-content">
                    <h1 class="hero-title">Latih Hobi Expo & Competition 2025</h1>
                    <p class="hero-description">
                        Latih Hobi merupakan penyelenggara kegiatan ekskul yang mempunyai visi 'wadah pengembangan hobi dan
                        bakat anak dengan nilai kolaborasi yang tinggi dalam ekosistem belajar, bertumbuh dan terukur'.
                        Untuk ikutlah Latih Hobi Expo dan Competition ke-4 diselenggarakan dalam rangka memotivasi dan
                        mengukur perkembangan siswa. Acara tersebut merupakan salah satu ajang kompetisi tahunan yang
                        diselenggarakan oleh Latih Hobi untuk memfasilitasi kompetensi pengembangan bakat dan minat anak.
                    </p>
                    <a href="#daftar" class="btn-daftar">Daftar Sekarang!</a>
                </div>
            </div>
        </div>
    </section>

@endsection
