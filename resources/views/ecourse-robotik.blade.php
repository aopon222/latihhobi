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
            <h1>E-COURSE ROBOTIK</h1>
        </div>
    </section>

    <section style="background:#04a6d6; padding:28px 0 56px;">
        <div class="container">
            <div class="grid">
                @forelse($robotikCourses as $course)
                    <article class="card {{ !$course->is_active || $course->title === 'Coming Soon' ? 'protected' : '' }}">
                        <div class="card-wrap">
                            <img class="thumb" src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/THUMBNAIL E COURSE ATHUTO.svg') }}" alt="{{ $course->title }}">
                            <div class="lock">🔖</div>
                        </div>
                        <div class="body">
                            <h3 class="title">
                                {{ !$course->is_active ? 'Terlindungi: ' : '' }}{{ $course->title }}
                            </h3>
                            <p class="byline">By Latihhobi In {{ strtoupper($course->category) }}</p>
                        </div>
                        <div class="footer">
                            @if($course->is_active && $course->price)
                                <div>
                                    <span class="price-current">Rp{{ number_format($course->discount_price ?: $course->price, 0, ',', '.') }}</span>
                                    @if($course->discount_price && $course->price > $course->discount_price)
                                        <span class="price-old">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <button class="btn-cart" type="button" onclick="addToCart('{{ $course->slug }}')">🛒</button>
                            @else
                                <button class="btn-enroll" type="button">{{ str_contains(strtolower($course->title), 'coming') ? 'Coming Soon' : 'Enroll Course' }}</button>
                            @endif
                        </div>
                    </article>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; color: white; padding: 40px;">
                        <h3>Belum ada kursus robotik tersedia</h3>
                        <p>Silakan cek kembali nanti untuk update terbaru!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <script>
        function addToCart(courseSlug) {
            // Add cart functionality here
            alert('Menambahkan ke keranjang: ' + courseSlug);
            // You can implement AJAX call to add to cart
        }
    </script>
@endsection