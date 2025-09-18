@extends('layout.app')

@section('title', 'E-COURSE Robotik - LatihHobi')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>E-COURSE Robotik</h1>
        </div>
    </section>
    <section style="background:#04a6d6; padding:28px 0 56px;">
        <div class="container">
            <div class="grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px;">
                <article class="card">
                    <img class="thumb" src="{{ asset('images/THUMBNAIL-E-COURSE-ROBODUST.svg') }}" alt="Robot Robodust">
                    <div class="body">
                        <h3 class="title">Robot Robodust</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <div>
                            <span class="price-current">Rp480,000</span>
                            <span class="price-old">Rp500,000</span>
                        </div>
                        <button class="btn-cart" type="button">🛒</button>
                    </div>
                </article>
                <article class="card">
                    <img class="thumb" src="{{ asset('images/THUMBNAIL-E-COURSE-ROBOFAN.svg') }}" alt="Robot Robofan">
                    <div class="body">
                        <h3 class="title">Robot Robofan</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <div>
                            <span class="price-current">Rp339,000</span>
                            <span class="price-old">Rp350,000</span>
                        </div>
                        <button class="btn-cart" type="button">🛒</button>
                    </div>
                </article>
                <article class="card">
                    <img class="thumb" src="{{ asset('images/THUMBNAIL-E-COURSE-HEMIPTERA.svg') }}" alt="Robot Hemiptera">
                    <div class="body">
                        <h3 class="title">Robot Hemiptera</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <div>
                            <span class="price-current">Rp289,000</span>
                            <span class="price-old">Rp300,000</span>
                        </div>
                        <button class="btn-cart" type="button">🛒</button>
                    </div>
                </article>
                <!-- Tambahkan card produk robotik lain sesuai kebutuhan -->
            </div>
        </div>
    </section>
@endsection
@extends('layout.app')

@section('title', 'E-COURSE Robotik - LatihHobi')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>E-COURSE Robotik</h1>
        </div>
    </section>
    <section style="background:#04a6d6; padding:28px 0 56px;">
        <div class="container">
            <div class="grid">
                <!-- Tambahkan konten kelas robotik di sini -->
            </div>
        </div>
    </section>
@endsection
