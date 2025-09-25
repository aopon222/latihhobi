@extends('layout.app')

@section('title', 'Ekskul Pencak Silat - LatihHobi')

@section('content')
<style>
    :root {
        --biru: #04a6d6;
        --oren: #f9a51a;
        --putih: #fff;
        --hitam: #1a2330;
    }

    .ekskul-hero {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, var(--biru) 0%, #0284c7 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ekskul-hero-content {
        text-align: center;
        color: var(--putih);
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
    }

    .ekskul-hero h1 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 16px;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .ekskul-hero p {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 0;
        opacity: 0.95;
        line-height: 1.6;
    }

    .ekskul-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .ekskul-intro {
        text-align: center;
        margin-bottom: 50px;
    }

    .ekskul-intro h2 {
        font-size: 28px;
        font-weight: 700;
        color: var(--biru);
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .ekskul-intro p {
        font-size: 16px;
        color: var(--hitam);
        line-height: 1.7;
        max-width: 800px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .ekskul-hero h1 {
            font-size: 28px;
        }

        .ekskul-hero p {
            font-size: 16px;
        }

        .ekskul-content {
            padding: 40px 15px;
        }
    }
</style>

<div class="ekskul-hero">
    <div class="ekskul-hero-content">
        <h1>EKSKUL PENCAK SILAT</h1>
        <p>
            "Pelajari bela diri tradisional Indonesia!"
        </p>
    </div>
</div>

<div class="ekskul-content">
    <div class="ekskul-intro">
        <h2>⚔️ Ekskul Pencak Silat</h2>
        <p>
            Ekskul Pencak Silat mengajarkan seni bela diri tradisional Indonesia, termasuk gerakan, jurus, dan nilai-nilai budaya. Siswa akan belajar kekuatan, kelincahan, dan etika.
        </p>
    </div>
</div>
@endsection
