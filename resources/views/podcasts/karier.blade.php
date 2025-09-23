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
        margin: 0 auto;
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
    .karier-table {
        width: 100%;
        margin-bottom: 32px;
        border-collapse: collapse;
    }
    .karier-row {
        display: flex;
        flex-wrap: wrap;
        border-bottom: 1px solid #e8eef4;
        padding: 24px 0;
        align-items: flex-start;
    }
    .karier-row:last-child {
        border-bottom: none;
    }
    .karier-col {
        flex: 1 1 320px;
        min-width: 320px;
        padding: 0 16px;
    }
    .karier-pos-title {
        font-weight: 700;
        color: #04a6d6;
        font-size: 18px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .karier-pos-type {
        margin-bottom: 12px;
        color: #333;
        font-size: 15px;
        padding-left: 24px;
    }
    .karier-req-title {
        font-weight: 700;
        color: #0f3d5c;
        font-size: 16px;
        margin-bottom: 8px;
    }
    .karier-req-list {
        margin: 0;
        padding-left: 20px;
        color: #55657d;
        font-size: 15px;
    }
    .karier-backoffice {
        display: flex;
        flex-wrap: wrap;
        border-top: 1px solid #e8eef4;
        padding-top: 24px;
        margin-top: 24px;
        gap: 24px;
    }
    .karier-backoffice-col {
        flex: 1 1 320px;
        min-width: 320px;
        padding: 0 16px;
    }
    .karier-backoffice-title {
        font-weight: 700;
        color: #04a6d6;
        font-size: 18px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .karier-backoffice-list {
        margin: 0;
        padding-left: 20px;
        color: #55657d;
        font-size: 15px;
    }
    @media (max-width: 900px) {
        .karier-row, .karier-backoffice { flex-direction: column; }
        .karier-col, .karier-backoffice-col { min-width: 0; padding: 0; }
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

    <div class="karier-table">
        <div class="karier-row">
            <div class="karier-col">
                <div class="karier-pos-title">🧑‍🔬 Tutor Robotik :</div>
                <div class="karier-pos-type">
                    <ul style="margin:0; padding-left:18px;">
                        <li>Fulltime</li>
                        <li>Freelance</li>
                    </ul>
                </div>
            </div>
            <div class="karier-col">
                <div class="karier-req-title">Persyaratan :</div>
                <ul class="karier-req-list">
                    <li>Min. Pendidikan S1 Teknik Elektro, Pendidikan Teknik Elektro</li>
                    <li>Muslim/Muslimah</li>
                    <li>Paham elektronika dasar</li>
                    <li>Memiliki laptop dan kendaraan bermotor</li>
                </ul>
            </div>
        </div>
        <div class="karier-row">
            <div class="karier-col">
                <div class="karier-pos-title">🎬 Tutor Film dan Konten Kreator :</div>
                <div class="karier-pos-type">
                    <ul style="margin:0; padding-left:18px;">
                        <li>Fulltime</li>
                        <li>Freelance</li>
                    </ul>
                </div>
            </div>
            <div class="karier-col">
                <div class="karier-req-title">Persyaratan :</div>
                <ul class="karier-req-list">
                    <li>Min. Pendidikan S1 Teknologi Pendidikan, Pendidikan Film, Multimedia</li>
                    <li>Muslim/Muslimah</li>
                    <li>Paham dasar perfilman</li>
                    <li>Memiliki laptop dan kendaraan bermotor</li>
                </ul>
            </div>
        </div>
        <div class="karier-row">
            <div class="karier-col">
                <div class="karier-pos-title">🏹 Tutor Panahan :</div>
                <div class="karier-pos-type">
                    <ul style="margin:0; padding-left:18px;">
                        <li>Fulltime</li>
                        <li>Freelance</li>
                    </ul>
                </div>
            </div>
            <div class="karier-col">
                <div class="karier-req-title">Persyaratan :</div>
                <ul class="karier-req-list">
                    <li>Min. Pendidikan S1 semua jurusan</li>
                    <li>Muslim/Muslimah</li>
                    <li>Paham dasar panahan</li>
                    <li>Memiliki laptop dan kendaraan bermotor</li>
                </ul>
            </div>
        </div>
        <div class="karier-row">
            <div class="karier-col">
                <div class="karier-pos-title">🎨 Tutor Komik :</div>
                <div class="karier-pos-type">
                    <ul style="margin:0; padding-left:18px;">
                        <li>Fulltime</li>
                        <li>Freelance</li>
                    </ul>
                </div>
            </div>
            <div class="karier-col">
                <div class="karier-req-title">Persyaratan :</div>
                <ul class="karier-req-list">
                    <li>Min. Pendidikan S1 Pendidikan Seni Rupa, Design Grafis, Design Komunikasi Visual</li>
                    <li>Muslim/Muslimah</li>
                    <li>Paham Teknik Ilustrator</li>
                    <li>Memiliki laptop dan kendaraan bermotor</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="karier-backoffice">
        <div class="karier-backoffice-col">
            <div class="karier-backoffice-title">🗂️ BACK OFFICE</div>
        </div>
        <div class="karier-backoffice-col">
            <ul class="karier-backoffice-list">
                <li>Admin Keuangan</li>
                <li>Multimedia</li>
                <li>HRD</li>
            </ul>
        </div>
    </div>
</section>
@endsection