@extends('layout.app')

@section('content')

{{-- Hero Section --}}
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">LATIH HOBI</h1>
        <p class="hero-description">
            Merupakan platform pengembangan bakat, yang membantu anak, orang tua 
            dan sekolah untuk mengembangkan potensi kemampuan anak di bidangnya 
            masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang 
            kompeten.
        </p>
        <a href="#program" class="btn-cta">START E-COURSE</a>
    </div>
</section>

{{-- Features Section --}}
<section id="program" class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card" data-category="ekskul">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Ekskul Reguler Sekolah</h3>
            </div>

            <div class="feature-card" data-category="ecourse">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
                <h3 class="feature-title">E-Course</h3>
            </div>

            <div class="feature-card" data-category="community">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2 1l-3 4v2h2l2.54-3.4L16 18h4zM12.5 11.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5S11 9.17 11 10s.67 1.5 1.5 1.5zm1.5 1h-4c-.83 0-1.5.67-1.5 1.5v6h2v7h4v-7h2v-6c0-.83-.67-1.5-1.5-1.5zM6.5 6C7.33 6 8 5.33 8 4.5S7.33 3 6.5 3 5 3.67 5 4.5 5.67 6 6.5 6zm2.5 6h-4C4.17 12 3.5 12.67 3.5 13.5v6H6v7h4v-7h2.5v-6C12.5 12.67 11.83 12 11 12z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Komunitas & Club</h3>
            </div>

            <div class="feature-card" data-category="private">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Private Class</h3>
            </div>

            <div class="feature-card" data-category="bootcamp">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Bootcamp & Workshop</h3>
            </div>
        </div>
    </div>
</section>

{{-- Detail Section --}}
<section class="detail-section">
    <div class="container">
        <!-- Ekskul Reguler Detail -->
        <div class="detail-content" id="ekskul-detail">
            <h2 class="detail-title">Ekskul Reguler</h2>
            <p class="detail-description">
                "Ekskul Reguler LatihHobi adalah program ekstrakurikuler mingguan 
                berbasis proyek yang berlangsung berdasarkan silabus yang 
                sistematis & berlevel. Program ini dirancang untuk anak-anak usia 
                sekolah dan didampingi oleh tutor kompeten, serta melibatkan 
                peran aktif orang tua dan sekolah. Dilaksanakan secara rutin setiap 
                minggu, ekskul ini bisa dijalankan di sekolah mitra LatihHobi."
            </p>
            <button class="btn-detail">SHOW ALL EKSKUL</button>
        </div>

        <!-- E-Course Detail -->
        <div class="detail-content" id="ecourse-detail" style="display: none;">
            <h2 class="detail-title">E-Course</h2>
            <p class="detail-description">
                "E-Course LatihHobi adalah platform pembelajaran online yang fleksibel 
                dengan materi terstruktur, video berkualitas tinggi, dan sistem evaluasi 
                yang komprehensif. Anak-anak dapat belajar sesuai dengan pace mereka 
                sendiri dengan bimbingan tutor profesional melalui sistem online yang 
                interaktif dan engaging."
            </p>
            <button class="btn-detail">SHOW ALL E-COURSE</button>
        </div>

        <!-- Community Detail -->
        <div class="detail-content" id="community-detail" style="display: none;">
            <h2 class="detail-title">Komunitas & Club</h2>
            <p class="detail-description">
                "Komunitas & Club LatihHobi adalah wadah untuk anak-anak berinteraksi, 
                berbagi pengalaman, dan mengembangkan kemampuan sosial mereka. 
                Melalui berbagai kegiatan komunitas, anak-anak dapat membangun network, 
                berkolaborasi dalam proyek bersama, dan saling memotivasi dalam 
                mengembangkan hobi mereka."
            </p>
            <button class="btn-detail">SHOW ALL COMMUNITY</button>
        </div>

        <!-- Private Class Detail -->
        <div class="detail-content" id="private-detail" style="display: none;">
            <h2 class="detail-title">Private Class</h2>
            <p class="detail-description">
                "Private Class LatihHobi menawarkan pembelajaran one-on-one dengan 
                tutor berpengalaman untuk memberikan perhatian yang lebih personal. 
                Program ini dirancang khusus sesuai dengan kebutuhan dan kemampuan 
                individual anak, memungkinkan progress yang lebih cepat dan terarah 
                dalam mengembangkan skill tertentu."
            </p>
            <button class="btn-detail">SHOW ALL PRIVATE CLASS</button>
        </div>

        <!-- Bootcamp Detail -->
        <div class="detail-content" id="bootcamp-detail" style="display: none;">
            <h2 class="detail-title">Bootcamp & Workshop</h2>
            <p class="detail-description">
                "Bootcamp & Workshop LatihHobi adalah program intensif jangka pendek 
                yang fokus pada skill-building praktis. Melalui hands-on activities 
                dan project-based learning, anak-anak akan mendapatkan pengalaman 
                langsung dalam mengaplikasikan pengetahuan mereka dalam situasi nyata 
                dengan bimbingan mentor expert."
            </p>
            <button class="btn-detail">SHOW ALL BOOTCAMP</button>
        </div>
    </div>
</section>

@endsection