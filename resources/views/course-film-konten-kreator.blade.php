@extends('layout.app')

@section('title', 'E-COURSE Film & Konten Kreator - LatihHobi')

@section('content')
    <header class="subpage-header">
        <div class="container">
            <h1>E-COURSE Film & Konten Kreator</h1>
        </div>
    </header>

    <section class="course-listing">
        <div class="container">
            <div class="courses-grid">
                <article class="course-card">
                    <div class="course-info">
                        <h3>Kelas Film & Content Creator Level 1</h3>
                        <p class="byline">By Latihhobi • In Film & Konten Kreator</p>
                        <div class="price">
                            <span class="price-old">Rp300,000</span>
                            <span class="price-current">Rp269,000</span>
                        </div>
                        <button class="btn-primary">Tambah ke keranjang</button>
                    </div>
                </article>

                <article class="course-card">
                    <div class="course-info">
                        <h3>Kelas Film & Content Creator Level 2</h3>
                        <p class="byline">By Latihhobi • In Film & Konten Kreator</p>
                        <div class="price">
                            <span class="price-old">Rp300,000</span>
                            <span class="price-current">Rp269,000</span>
                        </div>
                        <button class="btn-primary">Tambah ke keranjang</button>
                    </div>
                </article>

                <article class="course-card protected">
                    <div class="course-info">
                        <h3>Terlindungi: (COMINGSOON) Photo Story & Video Product Level 3</h3>
                        <p class="byline">By Latihhobi • In Film & Konten Kreator</p>
                        <a class="btn-secondary" href="#">Enroll Course</a>
                    </div>
                </article>

                <article class="course-card protected">
                    <div class="course-info">
                        <h3>Terlindungi: (COMINGSOON) Motion Photo & Video Essay Level 4</h3>
                        <p class="byline">By Latihhobi • In Film & Konten Kreator</p>
                        <a class="btn-secondary" href="#">Enroll Course</a>
                    </div>
                </article>

                <article class="course-card protected">
                    <div class="course-info">
                        <h3>Terlindungi: (COMINGSOON) Film Pendek Level 5</h3>
                        <p class="byline">By Latihhobi • In Film & Konten Kreator</p>
                        <a class="btn-secondary" href="#">Enroll Course</a>
                    </div>
                </article>
            </div>

            <div class="auth-cta">
                <h3>Hi, Welcome back!</h3>
                <div class="auth-links">
                    <a class="link" href="#">Forgot Password?</a>
                    <label class="checkbox"><input type="checkbox"> Keep me signed in</label>
                </div>
                <div class="auth-actions">
                    <a class="btn-primary" href="{{ route('login') }}">Sign In</a>
                    <span>Don't have an account? <a class="link" href="{{ route('register') }}">Register Now</a></span>
                </div>
            </div>
        </div>
    </section>
@endsection


