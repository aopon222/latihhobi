@extends('layout.app')

@section('content')
<style>
    /* Warna Palet */
    :root {
        --color-primary: #0D3B66; /* biru tua */
        --color-accent: #2563EB; /* biru muda */
        --color-gold: #FBBF24; /* kuning emas */
        --color-white: #FFFFFF;
        --color-bg-light: #F9FAFB;
        --color-text: #374151;
    }

    .banner {
        position: relative;
        width: 100%;
        height: 450px;
        overflow: hidden;
    }
    .banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .banner-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(13, 59, 102, 0.55); /* biru tua transparan */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: var(--color-white);
        text-align: center;
        padding: 20px;
    }
    .banner-overlay h1 {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 10px;
        color: var(--color-gold);
    }
    .banner-overlay p {
        font-size: 20px;
        margin-bottom: 20px;
        color: var(--color-white);
    }
    .banner-overlay a {
        background: var(--color-gold);
        color: var(--color-primary);
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: background 0.2s;
    }
    .banner-overlay a:hover {
        background: #f59e0b; /* kuning lebih gelap saat hover */
    }

    .section {
        padding: 60px 20px;
        max-width: 1100px;
        margin: auto;
    }
    .section h2 {
        font-size: 28px;
        color: var(--color-primary);
        margin-bottom: 20px;
        text-align: center;
    }
    .section p {
        text-align: center;
        max-width: 900px;
        margin: auto;
        line-height: 1.6;
        color: var(--color-text);
    }

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
        gap: 20px;
        margin-top: 30px;
    }
    .card {
        background: var(--color-bg-light);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card h3 {
        font-size: 20px;
        color: var(--color-primary);
        margin-bottom: 12px;
        text-align: center;
    }
    .card ul {
        padding-left: 20px;
        color: var(--color-text);
    }

    .speaker-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
        gap: 20px;
        margin-top: 30px;
    }
    .speaker {
        background: var(--color-white);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .speaker h3 {
        font-size: 20px;
        color: var(--color-primary);
        margin-top: 12px;
    }
    .speaker p {
        color: var(--color-text);
        margin-top: 6px;
    }
</style>

<!-- Banner -->
<div class="banner">
    <img src="{{ asset('images/FLYER LHEC.svg') }}" alt="Banner LHEC">
    <div class="banner-overlay">
        <h1>LHEC 2025</h1>
        <p>Latih Hobi Expo dan Competition 2025</p>
        <a href="#daftar">DAFTAR SEKARANG</a>
    </div>
</div>

<!-- Deskripsi -->
<div class="section" style="background: var(--color-white);">
    <h2>Deskripsi Acara</h2>
    <p>
        LHEC 2025 adalah acara tahunan yang diselenggarakan oleh Latih Hobi untuk mempertemukan para peserta, mentor,
        dan penggiat pendidikan. Acara ini bertujuan untuk mengembangkan bakat dan minat anak-anak dalam berbagai
        bidang melalui kompetisi dan workshop yang menarik.
    </p>
</div>

<!-- Jadwal -->
<div class="section" style="background: var(--color-bg-light);">
    <h2>Jadwal Acara</h2>
    <div class="schedule-grid">
        <div class="card">
            <h3>Hari Pertama: 15 Agustus 2025</h3>
            <ul>
                <li>09:00 ‒ 10:00: Pembukaan</li>
                <li>10:00 ‒ 12:00: Workshop Robotik</li>
                <li>13:00 ‒ 15:00: Kompetisi Coding</li>
            </ul>
        </div>
        <div class="card">
            <h3>Hari Kedua: 16 Agustus 2025</h3>
            <ul>
                <li>09:00 ‒ 11:00: Workshop Desain</li>
                <li>11:00 ‒ 13:00: Kompetisi Film & Konten Kreator</li>
                <li>14:00 ‒ 16:00: Penutupan & Pengumuman Pemenang</li>
            </ul>
        </div>
    </div>
</div>

<!-- Pembicara -->
<div class="section" style="background: var(--color-white);">
    <h2>Pembicara</h2>
    <div class="speaker-grid">
        <div class="speaker">
            <h3>Dr. Andi Setiawan</h3>
            <p>Ahli Robotik & Teknologi Pendidikan</p>
        </div>
        <div class="speaker">
            <h3>Ms. Rina Sari</h3>
            <p>Penggiat Konten Kreator & Media Sosial</p>
        </div>
        <div class="speaker">
            <h3>Mr. Budi Santoso</h3>
            <p>Mentor Desain Grafis & Kreatif</p>
        </div>
    </div>
</div>
@endsection
