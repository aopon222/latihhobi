@extends('layout.app')

@section('title', 'E-Course - LatihHobi')

@section('content')
    <!-- Hero Section -->
    <section class="ecourse-hero">
        <div class="ecourse-hero-content">
            <h1>E-COURSE</h1>
            <p>E-Course LatihHobi adalah program belajar mandiri berbasis digital yang dirancang untuk membantu anak mengembangkan bakatnya kapan saja dan di mana saja.</p>
        </div>
    </section>

    <!-- E-Course Categories -->
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
                <a href="/ecourse-komik" class="ecourse-category" style="text-decoration:none;color:inherit;">
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

    <!-- Featured Products Section -->
    <section class="products-section">
        <div class="products-container">
            <h2>Produk Robotik Terpopuler</h2>
            <div class="products-grid">
                @foreach($ecourses->where('category', 'Robotics')->where('is_featured', true)->take(3) as $course)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/THUMBNAIL E COURSE ROBODUST.svg') }}" alt="{{ $course->title }}" class="product-img">
                        </div>
                        <div class="product-info">
                            <h3>{{ $course->title }}</h3>
                            <p class="product-author">By Latihhobi</p>
                            <div class="product-price">
                                @if($course->discount_price && $course->price > $course->discount_price)
                                    <span class="original-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                    <span class="current-price">Rp{{ number_format($course->discount_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <button class="btn-add-cart" onclick="addToCart('{{ $course->slug }}')">Tambah ke keranjang</button>
                        </div>
                    </div>
                @endforeach
                
                @if($ecourses->where('category', 'Robotics')->where('is_featured', true)->count() < 3)
                    @for($i = $ecourses->where('category', 'Robotics')->where('is_featured', true)->count(); $i < 3; $i++)
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/THUMBNAIL E COURSE ROBODUST.svg') }}" alt="Coming Soon" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3>Segera Hadir</h3>
                                <p class="product-author">By Latihhobi</p>
                                <div class="product-price">
                                    <span class="current-price">Coming Soon</span>
                                </div>
                                <button class="btn-add-cart" disabled>Coming Soon</button>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="coming-soon-section">
        <div class="coming-soon-container">
            <h2>Kursus Baru Segera Hadir</h2>
            <div class="coming-soon-grid">
                <div class="coming-soon-card">
                    <div class="coming-soon-badge">COMING SOON</div>
                    <h3>Robot Soccer Bot</h3>
                    <p>By Latihhobi</p>
                    <button class="btn-enroll" disabled>Enroll Course</button>
                </div>
                <div class="coming-soon-card">
                    <div class="coming-soon-badge">COMING SOON</div>
                    <div class="product-image">
                        <img src="{{ asset('images/THUMBNAIL E COURSE AVOIDER.svg') }}" alt="Robot Hemiptera" class="product-img">
                    </div>
                    <h3>Robot Avoider</h3>
                    <p>By Latihhobi</p>
                    <button class="btn-enroll" disabled>Enroll Course</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <p>© 2025 - Latih hobi</p>
            </div>
            <div class="footer-right">
                <a href="https://www.instagram.com/latihhobi/" class="social-icon instagram">
                <i class="fab fa-instagram" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.facebook.com/people/Latih-Hobi-Kursus-Ekstrakurikuler/61576377345236/?sk=reels_tab" class="social-icon facebook">
                <i class="fab fa-facebook" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.youtube.com/@latihhobi" class="social-icon youtube">
                <i class="fab fa-youtube" style="font-size: 24px;"></i>
            </a>
            </div>
        </div>
    </footer>

    <script>
        function addToCart(courseSlug) {
            // Add cart functionality here
            alert('Menambahkan ke keranjang: ' + courseSlug);
            // You can implement AJAX call to add to cart
        }
    </script>
@endsection
