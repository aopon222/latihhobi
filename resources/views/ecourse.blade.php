@extends('layout.app')

@section('title', 'E-Course - LatihHobi')

@section('content')
<section class="ecourse-categories">
    <div class="ecourse-container">
        <div class="ecourse-grid">
            <a href="/ecourse/robotik" class="ecourse-category" style="text-decoration:none;color:inherit;">
                <div class="category-icon">
                    <img src="{{ asset('images/ROBONESIA.svg') }}" alt="Robotik" class="category-icon-img">
                </div>
                <h3>Ecourse Robotik</h3>
                <p>Belajar robotik dengan proyek-proyek menarik dan interaktif</p>
                <span class="btn-category">Lihat Kursus</span>
            </a>
            <a href="/course-film-konten-kreator" class="ecourse-category" style="text-decoration:none;color:inherit;">
                <div class="category-icon">
                    <img src="{{ asset('images/KIDS CC.svg') }}" alt="Film & Konten Kreator" class="category-icon-img">
                </div>
                <h3>Ecourse Film & Konten Kreator</h3>
                <p>Kembangkan kreativitas dalam pembuatan film dan konten digital</p>
                <span class="btn-category">Lihat Kursus</span>
            </a>
            <a href="/ecourse/komik" class="ecourse-category" style="text-decoration:none;color:inherit;">
                <div class="category-icon">
                    <img src="{{ asset('images/Asset 1.svg') }}" alt="Komik" class="category-icon-img">
                </div>
                <h3>Ecourse Komik</h3>
                <p>Pelajari seni membuat komik dari dasar hingga mahir</p>
                <span class="btn-category">Lihat Kursus</span>
            </a>
        </div>
    </div>
</section>

<!-- PRODUK ROBOTIK -->
<section class="products-section">
    <div class="products-container">
        <h2>Produk Course Robotik</h2>
        <div class="products-scroll">
            @foreach($ecourses->where('id_category', 1) as $course)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}" class="product-img">
                    </div>
                    <div class="product-info">
                        <h3>{{ $course->name }}</h3>
                        <p class="product-author">By {{ $course->course_by ?? 'Latihhobi' }}</p>
                        <div class="product-price">
                            <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart('{{ $course->id_course }}')">MORE INFO</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- PRODUK FILM & CONTENT CREATOR -->
<section class="products-section">
    <div class="products-container">
        <h2>Produk Course Film & Content Creator</h2>
        <div class="products-scroll">
            @foreach($ecourses->where('id_category', 2) as $course)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}" class="product-img">
                    </div>
                    <div class="product-info">
                        <h3>{{ $course->name }}</h3>
                        <p class="product-author">By {{ $course->course_by ?? 'Latihhobi' }}</p>
                        <div class="product-price">
                            <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart('{{ $course->id_course }}')">MORE INFO</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- PRODUK KOMIK -->
<section class="products-section">
    <div class="products-container">
        <h2>Produk Course Komik</h2>
        <div class="products-scroll">
            @foreach($ecourses->where('id_category', 3) as $course)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}" class="product-img">
                    </div>
                    <div class="product-info">
                        <h3>{{ $course->name }}</h3>
                        <p class="product-author">By {{ $course->course_by ?? 'Latihhobi' }}</p>
                        <div class="product-price">
                            <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart('{{ $course->id_course }}')">MORE INFO</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function addToCart(courseId) {
        alert('Menambahkan ke keranjang: ' + courseId);
    }
</script>

<style>
    /* Scrollable Course Cards */
    .products-scroll {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .products-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .products-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .product-card {
        min-width: 280px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .product-info {
        padding: 15px;
    }

    .product-author {
        color: #888;
        font-size: 0.9rem;
    }

    .product-price {
        margin: 10px 0;
        font-weight: bold;
    }

    .btn-add-cart {
        background: #ff6600;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
    }

    .btn-add-cart:hover {
        background: #e55a00;
    }
</style>
@endsection
