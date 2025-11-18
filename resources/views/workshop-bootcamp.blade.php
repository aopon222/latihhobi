@extends('layout.app')

@section('title', 'Parenting Workshop - Bakat Anak Indonesia')

@push('styles')
    <style>
        :root {
            --workshop-primary: #17A2B8;
            --workshop-blue: #0D6EFD;
            --workshop-orange: #FD7E14;
            --workshop-yellow: #FFC107;
            --workshop-white: #FFFFFF;
            --workshop-gray-100: #F8F9FA;
            --workshop-gray-600: #6C757D;
            --workshop-gray-800: #495057;
            --workshop-text-dark: #212529;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: var(--workshop-gray-100);
        }

        /* Workshop Hero Section dengan Layout Vertikal */
        .workshop-hero-section {
            padding: 100px 20px 60px;
            background: var(--workshop-white);
            margin-top: 20px;
        }

        .workshop-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Poster Section - Full Width di Top */
        .workshop-poster-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .workshop-poster-card {
            background: var(--workshop-white);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: inline-block;
            max-width: 1000px;
            width: 90%;
        }

        .workshop-poster-card:hover {
            transform: translateY(-5px);
        }

        .workshop-poster-image {
            width: 100%;
            height: auto;
            border-radius: 15px;
            display: block;
        }

        /* Workshop Content Section */
        .workshop-content-section {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Workshop Content */
        .workshop-content {
            padding: 0;
        }

        .workshop-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--workshop-text-dark);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .workshop-subtitle {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--workshop-text-dark);
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .workshop-description {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--workshop-gray-600);
            margin-bottom: 30px;
            text-align: justify;
        }

        .workshop-details {
            margin-bottom: 40px;
        }

        .workshop-detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
            color: var(--workshop-gray-800);
        }

        .workshop-detail-icon {
            background: var(--workshop-primary);
            color: var(--workshop-white);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.8rem;
        }

        .workshop-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .workshop-info-card {
            background: var(--workshop-gray-100);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .workshop-info-card h4 {
            color: var(--workshop-primary);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .workshop-info-card p {
            color: var(--workshop-gray-800);
            font-size: 0.95rem;
            margin: 0;
        }

        .workshop-features {
            margin-bottom: 30px;
        }

        .workshop-features h3 {
            color: var(--workshop-text-dark);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .workshop-features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .workshop-features li {
            padding: 8px 0;
            color: var(--workshop-gray-800);
            position: relative;
            padding-left: 25px;
        }

        .workshop-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--workshop-primary);
            font-weight: bold;
        }

        .btn-workshop {
            background: var(--workshop-primary);
            color: var(--workshop-white);
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

        .btn-workshop:hover {
            background: #138496;
            transform: translateY(-2px);
            color: var(--workshop-white);
            box-shadow: 0 8px 20px rgba(23, 162, 184, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .workshop-title {
                font-size: 2rem;
            }

            .workshop-hero-section {
                padding: 100px 20px 40px;
                margin-top: 10px;
            }

            .workshop-description {
                text-align: left;
            }

            .workshop-info-grid {
                grid-template-columns: 1fr;
            }

            .workshop-poster-card {
                max-width: 100%;
                margin: 0 10px;
            }

            .workshop-content-section {
                padding: 0 10px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Workshop Hero Section dengan Layout Vertikal -->
    <section class="workshop-hero-section">
        <div class="workshop-container">
            <!-- Poster Section di Top -->
            <div class="workshop-poster-section">
                <div class="workshop-poster-card">
                    <img src="{{ asset('images/Event Workshop.png') }}" alt="Parenting Workshop Poster"
                        class="workshop-poster-image">
                </div>
            </div>

            <!-- Content Section di Bawah Poster -->
            <div class="workshop-content-section">
                <div class="workshop-content">
                    <h1 class="workshop-title">Parenting Workshop - Bakat Anak Indonesia</h1>
                    <p class="workshop-subtitle">TAKUT SALAH ARAH?</p>
                    <p style="color: var(--workshop-text-dark); font-size: 1.1rem; font-weight: 600; margin-bottom: 20px;">
                        Begini Cara Dampingi Bakat Anak Sejak Dini</p>

                    <p class="workshop-description">
                        Sebagai orang tua, pernahkah Ayah Bunda merasa takut salah langkah dalam mendidik anak? Takut
                        terlewat kemas, takut tertukar memorgantkan, atau takut anak tumbuh tanpa arahan yang jelas?
                    </p>

                    <p class="workshop-description">
                        Tenang, Ayah Bunda tidak sendiri! Yuk temukan jawabannya di webinar parenting ini dan belajar
                        bersama cara mendampingi anak dengan tepat sejak dini.
                    </p>

                    <div class="workshop-info-grid">
                        <div class="workshop-info-card">
                            <h4>PEMATERI</h4>
                            <p>Mega Nurbaeni, S.E.</p>
                            <p style="font-size: 0.85rem; color: var(--workshop-gray-600);">Duta Belajar Indonesia</p>
                        </div>

                        <div class="workshop-info-card">
                            <h4>HARI/TANGGAL</h4>
                            <p>Jumat, 16 Agustus 2025</p>
                        </div>

                        <div class="workshop-info-card">
                            <h4>PUKUL</h4>
                            <p>10.00-11.30 WIB</p>
                        </div>

                        <div class="workshop-info-card">
                            <h4>TEMPAT</h4>
                            <p>Online via Zoom</p>
                        </div>
                    </div>

                    <div class="workshop-features">
                        <h3>Ikuti Parenting Workshop bersama:</h3>
                        <p style="margin-bottom: 15px;">Pemateri: Mega Nurbaeni, S.E.</p>
                        <p style="margin-bottom: 15px;">Duta Belajar Indonesia</p>
                        <p style="margin-bottom: 15px;">Hari/Tanggal: Jumat, 16 Agustus 2025</p>
                        <p style="margin-bottom: 15px;">Waktu: 10.00 - 11.30 WIB</p>
                        <p style="margin-bottom: 20px;">Tempat: Online via Zoom</p>

                        <h3>Cara Daftar</h3>
                        <ul>
                            <li>Klik tombol atau link di bawah ini</li>
                            <li>Isi data diri dengan benar</li>
                            <li>Setelah mengisi data akan masuk ke group whatsapp</li>
                        </ul>

                        <p style="margin-top: 20px; color: var(--workshop-gray-800);">
                            <strong>Info lebih lanjut:</strong><br>
                            Instagram: @bakat.anak.indonesia
                        </p>
                    </div>

                    <a href="#daftar" class="btn-workshop">Daftar Sekarang!</a>
                </div>
            </div>
        </div>
    </section>

@endsection
