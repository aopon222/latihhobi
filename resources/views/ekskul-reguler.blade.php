@extends('layout.app')

@section('title', 'Ekskul Reguler - LatihHobi')

@section('content')

    <!-- Hero Section -->
    <section class="ekskul-hero">
        <div class="ekskul-hero-content">
            <h1>EKSKUL REGULER</h1>
        </div>
    </section>

    <!-- Ekskul Reguler Section -->
    <section class="ekskul-section">
        <div class="ekskul-container">
            <div class="ekskul-grid">
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/ROBONESIA.svg') }}" alt="ROBONESIA" class="ekskul-icon-img">
                    </div>
                    <h3>Robotik</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/ARCHERY CLUB.svg') }}" alt="Archery" class="ekskul-icon-img">
                    </div>
                    <h3>Panahan</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/Asset 1.svg') }}" alt="Komik" class="ekskul-icon-img">
                    </div>
                    <h3>Komik</h3>
                </div>
                <div class="ekskul-item">
                    <div class="ekskul-icon">
                        <img src="{{ asset('images/KIDS CC.svg') }}" alt="Film & Konten Kreator" class="ekskul-icon-img">
                    </div>
                    <h3>Film & Konten Kreator</h3>
                </div>
                <div class="ekskul-item">
                    <a href="/ekskul/taekwondo" style="text-decoration:none; color:inherit;">
                        <div class="ekskul-icon">
                            <img src="{{ asset('images/TAEKWONDO.svg') }}" alt="Taekwondo" class="ekskul-icon-img">
                        </div>
                        <h3>Taekwondo</h3>
                    </a>
                </div>
                <div class="ekskul-item">
                    <a href="/ekskul/pencak-silat" style="text-decoration:none; color:inherit;">
                        <div class="ekskul-icon">
                            <img src="{{ asset('images/SILAT.svg') }}" alt="Pencak Silat" class="ekskul-icon-img">
                        </div>
                        <h3>Pencak Silat</h3>
                    </a>
                </div>
                <div class="ekskul-item">
                    <a href="/ekskul/karate" style="text-decoration:none; color:inherit;">
                        <div class="ekskul-icon">
                            <img src="{{ asset('images/KARATE.svg') }}" alt="Karate" class="ekskul-icon-img">
                        </div>
                        <h3>Karate</h3>
                    </a>
                </div>
                <div class="ekskul-item">
                    <a href="/ekskul/tahsin-tahfidz" style="text-decoration:none; color:inherit;">
                        <div class="ekskul-icon">
                            <img src="{{ asset('images/TAHFIDZ.svg') }}" alt="Tahsin & Tahfidz" class="ekskul-icon-img">
                        </div>
                        <h3>Tahsin & Tahfidz</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Ekskul Section -->
    <section class="galeri-section">
        <div class="galeri-container">
            <h2>GALERI EKSKUL</h2>
            <div class="galeri-grid">
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-1.jpg') }}" alt="Galeri 1" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-2.jpg') }}" alt="Galeri 2" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-3.jpg') }}" alt="Galeri 3" class="galeri-img">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/placeholder-gallery-4.jpg') }}" alt="Galeri 4" class="galeri-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
   <section class="social-section">
    <div class="social-container">
        <h2>Ikuti Kami</h2>
        <div class="social-icons">
            <a href="https://www.instagram.com/latihhobi/" class="social-icon instagram" target="_blank">
                <i class="fab fa-instagram" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.facebook.com/people/Latih-Hobi-Kursus-Ekstrakurikuler/61576377345236/?sk=reels_tab" class="social-icon facebook" target="_blank">
                <i class="fab fa-facebook" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.youtube.com/@Latihhobi" class="social-icon youtube" target="_blank">
                <i class="fab fa-youtube" style="font-size: 24px;"></i>
            </a>
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
@endsection
