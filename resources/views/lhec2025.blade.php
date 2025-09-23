@extends('layout.app')

@section('title', 'LHEC 2025 - LatihHobi Expo dan Competition')

@section('content')
    <!-- Hero Section -->
    <section class="lhec-header">
        <div class="lhec-hero-content fade-in">
            <h1>LHEC 2025</h1>
            <p>LatihHobi Expo dan Competition 2025</p>
            <a href="#lhec-registration" class="btn-start">Daftar Sekarang</a>
        </div>
    </section>

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
                    <li>14:00 - 16:00: Penutupan & Pengumuman Pemenang</li>
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
                <div class="speaker-name">Dr. Andi Setiawan</div>
                <div class="speaker-role">Ahli Robotik & Teknologi Pendidikan</div>
            </div>
            <div class="speaker">
                <img src="{{ asset('images/speaker2.png') }}" alt="Ms. Rina Sari" class="speaker-img">
                <div class="speaker-name">Ms. Rina Sari</div>
                <div class="speaker-role">Penggiat Konten Kreator & Media Sosial</div>
            </div>
            <div class="speaker">
                <img src="{{ asset('images/speaker3.png') }}" alt="Mr. Budi Santoso" class="speaker-img">
                <div class="speaker-name">Mr. Budi Santoso</div>
                <div class="speaker-role">Mentor Desain Grafis & Kreatif</div>
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
            padding: 56px 0 40px 0;
            text-align: center;
        }
        .lhec-hero-content {
            margin-top: 24px;
        }
        .lhec-hero-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        .lhec-hero-content p {
            font-size: 1.25rem;
            margin-bottom: 24px;
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
            display: inline-block;
            margin-top: 8px;
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
            font-weight: 700;
        }
        .lhec-section p {
            font-size: 1.08rem;
            color: #333;
            margin-bottom: 0;
        }
        .lhec-schedule-list {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            margin-top: 12px;
        }
        .lhec-schedule-day {
            background: #fff3e0;
            border-radius: 12px;
            padding: 24px 28px;
            flex: 1 1 300px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            min-width: 260px;
        }
        .lhec-schedule-day h3 {
            margin-bottom: 10px;
            color: #ff9800;
            font-size: 1.15rem;
            font-weight: 700;
        }
        .lhec-schedule-day ul {
            padding-left: 18px;
            margin: 0;
            color: #444;
            font-size: 1rem;
        }
        .speaker-list {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 18px;
        }
        .speaker {
            background: #fff;
            border-radius: 12px;
            padding: 24px 18px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            flex: 1 1 220px;
            max-width: 240px;
            min-width: 180px;
        }
        .speaker-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            background: #ffe0b2;
            border: 2px solid #ff9800;
        }
        .speaker-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 4px;
            color: #f44336;
        }
        .speaker-role {
            font-size: 0.98rem;
            color: #444;
        }
        .lhec-registration {
            text-align: center;
        }
        .lhec-registration p {
            margin-bottom: 18px;
        }
        @media (max-width: 900px) {
            .lhec-schedule-list, .speaker-list {
                flex-direction: column;
                gap: 18px;
            }
            .lhec-section {
                padding: 32px 8px 24px 8px;
            }
        }
        @media (max-width: 600px) {
            .lhec-header {
                padding: 32px 0 24px 0;
            }
            .lhec-hero-content h1 {
                font-size: 2rem;
            }
            .lhec-section h2 {
                font-size: 1.3rem;
            }
            .lhec-schedule-day {
                padding: 18px 10px;
            }
            .speaker {
                padding: 16px 6px;
            }
        }
    </style>
@endsection
