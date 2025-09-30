@extends('layout.app')

@section('title', 'Latih Hobi Karier')

@section('content')
<style>
    .karier-banner {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
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
        filter: brightness(0.6);
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
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .karier-banner-text p {
        font-size: 18px;
        font-weight: 500;
        max-width: 600px;
        margin-bottom: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .karier-section {
        max-width: 1100px;
        margin: 120px auto 0 auto;
        background: #fefefe;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        padding: 40px 32px;
        margin-top: -40px;
        position: relative;
        z-index: 2;
        border: 1px solid #e8f4f8;
    }

    .karier-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e3a8a;
        text-align: center;
        margin-bottom: 32px;
        padding: 16px 0;
        border-radius: 12px;
        background: linear-gradient(135deg, #fef3e2 0%, #e0f2fe 100%);
        border: 2px solid #fed7aa;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 2px 8px rgba(251, 146, 60, 0.15);
    }

    .karier-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 28px;
        margin-bottom: 40px;
    }

    .karier-card {
        background: linear-gradient(135deg, #fefbf3 0%, #f0f9ff 100%);
        border-radius: 16px;
        box-shadow: 0 3px 12px rgba(0,0,0,.08);
        padding: 28px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        gap: 14px;
        border: 2px solid #fed7aa;
        position: relative;
        overflow: hidden;
    }

    .karier-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #fb923c 0%, #0ea5e9 100%);
    }

    .karier-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,.15);
        border-color: #fb923c;
        background: linear-gradient(135deg, #fff7ed 0%, #e0f2fe 100%);
    }

    .karier-pos-title {
        font-weight: 700;
        color: #1e40af;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 4px;
    }

    .karier-pos-type {
        font-size: 15px;
        color: #f97316;
        margin-left: 32px;
        font-weight: 600;
        background: #fed7aa;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .karier-req-title {
        font-weight: 700;
        color: #0c4a6e;
        font-size: 16px;
        margin-top: 16px;
        margin-bottom: 8px;
    }

    .karier-req-list {
        margin: 0;
        padding-left: 20px;
        color: #475569;
        font-size: 15px;
        line-height: 1.6;
    }

    .karier-req-list li {
        margin-bottom: 6px;
        position: relative;
    }

    .karier-req-list li::marker {
        color: #fb923c;
    }

    .karier-backoffice {
        margin-top: 40px;
        border-top: 2px solid #fed7aa;
        padding-top: 32px;
        background: linear-gradient(135deg, #fefbf3 0%, #f0f9ff 100%);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 2px 8px rgba(251, 146, 60, 0.1);
    }

    .karier-backoffice-title {
        font-weight: 700;
        color: #1e40af;
        font-size: 22px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .karier-backoffice-list {
        margin: 0;
        padding-left: 20px;
        color: #475569;
        font-size: 16px;
        line-height: 1.8;
    }

    .karier-backoffice-list li {
        margin-bottom: 8px;
        font-weight: 500;
    }

    .karier-backoffice-list li::marker {
        color: #0ea5e9;
    }

    .btn-daftar {
        display: block;
        width: 240px;
        margin: 40px auto 0;
        padding: 14px 0;
        background: linear-gradient(135deg, #fb923c 0%, #0ea5e9 100%);
        color: white;
        font-weight: 700;
        font-size: 16px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(251, 146, 60, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-daftar:hover {
        background: linear-gradient(135deg, #ea580c 0%, #0284c7 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251, 146, 60, 0.4);
    }

    @media (max-width: 900px) {
        .karier-cards {
            grid-template-columns: 1fr;
        }
        .karier-section {
            margin: 80px 16px 0;
            padding: 24px 20px;
        }
        .karier-banner-text h1 {
            font-size: 28px;
        }
        .karier-banner-text p {
            font-size: 16px;
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
        <span>🚀</span> PELUANG KARIER LATIH HOBI
    </div>

    <div class="karier-cards">
        <div class="karier-card">
            <div class="karier-pos-title">🧑‍🔬 Tutor Robotik</div>
            <div class="karier-pos-type">Fulltime • Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Minimal Pendidikan S1 Teknik Elektro atau Pendidikan Teknik Elektro</li>
                <li>Muslim/Muslimah dengan akhlak yang baik</li>
                <li>Memahami elektronika dasar dan pemrograman</li>
                <li>Berpengalaman dalam bidang robotika (diutamakan)</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
                <li>Mampu berkomunikasi dengan baik kepada anak-anak</li>
            </ul>
        </div>

        <div class="karier-card">
            <div class="karier-pos-title">🎬 Tutor Film dan Konten Kreator</div>
            <div class="karier-pos-type">Fulltime • Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Minimal Pendidikan S1 Teknologi Pendidikan, Film, atau Multimedia</li>
                <li>Muslim/Muslimah dengan akhlak yang baik</li>
                <li>Memahami dasar perfilman dan editing video</li>
                <li>Kreatif dalam mengembangkan konten edukatif</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
                <li>Portfolio karya film atau konten digital</li>
            </ul>
        </div>

        <div class="karier-card">
            <div class="karier-pos-title">🏹 Tutor Panahan</div>
            <div class="karier-pos-type">Fulltime • Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Minimal Pendidikan S1 semua jurusan</li>
                <li>Muslim/Muslimah dengan akhlak yang baik</li>
                <li>Memahami teknik dasar panahan dan keselamatan</li>
                <li>Berpengalaman dalam olahraga panahan</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
                <li>Sabar dan teliti dalam mengajar</li>
            </ul>
        </div>

        <div class="karier-card">
            <div class="karier-pos-title">🎨 Tutor Komik</div>
            <div class="karier-pos-type">Fulltime • Freelance</div>
            <div class="karier-req-title">Persyaratan :</div>
            <ul class="karier-req-list">
                <li>Minimal Pendidikan S1 Seni Rupa, Desain Grafis, atau DKV</li>
                <li>Muslim/Muslimah dengan akhlak yang baik</li>
                <li>Menguasai teknik ilustrasi dan storytelling</li>
                <li>Kreatif dalam mengembangkan karakter dan cerita</li>
                <li>Memiliki laptop dan kendaraan bermotor</li>
                <li>Portfolio karya komik atau ilustrasi</li>
            </ul>
        </div>
    </div>

    <div class="karier-backoffice">
        <div class="karier-backoffice-title">🗂️ POSISI BACK OFFICE</div>
        <ul class="karier-backoffice-list">
            <li><strong>Admin Keuangan</strong> - Mengelola administrasi keuangan dan pembukuan</li>
            <li><strong>Multimedia</strong> - Membuat konten visual dan materi pembelajaran digital</li>
            <li><strong>HRD</strong> - Mengelola sumber daya manusia dan pengembangan tim</li>
        </ul>
    </div>

    <a href="#" class="btn-daftar" target="_blank" rel="noopener noreferrer">Daftar Sekarang</a>
</section>
@endsection