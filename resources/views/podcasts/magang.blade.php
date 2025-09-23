// filepath: [magang.blade.php](http://_vscodecontentref_/1)
@extends('layout.app')

@section('title', 'Program Magang LatihHobi')

@section('content')
<style>
    .magang-banner {
        width: 100%;
        height: 280px;
        background: #eaf6fb;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .magang-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
    }
    .magang-banner-text {
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
    .magang-banner-text h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: 1px;
    }
    .magang-banner-text p {
        font-size: 18px;
        font-weight: 500;
        max-width: 600px;
        margin-bottom: 0;
    }
    .magang-section {
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
    .magang-desc {
        font-size: 16px;
        color: #222;
        margin-bottom: 32px;
        margin-top: 8px;
    }
    .magang-icon {
        font-size: 38px;
        color: #04a6d6;
        margin-bottom: 12px;
        display: block;
    }
    .magang-accordion {
        margin-top: 18px;
        border: 1px solid #e8eef4;
        border-radius: 8px;
        background: #f5f7fa;
        overflow: hidden;
    }
    .magang-accordion-item {
        border-bottom: 1px solid #e8eef4;
    }
    .magang-accordion-item:last-child {
        border-bottom: none;
    }
    .magang-accordion-header {
        padding: 14px 18px;
        cursor: pointer;
        font-weight: 700;
        color: #0f3d5c;
        background: #f5f7fa;
        display: flex;
        align-items: center;
        font-size: 16px;
        border: none;
        outline: none;
        width: 100%;
        transition: background .2s;
    }
    .magang-accordion-header:hover {
        background: #eaf6fb;
    }
    .magang-accordion-content {
        padding: 16px 28px;
        background: #fff;
        color: #333;
        font-size: 15px;
        display: none;
    }
    .magang-accordion-item.active .magang-accordion-content {
        display: block;
    }
    .magang-accordion-header:before {
        content: '+';
        margin-right: 10px;
        font-size: 18px;
        color: #04a6d6;
        font-weight: bold;
    }
    .magang-accordion-item.active .magang-accordion-header:before {
        content: '−';
        color: #0f3d5c;
    }
    ul.magang-list {
        margin: 0 0 0 18px;
        padding: 0;
        list-style: disc;
    }
    @media (max-width: 900px) {
        .magang-section { padding: 24px 8px; }
        .magang-banner { height: 180px; }
        .magang-banner-text h1 { font-size: 22px; }
        .magang-banner-text p { font-size: 15px; }
    }
</style>

<div class="magang-banner">
    <img src="{{ asset('images/magang-banner.jpg') }}" alt="Latih Hobi Internship Banner">
    <div class="magang-banner-text">
        <h1>LATIH HOBI INTERNSHIP</h1>
        <p>
            "Di Latih Hobi, kami percaya bahwa setiap orang punya potensi untuk berkembang.<br>
            Temukan Karier di Balik Passion Anda."
        </p>
    </div>
</div>

<section class="magang-section">
    <div class="magang-desc">
        <strong>Program Magang <i>(Internship)</i> Latih Hobi</strong> merupakan Program Magang <i>(Internship)</i> yang diselenggarakan sebagai salah satu bentuk tanggung jawab sosial organisasi dengan memberikan kesempatan untuk berlatih bekerja kepada peserta Program Magang <i>(Internship)</i>.
    </div>
    <span class="magang-icon">💼</span>

    <div class="magang-accordion">
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">PERSYARATAN PESERTA MAGANG(INTERNSHIP)</button>
            <div class="magang-accordion-content">
                <ul class="magang-list">
                    <li>Mahasiswa/Siswa aktif atau Fresh Graduate</li>
                    <li>Memiliki minat di bidang yang relevan dengan posisi magang</li>
                    <li>Mampu bekerja dalam tim dan berkomunikasi dengan baik</li>
                    <li>Memiliki laptop sendiri</li>
                </ul>
            </div>
        </div>
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">KEWAJIBAN PESERTA MAGANG(INTERNSHIP)</button>
            <div class="magang-accordion-content">
                <ul class="magang-list">
                    <li>Mengikuti peraturan disiplin dan budaya kerja yang berlaku di Latih Hobi;</li>
                    <li>Mengikuti kegiatan magang setiap hari kerja (Senin – Jumat) mulai pukul 08.00 – 17.00;</li>
                    <li>Bagi siswi/mahasiswi wajib memakai kerudung ketika memasuki area kantor Latih Hobi.</li>
                    <li>Mengenakan pakaian rapi dan sepatu selama pelaksanaan Magang <i>(Internship)</i>;</li>
                </ul>
                <p style="margin-top:10px;">
                    Mengisi <b>logbook</b>, membuat laporan pelaksanaan Magang <i>(Internship)</i> dengan terlebih dahulu berdiskusi dengan pembimbing Magang <i>(Internship)</i>.
                </p>
            </div>
        </div>
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">HAK PESERTA MAGANG(INTERNSHIP)</button>
            <div class="magang-accordion-content">
                <ul class="magang-list">
                    <li>Mendapatkan pengalaman kerja nyata sesuai bidang magang</li>
                    <li>Mendapatkan sertifikat magang setelah selesai program</li>
                    <li>Mendapatkan bimbingan dari mentor Latih Hobi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.magang-accordion-header').forEach(function(header) {
        header.addEventListener('click', function() {
            var item = header.parentElement;
            var allItems = document.querySelectorAll('.magang-accordion-item');
            allItems.forEach(function(i) {
                if(i !== item) i.classList.remove('active');
            });
            item.classList.toggle('active');
        });
    });
</script>
@endsection