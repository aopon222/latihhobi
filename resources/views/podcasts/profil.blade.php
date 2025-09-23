@extends('layout.app')

@section('title', 'Profil LatihHobi')

@section('content')
<style>
    .profil-main {
        max-width: 1100px;
        margin: 0 auto;
        padding: 32px 16px 0 16px;
    }
    .profil-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        margin-bottom: 32px;
    }
    .profil-col-logo {
        flex: 1 1 320px;
        max-width: 340px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .profil-logo-img {
        width: 220px;
        margin-bottom: 12px;
    }
    .profil-logo-title {
        font-size: 32px;
        font-weight: 800;
        color: #04a6d6;
        margin-bottom: 2px;
        text-align: center;
        letter-spacing: 1px;
    }
    .profil-logo-sub {
        font-size: 18px;
        color: #f9a51a;
        font-weight: 600;
        margin-bottom: 18px;
        text-align: center;
    }
    .profil-logo-desc {
        font-size: 15px;
        color: #222;
        text-align: left;
        margin-bottom: 0;
    }
    .profil-col-visi-misi {
        flex: 2 1 400px;
        max-width: 600px;
        background: #f5f7fa;
        border-radius: 12px;
        padding: 24px 24px 24px 32px;
        box-sizing: border-box;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
    .profil-visi-title {
        font-size: 22px;
        font-weight: 700;
        color: #0f3d5c;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .profil-visi-desc {
        font-size: 15px;
        color: #222;
        margin-bottom: 18px;
    }
    .profil-misi-title {
        font-size: 20px;
        font-weight: 700;
        color: #04a6d6;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .profil-misi-list {
        font-size: 15px;
        color: #222;
        margin: 0 0 0 18px;
        padding: 0;
        list-style: disc;
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
        width: 220px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
    }
    .profil-schools-logos {
        flex: 1 1 320px;
        min-width: 220px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
        padding: 18px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .profil-schools-title {
        font-size: 16px;
        font-weight: 700;
        color: #0f3d5c;
        margin-bottom: 10px;
    }
    @media (max-width: 900px) {
        .profil-row { flex-direction: column; gap: 0; }
        .profil-col-logo, .profil-col-visi-misi { max-width: 100%; }
        .profil-schools { flex-direction: column; gap: 12px; }
        .profil-schools-img { width: 100%; }
    }
</style>

<div class="profil-main">
    <div class="profil-row">
        <div class="profil-col-logo">
            <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="profil-logo-img">
            <div class="profil-logo-title">LatihHobi</div>
            <div class="profil-logo-sub">Pusat Bakat dan Hobi Indonesia</div>
            <div class="profil-logo-desc">
                Merupakan platform pengembangan bakat, yang membantu anak, orang tua dan sekolah untuk mengembangkan potensi kemampuan anak di bidangnya masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang kompeten. Lebih dari 60 sekolah di Jawa Barat yang telah bekerjasama.
            </div>
        </div>
        <div class="profil-col-visi-misi">
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
        <img src="{{ asset('images/profil-student.jpg') }}" alt="Student" class="profil-schools-img">
        <div class="profil-schools-logos">
            <div class="profil-schools-title">Sekolah yang sudah bekerjasama</div>
            <img src="{{ asset('images/profil-schools.png') }}" alt="Logo Sekolah" style="width:100%;max-width:420px;">
        </div>
    </div>
</div>
@endsection