@extends('layout.app')

@section('title', 'HOLIDAY FUN CLASS 2025')

@section('content')
<style>
    .holiday-fun-main {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 16px;
    }

    .holiday-title {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 32px;
        color: #222;
    }

    .holiday-fun-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        align-items: flex-start;
    }

    .holiday-fun-col-img {
        flex: 1 1 440px;
        display: flex;
        justify-content: center;
    }

    .holiday-fun-img {
        width: 100%;
        max-width: 480px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }

    .holiday-fun-col-desc {
        flex: 1 1 500px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        justify-content: center;
    }

    .holiday-fun-desc {
        font-size: 16px;
        color: #444;
        line-height: 1.6;
    }

    .holiday-fun-btn {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 12px;
        max-width: 220px;
    }

    .btn-holiday {
        background: #22c55e;
        color: #fff;
        font-weight: 700;
        border-radius: 6px;
        padding: 12px 20px;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s;
    }
    .btn-holiday:hover { background: #16a34a; }

    .btn-info {
        background: #3b82f6;
        color: #fff;
        font-weight: 700;
        border-radius: 6px;
        padding: 12px 20px;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s;
    }
    .btn-info:hover { background: #2563eb; }

    .btn-lokasi {
        background: #f59e0b;
        color: #fff;
        font-weight: 700;
        border-radius: 6px;
        padding: 12px 20px;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s;
    }
    .btn-lokasi:hover { background: #d97706; }

    @media (max-width: 900px) {
        .holiday-fun-row {
            flex-direction: column;
            text-align: center;
        }
        .holiday-fun-col-desc {
            align-items: center;
        }
        .holiday-fun-btn {
            width: 100%;
            max-width: 100%;
        }
    }
</style>

<div class="holiday-fun-main">
    <div class="holiday-title">HOLIDAY FUN CLASS 2025</div>

    <div class="holiday-fun-row">
        <div class="holiday-fun-col-img">
            <img src="{{ asset('images/BANNER HFC.svg') }}" alt="Holiday Fun Class 2025" class="holiday-fun-img">
        </div>

        <div class="holiday-fun-col-desc">
            <div class="holiday-fun-desc">
                Memilih aktifitas saat liburan untuk anak emang ga mudah, harus menyenangkan, edukatif, aman dan bikin bunda ga repot.
                Apa lagi kalo minat anak berbeda-beda. Kali ini Latih Hobi hadir dengan program HOLIDAY FUN CLASS,
                di sini anak bisa mengeksplor bakat dari hobinya.
                Bunda bisa pilih kelas robotik, panahan, komik, serta film dan konten kreator, tinggal sesuai dengan minat anak.
            </div>

            <div class="holiday-fun-btn">
                <a href="https://docs.google.com/forms/u/1/d/e/1FAIpQLSehm1885Qn9yZkuJiavddyRtp12ndsi_n1Hev9sakQVG4ZY1A/viewform?usp=send_form" target="_blank" class="btn-holiday">
                    <span>📝</span> DAFTAR SEKARANG
                </a>
                <a href="https://latithobi.id/holiday-fun-class/" target="_blank" class="btn-info">
                    <span>ℹ️</span> MORE INFO
                </a>
                <a href="https://goo.gl/maps/8QwK7gQKkF2wQZbJ7" target="_blank" class="btn-lokasi">
                    <span>📍</span> LOKASI
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
