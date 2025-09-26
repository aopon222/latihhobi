@extends('layout.app')

@section('title', 'E-COURSE Robotik - LatihHobi')

@section('content')
    <style>
        .page-hero { background:#04a6d6; padding:48px 0; color:#fff; text-align:center; }
        .page-hero h1 { font-size:28px; font-weight:800; letter-spacing:.5px; }
        .container { max-width:1140px; margin:0 auto; padding:0 16px; }
        .grid { display:grid; grid-template-columns:repeat(1,minmax(0,1fr)); gap:24px; }
        @media (min-width:768px){ .grid{ grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media (min-width:992px){ .grid{ grid-template-columns:repeat(3,minmax(0,1fr)); } }
        .card { background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); border:1px solid #e8eef4; }
        .thumb { width:100%; height:190px; object-fit:cover; display:block; }
        .body { padding:18px; }
        .title { font-weight:700; color:#1f2937; font-size:18px; line-height:1.4; margin:0 0 8px; }
        .byline { color:#55657d; font-size:14px; margin:0 0 0; }
        .footer { border-top:1px solid #e8eef4; padding:14px 18px; display:flex; align-items:center; justify-content:space-between; }
        .price-current { font-weight:800; color:#0f3d5c; font-size:20px; margin-right:10px; }
        .price-old { color:#95a3b8; text-decoration:line-through; font-size:14px; }
        .btn-cart { border:2px solid #0f3d5c; color:#0f3d5c; background:#fff; border-radius:8px; padding:8px 10px; display:inline-flex; align-items:center; gap:8px; font-weight:600; }
        .btn-enroll { width:100%; border:2px solid #ccd6e3; background:#fff; color:#0f3d5c; padding:12px 0; border-radius:10px; font-weight:700; }
        .lock { position:absolute; right:12px; top:12px; background:#fff; border-radius:50%; width:34px; height:34px; display:grid; place-items:center; box-shadow:0 2px 6px rgba(0,0,0,.12); }
        .card.protected .footer { padding:16px 18px; }
        .card-wrap { position:relative; border-radius:12px; overflow:hidden; }
    </style>

    <section class="page-hero">
        <div class="container">
            <h1>E-COURSE Robotik</h1>
        </div>
    </section>

    <section style="background:#04a6d6; padding:28px 0 56px;">
        <div class="container">
            <div class="grid">
                <article class="card">
                    <div class="card-wrap">
                        <img class="thumb" src="{{ asset('images/E COURSE lv 1.svg') }}" alt="Level 1">
                        <div class="lock">🔖</div>
                    </div>
                    <div class="body">
                        <h3 class="title">Kelas Robotik Level 1</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <div>
                            <span class="price-current">Rp269,000</span>
                            <span class="price-old">Rp300,000</span>
                        </div>
                        <button class="btn-cart" type="button">🛒</button>
                    </div>
                </article>

                <article class="card">
                    <div class="card-wrap">
                        <img class="thumb" src="{{ asset('images/E COURSE lv 2.svg') }}" alt="Level 2">
                        <div class="lock">🔖</div>
                    </div>
                    <div class="body">
                        <h3 class="title">Kelas Robotik Level 2</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <div>
                            <span class="price-current">Rp269,000</span>
                            <span class="price-old">Rp300,000</span>
                        </div>
                        <button class="btn-cart" type="button">🛒</button>
                    </div>
                </article>

                <article class="card protected">
                    <div class="card-wrap">
                        <img class="thumb" src="{{ asset('images/E COURSE lv 3.svg') }}" alt="Level 3">
                        <div class="lock">🔖</div>
                    </div>
                    <div class="body">
                        <h3 class="title">Terlindungi: (COMINGSOON) Robotik Digital Level 3</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <button class="btn-enroll" type="button">Enroll Course</button>
                    </div>
                </article>

                <article class="card protected">
                    <div class="card-wrap">
                        <img class="thumb" src="{{ asset('images/E COURSE lv 4.svg') }}" alt="Level 4">
                        <div class="lock">🔖</div>
                    </div>
                    <div class="body">
                        <h3 class="title">Terlindungi: (COMINGSOON) Robotik Animasi Level 4</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <button class="btn-enroll" type="button">Enroll Course</button>
                    </div>
                </article>

                <article class="card protected">
                    <div class="card-wrap">
                        <img class="thumb" src="{{ asset('images/E COURSE lv 5.svg') }}" alt="Level 5">
                        <div class="lock">🔖</div>
                    </div>
                    <div class="body">
                        <h3 class="title">Terlindungi: (COMINGSOON) Robotik Profesional Level 5</h3>
                        <p class="byline">By Latihhobi In Robotik</p>
                    </div>
                    <div class="footer">
                        <button class="btn-enroll" type="button">Enroll Course</button>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
