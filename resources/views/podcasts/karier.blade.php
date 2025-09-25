 @extends('layout.app')

@section('title', 'Latih Hobi Karier')

@section('content')
<style>
    .karier-banner {
        width: 100%;
        height: 280px;
        background: #f5f7fa;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .karier-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
    }
    .karier-banner-text {
        position: absolute;
        left: 0; right: 0; top: 0; bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        z-index: 2;
        text-align: center;
    }
    .karier-banner-text h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: 1px;
    }
    .karier-banner-text p {
        font-size: 18px;
        font-weight: 500;
        max-width: 600px;
        margin-bottom: 0;
    }
.karier-section {
        max-width: 1100px;
        margin: 120px auto 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
        padding: 32px 24px;
        margin-top: -40px;
        position: relative;
        z-index: 2;
    }
    .karier-title {
        font-size: 22px;
        font-weight: 700;
        color: #0f3d5c;
        text-align: center;
        margin-bottom: 24px;
        padding: 12px 0;
        border-radius: 8px;
        background: #f5f7fa;
        border: 1px solid #e8eef4;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .karier-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
.karier-card {
        background: #f9fafb;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
        padding: 24px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        gap: 12px;
        border: 1px solid #d1d5db;
    }
    .karier-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,.12);
        border-color: #3b82f6;
        background-color: #e0e7ff;
    }
.karier-pos-title {
        font-weight: 700;
        color: #2563eb;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
.karier-pos-type {
        font-size: 15px;
        color: #4b5563;
        margin-left: 24px;
    }
.karier-req-title {
        font-weight: 700;
        color: #1e40af;
        font-size: 16px;
        margin-top: 12px;
    }
.karier-req-list {
        margin: 0;
        padding-left: 20px;
        color: #6b7280;
        font-size: 15px;
    }
.karier-backoffice {
        margin-top: 32px;
        border-top: 1px solid #d1d5db;
        padding-top: 24px;
    }
.karier-backoffice-title {
        font-weight: 700;
        color: #2563eb;
        font-size: 20px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
.karier-backoffice-list {
        margin: 0;
        padding-left: 20px;
        color: #6b7280;
        font-size: 15px;
    }
    .btn-daftar {
        display: block;
        width: 220px;
        margin: 32px auto 0;
        padding: 12px 0;
        background-color: #04a6d6;
        color: white;
        font-weight: 700;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .btn-daftar:hover {
        background-color: #037aab;
    }
    @media (max-width: 900px) {
        .karier-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="karier-banner">
    <img src="{{ asset('images/karier-banner.jpg') }}" alt="Latih Hobi Karier Banner">
    <div class="karier-banner-text">
        <h1>LATIH HOBI KARIER</h1>
        <p>
            "Di Latih Hobi, kami percaya bahwa setiap orang punya potensi untuk berkembang. Bergabunglah bersama kami dan jadilah bagian dari tim yang membantu anak-anak menemukan bakat serta membangun masa depan mereka."
        </p>
    </div>
</div>

<section class="karier-section">
    <div class="karier-title">
        <span>🚀</span> LATIH HOBI KARIER
    </div>

    <div class="karier-cards">
        <div class="karier-card">
            <div class="karier-pos-title">🧑‍🔬 Tutor Robotik :</div>
            <div class="karier-pos-type">Fulltime, Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Min. Pendidikan S1 Teknik Elektro, Pendidikan Teknik Elektro</li>
                <li>Muslim/Muslimah</li>
                <li>Paham elektronika dasar</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
            </ul>
        </div>
        <div class="karier-card">
            <div class="karier-pos-title">🎬 Tutor Film dan Konten Kreator :</div>
            <div class="karier-pos-type">Fulltime, Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Min. Pendidikan S1 Teknologi Pendidikan, Pendidikan Film, Multimedia</li>
                <li>Muslim/Muslimah</li>
                <li>Paham dasar perfilman</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
            </ul>
        </div>
        <div class="karier-card">
            <div class="karier-pos-title">🏹 Tutor Panahan :</div>
            <div class="karier-pos-type">Fulltime, Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Min. Pendidikan S1 semua jurusan</li>
                <li>Muslim/Muslimah</li>
                <li>Paham dasar panahan</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
            </ul>
        </div>
        <div class="karier-card">
            <div class="karier-pos-title">🎨 Tutor Komik :</div>
            <div class="karier-pos-type">Fulltime, Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Min. Pendidikan S1 Pendidikan Seni Rupa, Design Grafis, Design Komunikasi Visual</li>
                <li>Muslim/Muslimah</li>
                <li>Paham Teknik Ilustrator</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
            </ul>
        </div>
    </div>

    <div class="karier-backoffice">
        <div class="karier-backoffice-title">🗂️ BACK OFFICE</div>
        <ul class="karier-backoffice-list">
            <li>Admin Keuangan</li>
            <li>Multimedia</li>
            <li>HRD</li>
        </ul>
    </div>

    <a href="#" class="btn-daftar" target="_blank" rel="noopener noreferrer">Daftar Sekarang</a>
</section>
@endsection
