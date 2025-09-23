@extends('layout.app')

@section('title', 'Bootcamp & Workshop - LatihHobi')

@section('content')
    <!-- Hero Section -->
    <section class="bootcamp-hero">
        <div class="bootcamp-hero-content">
            <h1>Bootcamp & Workshop</h1>
            <p>
                Bootcamp & Workshop LatihHobi adalah program kelas intensif berbentuk webinar yang dirancang untuk orang tua, guru, dan anak dalam rangka memahami dan mengembangkan bakat anak secara lebih mendalam. Program ini menghadirkan materi aplikatif, narasumber ahli, sesi interaktif, hingga studi kasus nyata seputar potensi dan minat anak.
            </p>
        </div>
    </section>

    <!-- Event List -->
    <section class="bootcamp-section">
        <div class="bootcamp-container">
            <h2>Daftar Bootcamp & Workshop</h2>
            <div class="bootcamp-grid">
                <!-- Event 1 -->
                <div class="bootcamp-card">
                    <div class="bootcamp-badge open">REGISTRATION NOW</div>
                    <h3>Parenting Workshop</h3>
                    <div class="bootcamp-date">
                        <span>Jumat, 15 Agustus 2025</span> &bull; <span>10.00-11.30 WIB</span>
                    </div>
                    <div class="bootcamp-desc">Takut Salah Arah? Begini Cara Dampingi Bakat Anak Sejak Dini</div>
                    <a href="/register-parenting-workshop" class="btn-bootcamp">Daftar Sekarang</a>
                </div>
                <!-- Event 2 -->
                <div class="bootcamp-card coming-soon">
                    <div class="bootcamp-badge soon">COMING SOON</div>
                    <h3>Parenting Anak di Era Digitalisasi</h3>
                    <div class="bootcamp-date">
                        <span>Kelas Webinar Bersama</span>
                    </div>
                    <div class="bootcamp-desc">Membekali orang tua dengan wawasan parenting era digital.</div>
                    <button class="btn-bootcamp" disabled>Segera Hadir</button>
                </div>
                <!-- Event 3 -->
                <div class="bootcamp-card coming-soon">
                    <div class="bootcamp-badge soon">COMING SOON</div>
                    <h3>To Be A Great Teacher for Kids</h3>
                    <div class="bootcamp-date">
                        <span>Kelas Bootcamp Online</span>
                    </div>
                    <div class="bootcamp-desc">Kelas intensif untuk para guru dan mentor kreatif.</div>
                    <button class="btn-bootcamp" disabled>Segera Hadir</button>
                </div>
            </div>
        </div>
    </section>

    <style>
        .bootcamp-hero {
            background: linear-gradient(120deg, #04a6d6 0%, #4fd1c5 100%);
            color: #fff;
            padding: 56px 0 40px 0;
            text-align: center;
        }
        .bootcamp-hero-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 14px;
        }
        .bootcamp-hero-content p {
            font-size: 1.25rem;
            margin: 0 auto;
            max-width: 620px;
        }
        .bootcamp-section {
            padding: 48px 0 32px 0;
            max-width: 1000px;
            margin: 0 auto;
        }
        .bootcamp-section h2 {
            color: #04a6d6;
            margin-bottom: 32px;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
        }
        .bootcamp-grid {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .bootcamp-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 28px 22px 32px 22px;
            flex: 1 1 300px;
            max-width: 330px;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .bootcamp-badge {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            background: #04a6d6;
            color: #fff;
            font-size: 0.95rem;
            padding: 6px 20px;
            border-radius: 20px;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        }
        .bootcamp-badge.soon {
            background: #fbbf24;
            color: #fff;
        }
        .bootcamp-badge.open {
            background: #10b981;
            color: #fff;
        }
        .bootcamp-card.coming-soon {
            opacity: 0.7;
        }
        .bootcamp-card h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #04a6d6;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
        }
        .bootcamp-date {
            color: #4fd1c5;
            font-size: 1rem;
            margin-bottom: 10px;
            text-align: center;
        }
        .bootcamp-desc {
            color: #444;
            font-size: 1.05rem;
            margin-bottom: 18px;
            text-align: center;
        }
        .btn-bootcamp {
            background: #04a6d6;
            color: #fff;
            padding: 10px 30px;
            border-radius: 25px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            font-size: 1rem;
            transition: background 0.2s, color 0.2s;
            margin-top: 10px;
            cursor: pointer;
        }
        .btn-bootcamp:hover:enabled {
            background: #0284c7;
            color: #fff;
        }
        .btn-bootcamp:disabled {
            background: #bdbdbd;
            color: #fff;
            cursor: not-allowed;
        }

        @media (max-width: 900px) {
            .bootcamp-grid {
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }
            .bootcamp-section {
                padding: 32px 8px 24px 8px;
            }
        }
        @media (max-width: 600px) {
            .bootcamp-hero {
                padding: 32px 0 24px 0;
            }
            .bootcamp-hero-content h1 {
                font-size: 2rem;
            }
            .bootcamp-section h2 {
                font-size: 1.3rem;
            }
            .bootcamp-card {
                padding: 18px 6px 24px 6px;
            }
        }
    </style>
@endsection
