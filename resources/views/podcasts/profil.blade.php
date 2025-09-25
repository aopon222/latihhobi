@extends('layout.app')

@section('title', 'Profil LatihHobi')

@section('content')
<style>
    :root {
        --biru: #04a6d6;
        --oren: #f9a51a;
        --putih: #fff;
        --hitam: #1a2330;
    }
    .profil-hero-bg {
        width: 100%;
        height: 80px;
        background: linear-gradient(90deg, var(--biru) 60%, var(--oren) 100%);
        border-radius: 0 0 40px 40px;
        position: relative;
        z-index: 1;
    }
    .profil-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px 0 16px;
        margin-top: 48px; /* Tambahkan margin-top agar konten turun */
        position: relative;
        z-index: 2;
    }
    .profil-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        margin-bottom: 32px;
        justify-content: center;
    }
    .profil-card {
        background: #f8fafc;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(4,166,214,.08);
        padding: 36px 32px 32px 32px;
        flex: 1 1 380px;
        min-width: 320px;
        max-width: 480px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profil-logo-img {
        width: 110px;
        margin-bottom: 12px;
        border-radius: 16px;
        background: var(--putih);
        box-shadow: 0 2px 8px rgba(4,166,214,.08);
        padding: 8px;
        object-fit: contain;
    }
    .profil-logo-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--biru);
        margin-bottom: 2px;
        text-align: center;
        letter-spacing: 1px;
    }
    .profil-logo-sub {
        font-size: 16px;
        color: var(--oren);
        font-weight: 600;
        margin-bottom: 18px;
        text-align: center;
    }
    .profil-logo-desc {
        font-size: 15px;
        color: var(--hitam);
        text-align: left;
        margin-bottom: 0;
        line-height: 1.6;
    }
    .profil-card-visi {
        background: #f8fafc;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(4,166,214,.08);
        padding: 36px 32px 32px 32px;
        flex: 1 1 380px;
        min-width: 320px;
        max-width: 480px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .profil-visi-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--biru);
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .profil-visi-desc {
        font-size: 15px;
        color: var(--hitam);
        margin-bottom: 18px;
    }
    .profil-misi-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--oren);
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .profil-misi-list {
        font-size: 15px;
        color: var(--hitam);
        margin: 0 0 0 18px;
        padding: 0;
        list-style: disc;
        line-height: 1.7;
    }
    .profil-schools {
        margin-top: 32px;
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        align-items: flex-start;
        justify-content: flex-start;
    }
    .profil-schools-img {
        width: 100%;
        max-width: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(4,166,214,.06);
        background: #f8fafc;
        padding: 8px;
        object-fit: contain;
    }
    .profil-schools-logos {
        flex: 1 1 320px;
        min-width: 220px;
        background: #f8fafc;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(4,166,214,.04);
        padding: 18px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .profil-schools-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--biru);
        margin-bottom: 10px;
    }
    @media (max-width: 900px) {
        .profil-row { flex-direction: column; gap: 0;}
        .profil-card, .profil-card-visi { max-width: 100%; }
        .profil-schools { flex-direction: column; gap: 12px; }
        .profil-schools-img { width: 100%; }
        .profil-main { margin-top: 24px; padding: 32px 4px 0 4px; }
    }
</style>

<div class="profil-hero-bg"></div>
<div class="profil-main">
    <div class="profil-row">
        <div class="profil-card">
            <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="profil-logo-img">
            <div class="profil-logo-title">LatihHobi</div>
            <div class="profil-logo-sub">Pusat Bakat dan Hobi Indonesia</div>
            <div class="profil-logo-desc">
                Merupakan platform pengembangan bakat, yang membantu anak, orang tua dan sekolah untuk mengembangkan potensi kemampuan anak di bidangnya masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang kompeten. Lebih dari 60 sekolah di Jawa Barat yang telah bekerjasama.
            </div>
        </div>
        <div class="profil-card-visi">
            <div class="profil-visi-title">VISI</div>
            <div class="profil-visi-desc">
                Menjadi Platform Pengembangan hobi dan bakat anak yang Professional, Inspiratif, dan Kolaboratif secara Menyenangkan Nomor 1 di Indonesia
            </div>
            <div class="profil-misi-title">MISI</div>
            <ul class="profil-misi-list">
                <li>Menyediakan Bermacam Pendidikan Ekstrakurikuler yang menunjang kegiatan pengembangan hobi dan bakat anak</li>
                <li>Menyediakan Platform Ekstrakurikuler Satu Pintu bagi Sekolah</li>
                <li>Kolaborasi dengan berbagai lembaga pendidikan formal dan non formal lainnya</li>
                <li>Menyediakan pengajar dan staff kependidikan berkualitas serta senantiasa bertumbuh di bidangnya</li>
                <li>Membantu pengembangan Sosial dan Emosional anak dalam proses optimalisasi hobi dan bakat</li>
                <li>Menyediakan wadah prestasi dalam pengembangan hobi dan bakat</li>
            </ul>
        </div>
    </div>
    <div class="profil-schools">
        <!-- Removed the student image as requested -->
        <div class="profil-schools-logos" style="width: 100%;">
            <div class="profil-schools-title">Sekolah yang sudah bekerjasama</div>
            <img src="{{ asset('images/sekolah.svg') }}" alt="Logo Sekolah" style="width:100%; height: auto; max-width:none;">
        </div>
    </div>
</div>
@endsection