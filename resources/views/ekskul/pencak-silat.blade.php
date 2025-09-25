@extends('layout.app')

@section('title', 'Ekskul Pencak Silat - LatihHobi')

@section('content')
<style>
    /* Ekskul Hero V2 - lokal halaman */
    .ekskul-hero {
        position: relative;
        width: 100%;
        min-height: 70vh;
        margin-top: 70px; /* offset header fixed dari layout */
        display: flex;
        align-items: center;
        justify-content: flex-start;
        background: var(--ekskul-bg, linear-gradient(180deg, #e5e7eb 0%, #d1d5db 100%)); /* fallback saat belum ada aset */
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }

    .ekskul-hero::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: min(700px, 60vw);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.95) 60%, rgba(255,255,255,0) 100%);
        z-index: 1;
    }

    .ekskul-hero-content {
        position: relative;
        z-index: 2;
        text-align: left;
        color: #111827;
        max-width: 780px;
        padding: 0 5%;
    }

    .ekskul-hero h1 {
        font-size: clamp(2rem, 4vw + 0.5rem, 4rem);
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }

    .ekskul-hero p {
        font-size: clamp(1rem, 1.2vw + 0.6rem, 1.25rem);
        line-height: 1.8;
        color: #374151;
        max-width: 60ch;
        margin: 0;
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
        color: #04a6d6;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .ekskul-intro p {
        font-size: 16px;
        color: #1a2330;
        line-height: 1.7;
        max-width: 800px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .ekskul-hero { min-height: 60vh; }
        .ekskul-hero::before { width: 100%; }
        .ekskul-hero-content { padding: 2rem 1.25rem; }
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
