@extends('layout.app')

@section('title', 'HOLIDAY FUN CLASS 2025')

@section('content')
<style>
    .holiday-fun-main {
        max-width: 1100px;
        margin: 0 auto;
        padding: 32px 16px 0 16px;
    }
    .holiday-fun-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        margin-bottom: 32px;
        align-items: flex-start;
    }
    .holiday-fun-col-img {
        flex: 1 1 340px;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .holiday-fun-img {
        width: 100%;
        max-width: 370px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        margin-bottom: 18px;
    }
    .holiday-fun-col-desc {
        flex: 2 1 400px;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .holiday-fun-desc {
        font-size: 16px;
        color: #222;
        margin-bottom: 0;
    }
    .holiday-fun-btn {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 12px;
    }
    .btn-holiday {
        background: #22c55e;
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
        box-shadow: 0 2px 8px rgba(34,197,94,.08);
    }
    .btn-holiday:hover {
        background: #16a34a;
    }
    .btn-lokasi {
        background: #f9a51a;
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
        box-shadow: 0 2px 8px rgba(249,165,26,.08);
    }
    .btn-lokasi:hover {
        background: #d48806;
    }
    @media (max-width: 900px) {
        .holiday-fun-row { flex-direction: column; gap: 0; }
        .holiday-fun-col-img, .holiday-fun-col-desc { max-width: 100%; }
        .holiday-fun-img { max-width: 100%; }
    }
</style>

<div class="holiday-fun-main">
    <div class="holiday-fun-row">
        <div class="holiday-fun-col-img">
            <img src="{{ asset('images/holiday-fun-class-2025.jpg') }}" alt="Holiday Fun Class 2025" class="holiday-fun-img">
        </div>
        <div class="holiday-fun-col-desc">
            <div class="holiday-fun-desc">
                Memilih aktifitas saat liburan untuk anak emang ga mudah, harus menyenangkan, edukatif, aman dan bikin bunda ga repot. Apa lagi kalo minat anak berbeda-beda. Kali ini Latih Hobi hadir dengan program HOLIDAY FUN CLASS, di sini anak bisa mengeksplor bakat dari hobinya. Bunda bisa pilih kelas robotik, panahan, komik, serta film dan konten kreator, tinggal sesuai dengan minat anak.
            </div>
            <div class="holiday-fun-btn">
                <a href="https://docs.google.com/forms/u/1/d/e/1FAIpQLSehm1885Qn9yZkuJiavddyRtp12ndsi_n1Hev9sakQVG4ZY1A/viewform?usp=send_form" target="_blank" class="btn-holiday">
                    <span>📝</span> DAFTAR SEKARANG
                </a>
                <a href="https://goo.gl/maps/8QwK7gQKkF2wQZbJ7" target="_blank" class="btn-lokasi">
                    <span>📍</span> LOKASI
                </a>
            </div>
        </div>
    </div>
</div>
@endsection