@extends('layout.app')

@section('title', 'LatihHobi - Platform Pembelajaran')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                LATIHHOBI
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="active">Home</a></li>
                <li class="nav-item"><a href="#">Courses</a></li>
                <li class="nav-item"><a href="#">About</a></li>
                <li class="nav-item"><a href="#">Contact</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="#" class="btn-signin">Login</a>
                <a href="#" class="btn-signup">Register</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1>LATIH HOBI</h1>
            <p>Mari bergabung platform pembelajaran hobi online yang menyenangkan, mudah, dan hemat waktu! Dapatkan akses dengan akses menyeluruh berbagai mata pembelajaran dan berkembang tantalah dengan dukungan pengajar yang lengkap, berlisensi dan buku yang bergaransi.</p>
            <a href="#" class="btn-start">START E-COURSE</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-container">
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-laptop-code"></i></div>
                    <div class="service-title">Pemrograman</div>
                    <div class="service-subtitle">Software</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
                    <div class="service-title">E-Design</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-users"></i></div>
                    <div class="service-title">Life-Skill</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="service-title">Financial Literate</div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-gamepad"></i></div>
                    <div class="service-title">E-Sport</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Reguler Section -->
    <section class="jadwal-section">
        <div class="jadwal-container">
            <h2>Jadwal Reguler</h2>
            <p>Dengan jadwal yang sudah disusun secara sistematis, program pelaksanaan pembelajaran dilaksanakan dengan profesional. Selain yang terencana, kami memberikan perangkat kursus online yang dapat diakses 24 jam. Setiap peserta akan memiliki akses materi dengan durasi sesuai rencana standar yang telah ditetapkan oleh peserta yang akan memiliki akun komplementer secara menyeluruh kepada sistem modul terpelajar.</p>
            <a href="#" class="btn-lihat-jadwal">LIHAT JADWAL</a>
        </div>
    </section>

    <!-- Private Class Section -->
    <section class="private-class">
        <div class="private-container">
            <h2>PRIVATE CLASS</h2>
            <p>Private Class Latihhobi adalah layanan pembelajaran privat dan berkelompok. Latihhobi private class memungkinkan pembelajaran menjadi lebih fokus karena participant dapat berkonsultasi lebih dalam dengan mentor yang mengajar dalam sesi pembelajaran private class. Berdasarkan data lapangan, private class adalah metode pembelajaran yang paling diminati yang dapat memiliki keefektifan waktu dan tempat belajar sekaligus dapat beradaptasi terhadap jadwal dan kondisi participant lebih dan tempat belajar sekaligus dapat beradaptasi terhadap jadwal dan kondisi participant yang menjalani kelas individual atau berkelompok level kecil adalah memberikan beberapa kepada peserta kursus yang ditulis.</p>
            
            <div class="private-cards">
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="private-card-content">
                        <h3>Programming</h3>
                    </div>
                </div>
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="private-card-content">
                        <h3>Design</h3>
                    </div>
                </div>
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="private-card-content">
                        <h3>Business</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E-Course Section -->
    <section class="ecourse-section">
        <div class="ecourse-container">
            <h2>E-COURSE</h2>
            <p>E-Course Latihhobi adalah program terstruktur dengan durasi fleksibel sehingga memungkinkan peserta belajar sesuai dengan kebutuhan dan kemampuan masing-masing. Dengan materi yang terstruktur dan lengkap dalam bentuk video, audio, dan teks.</p>
            
            <div class="ecourse-cards">
                <div class="ecourse-card fade-in">
                    <div class="ecourse-card-image robotik">ROBOTIK</div>
                </div>
                <div class="ecourse-card fade-in">
                    <div class="ecourse-card-image komik">KOMIK</div>
                </div>
                <div class="ecourse-card fade-in">
                    <div class="ecourse-card-image film">FILM & CONTENT KREATOR</div>
                </div>
            </div>
        </div>
    </section>
@endsection