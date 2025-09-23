@extends('layout.app')

@section('title', 'LatihHobi - Platform Pembelajaran')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="active">Home</a></li>
                <li class="nav-item"><a href="/ekskul-reguler">Ekskul Reguler</a></li>
                <li class="nav-item dropdown">
                    <a href="/ecourse">E-course <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="/ecourse" class="dropdown-item">
                            <span class="dropdown-icon">🤖</span>
                            Ecourse Robotik
                        </a>
                        <a href="/course-film-konten-kreator" class="dropdown-item">
                            <span class="dropdown-icon">🎬</span>
                            Ecourse Film & Konten Kreator
                        </a>
                        <a href="/ecourse" class="dropdown-item">
                            <span class="dropdown-icon">📖</span>
                            Ecourse Komik
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="/event">Event <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🏆</span>
                            LHEC IV 2025
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">💼</span>
                            WORKSHOP & BOOTCAMP
                        </a>
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-icon">🎉</span>
                            HOLIDAY FUN CLASS
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#"><span class="dropdown-icon">📷</span> Tentang Kami <span class="dropdown-arrow">▼</span></a>
                    <div class="dropdown-menu">
                        <a href="/karier" class="dropdown-item">Latih Hobi Karier</a>
                        <a href="/magang" class="dropdown-item">Program Magang (Internship)</a>
                        <a href="/profil" class="dropdown-item">PROFIL</a>
                        <a href="/contact" class="dropdown-item">CONTACT</a>
                    </div>
                </li>
            </ul>
            <div class="user-menu">
                <a href="#" class="user-icon">🔍</a>
                <a href="#" class="user-icon">🛒</a>
                @php
                    $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                    $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                    $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
                @endphp
                @auth
                    <!-- User dropdown dihilangkan sementara -->
                @else
                    @if($hasLoginRoute)
                    <a href="{{ route('login') }}" class="btn-signin">Sign in</a>
                    @endif
                    @if($hasRegisterRoute)
                    <a href="{{ route('register') }}" class="btn-signup">Sign up</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1>LATIH HOBI</h1>
            <p>Merupakan platform pengembangan bakat, yang membantu anak, orang tua dan sekolah untuk mengembangkan potensi kemampuan anak di bidangnya masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang kompeten.</p>
            <a href="/ecourse" class="btn-start">START E-COURSE</a>
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
                <a href="/ecourse/robotik" class="ecourse-card fade-in" style="text-decoration:none;color:inherit;">
                    <div class="ecourse-card-image robotik">ROBOTIK</div>
                </a>
                <a href="/ecourse-komik" class="ecourse-card fade-in" style="text-decoration:none;color:inherit;">
                    <div class="ecourse-card-image komik">KOMIK</div>
                </a>
                <a href="/course-film-konten-kreator" class="ecourse-card fade-in" style="text-decoration:none;color:inherit;">
                    <div class="ecourse-card-image film">FILM & CONTENT KREATOR</div>
                </a>
            </div>
        </div>
    </section>

    <!-- Private Class Section -->
    <section class="private-class">
        <div class="private-class-container">
            <h2>PRIVATE CLASS</h2>
            <p>Private Class LatihHobi adalah layanan pengembangan bakat secara personal yang dirancang khusus sesuai minat, jadwal, dan kebutuhan unik setiap anak. Kelas ini memungkinkan siswa belajar satu-satu bersama tutor berpengalaman, dengan materi yang disesuaikan, bimbingan intensif, serta fleksibilitas waktu dan tempat—baik dilakukan secara daring maupun langsung di rumah. Cocok untuk anak yang ingin fokus mendalami bidang tertentu, menyiapkan kompetisi, atau memiliki kebutuhan belajar khusus di luar ekskul reguler</p>
            <div class="private-class-grid">
                <div class="private-class-item">
                    <div class="private-class-icon">
                        <img src="{{ asset('images/placeholder-robotik.svg') }}" alt="Robotik" class="private-class-icon-img">
                    </div>
                    <h3>Robotik</h3>
                </div>
                <div class="private-class-item">
                    <div class="private-class-icon">
                        <img src="{{ asset('images/placeholder-film.svg') }}" alt="Film & Konten Kreator" class="private-class-icon-img">
                    </div>
                    <h3>Film & Konten Kreator</h3>
                </div>
                <div class="private-class-item">
                    <div class="private-class-icon">
                        <img src="{{ asset('images/placeholder-komik.svg') }}" alt="Komik" class="private-class-icon-img">
                    </div>
                    <h3>Komik</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Komunitas & Club Section -->
    <section class="komunitas-club">
        <div class="komunitas-club-container">
            <h2>KOMUNITAS & CLUB</h2>
            <p>"Komunitas & Club LatihHobi adalah ruang lanjutan bagi anak untuk terus mengembangkan minat dan bakatnya setelah mengikuti kelas atau ekskul. Komunitas ini tidak hanya mewadahi siswa peserta ekskul reguler, tetapi juga terbuka untuk anak-anak dari luar sekolah mitra yang ingin bergabung dan belajar bersama. Di dalam komunitas ini, siswa bisa berinteraksi dengan mentor, mengikuti diskusi dan tantangan berkala, mempublikasikan karya, serta berpartisipasi dalam kegiatan showcase atau mini kompetisi. Komunitas ini dibangun sebagai ekosistem belajar yang aktif, suportif, dan mendorong eksplorasi prestasi secara berkelanjutan."</p>
            <div class="komunitas-club-grid">
                <div class="komunitas-club-item">
                    <div class="club-badge">COMING SOON</div>
                    <h3>Robonesia Club Robotik</h3>
                    <a href="#" class="btn-club" disabled>DAFTAR SEKARANG</a>
                </div>
                <div class="komunitas-club-item">
                    <div class="club-badge">COMING SOON</div>
                    <h3>Kids Content Creator</h3>
                    <a href="#" class="btn-club" disabled>DAFTAR SEKARANG</a>
                </div>
                <div class="komunitas-club-item">
                    <div class="club-badge">COMING SOON</div>
                    <h3>Latih Hobi Club Archery</h3>
                    <a href="#" class="btn-club" disabled>DAFTAR SEKARANG</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootcamp & Workshop Section -->
    <section class="bootcamp-workshop">
        <div class="bootcamp-workshop-container">
            <h2>BOOTCAMP & WORKSHOP</h2>
            <p>"Bootcamp & Workshop LatihHobi adalah program kelas intensif berbentuk webinar yang dirancang untuk orang tua, guru, dan anak dalam rangka memahami dan mengembangkan bakat anak secara lebih mendalam. Program ini menghadirkan materi aplikatif, narasumber ahli, sesi interaktif, hingga studi kasus nyata seputar potensi dan minat anak."</p>
            <div class="workshop-cards">
                <div class="workshop-card">
                    <div class="workshop-header">
                        <h3>Parenting Workshop</h3>
                        <div class="workshop-badge">REGISTRATION NOW</div>
                    </div>
                    <h4>TAKUT SALAH ARAH?</h4>
                    <p>Begini Cara Dampingi Bakat Anak Sejak Dini</p>
                    <div class="workshop-details">
                        <div class="workshop-date">
                            <span class="date-icon">📅</span>
                            <span>JUMAT, 15/08/2025</span>
                        </div>
                        <div class="workshop-time">
                            <span class="time-icon">🕐</span>
                            <span>10.00-11.30 WIB</span>
                        </div>
                    </div>
                    <button class="btn-register">REGISTRATION NOW</button>
                </div>
                <div class="workshop-card coming-soon">
                    <div class="workshop-badge-coming">COMING SOON</div>
                    <h4>Parenting Anak di Era Digitalisasi</h4>
                    <p>Kelas Webinar Bersama</p>
                </div>
                <div class="workshop-card coming-soon">
                    <div class="workshop-badge-coming">COMING SOON</div>
                    <h4>To be A Great Teacher for Kids</h4>
                    <p>Kelas Bootcamp Online</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Podcast Section -->
    <section class="podcast-section">
        <div class="podcast-container">
            <h2>TONTON PODCAST LATIHHOBI</h2>
            <div class="podcast-grid">
                @php
                    $featuredPodcasts = \App\Models\Podcast::active()->featured()->ordered()->limit(4)->get();
                @endphp
                @foreach($featuredPodcasts as $podcast)
                <div class="podcast-item" data-youtube-id="{{ $podcast->youtube_id }}">
                    <div class="podcast-thumbnail">
                        <img src="{{ $podcast->thumbnail_url }}" alt="{{ $podcast->title }}" class="thumbnail-img">
                        <div class="play-button"></div>
                        <div class="podcast-overlay">
                            <h4>{{ Str::limit($podcast->title, 20) }}</h4>
                            <p>{{ Str::limit($podcast->description, 30) }}</p>
                            <span>{{ $podcast->duration }}</span>
                        </div>
                    </div>
                    <div class="podcast-info">
                        <h3>{{ $podcast->title }}</h3>
                        <p>{{ $podcast->host }}</p>
                        <a href="{{ route('podcasts.show', $podcast) }}" class="btn-subscribe">Tonton Sekarang</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="podcast-actions">
                <a href="{{ route('podcasts.index') }}" class="btn-view-all">Lihat Semua Podcast</a>
            </div>
        </div>
    </section>

    <!-- YouTube Modal Player -->
    <div id="youtubeModal" class="youtube-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="video-container">
                <iframe id="youtubePlayer" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <style>
        /* YouTube Modal Styles */
        .youtube-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
        }

        .modal-content {
            position: relative;
            margin: 2% auto;
            width: 90%;
            max-width: 1000px;
            height: 90%;
        }

        .close-modal {
            position: absolute;
            top: -50px;
            right: 0;
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            background: rgba(0,0,0,0.5);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .close-modal:hover {
            background: rgba(0,0,0,0.8);
        }

        .video-container {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
        }

        /* Enhanced Play Button */
        .podcast-item .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255, 0, 0, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            font-size: 0;
            color: white;
            box-shadow: 0 4px 20px rgba(255, 0, 0, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .podcast-item .play-button:hover {
            transform: translate(-50%, -50%) scale(1.1);
            background: rgba(255, 0, 0, 1);
            box-shadow: 0 6px 25px rgba(255, 0, 0, 0.5);
        }

        .podcast-item .play-button::before {
            content: '';
            width: 0;
            height: 0;
            border-left: 24px solid white;
            border-top: 14px solid transparent;
            border-bottom: 14px solid transparent;
            margin-left: 6px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                height: 70%;
                margin: 10% auto;
            }

            .close-modal {
                top: -40px;
                font-size: 2rem;
                width: 35px;
                height: 35px;
            }

            .podcast-item .play-button {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .podcast-item .play-button::before {
                border-left: 18px solid white;
                border-top: 11px solid transparent;
                border-bottom: 11px solid transparent;
                margin-left: 4px;
            }
        }
    </style>

    <script>
        // YouTube Modal functionality
        const modal = document.getElementById('youtubeModal');
        const player = document.getElementById('youtubePlayer');
        const closeModal = document.querySelector('.close-modal');
        const playButtons = document.querySelectorAll('.podcast-item .play-button');

        // Add click event to all play buttons
        playButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Get YouTube ID from parent element
                const podcastItem = this.closest('.podcast-item');
                const youtubeId = podcastItem.getAttribute('data-youtube-id');

                if (youtubeId) {
                    // Set video source with autoplay
                    player.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1`;
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close modal functionality
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            player.src = '';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                player.src = '';
                document.body.style.overflow = 'auto';
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && modal.style.display === 'block') {
                modal.style.display = 'none';
                player.src = '';
                document.body.style.overflow = 'auto';
            }
        });

        // Pause video when modal is closed
        function stopVideo() {
            player.src = '';
        }
    </script>
@endsection
