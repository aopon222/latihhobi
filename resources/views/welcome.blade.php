@extends('layout.app')

@section('title', 'LatihHobi - Platform Pembelajaran')

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1>Latih Hobi</h1>
            <p>Merupakan platform pengembangan bakat, yang membantu anak, orang tua dan sekolah untuk mengembangkan potensi
                kemampuan anak di bidangnya masing-masing dengan ekosistem belajar yang lengkap, terukur dan tutor yang
                kompeten.</p>
            <a href="{{ route('course.robotik') }}" class="btn-start">START E-COURSE</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-container">
            <div class="services-grid">
                <div class="service-card fade-in">
                    <h3>Ekskul Reguler Sekolah</h3>
                </div>
                <div class="service-card fade-in">
                    <h3>E-Course</h3>
                </div>
                <div class="service-card fade-in">
                    <h3>Komunitas dan Club</h3>
                </div>
                <div class="service-card fade-in">
                    <h3>Private Class</h3>
                </div>
                <div class="service-card fade-in">
                    <h3>LHEC 2025</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Ekskul Reguler Section -->
    <section class="jadwal-section">
        <div class="jadwal-container">
            <h2>Ekskul Reguler</h2>
            <p>Ekskul Reguler LatihHobi merupakan kegiatan ekstrakurikuler mingguan berbasis proyek, yang disusun
                berdasarkan silabus terstruktur dan bertingkat. Program ini ditujukan bagi anak-anak usia sekolah,
                didampingi oleh tutor berpengalaman, serta melibatkan peran aktif dari orang tua dan pihak sekolah. Kegiatan
                ini dilaksanakan secara rutin setiap minggu di sekolah mitra LatihHobi.</p>
            <a href="/ekskul-reguler" class="btn-lihat-jadwal">LIHAT SEMUA</a>
        </div>
    </section>

    <!-- Private Class Section -->
    <section class="private-class">
        <div class="private-container">
            <h2>PRIVATE CLASS</h2>
            <p>Private Class LatihHobi adalah layanan pembelajaran privat dan berkelompok. LatihHobi private class
                memungkinkan pembelajaran menjadi lebih fokus karena participant dapat berkonsultasi lebih dalam dengan
                mentor yang mengajar dalam sesi pembelajaran private class. Berdasarkan data lapangan, private class adalah
                metode pembelajaran yang paling diminati yang dapat memiliki keefektifan waktu dan tempat belajar sekaligus
                dapat beradaptasi terhadap jadwal dan kondisi participant.</p>

            <div class="private-cards">
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <img src="{{ asset('images/Logo Robotik.png') }}" alt="Robotik">
                    </div>
                    <div class="private-card-content">
                        <h3>Robotik</h3>
                    </div>
                </div>
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <img src="{{ asset('images/Logo Komik.png') }}" alt="Komik">
                    </div>
                    <div class="private-card-content">
                        <h3>Komik</h3>
                    </div>
                </div>
                <div class="private-card fade-in">
                    <div class="private-card-image">
                        <img src="{{ asset('images/Logo FKK.png') }}" alt="Film">
                    </div>
                    <div class="private-card-content">
                        <h3>Film & Konten Kreator</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E-Course Section -->
    <section class="ecourse-section">
        <div class="ecourse-container">
            <h2>E-COURSE</h2>
            <p>E-Course LatihHobi adalah program belajar mandiri berbasis digital yang dirancang untuk membantu anak
                mengembangkan bakatnya kapan saja dan di mana saja.</p>

            <div class="ecourse-cards">
                <a href="/ecourse/robotik" class="ecourse-card fade-in">
                    <img src="{{ asset('images/Home Robotik.png') }}" alt="Robotik">
                </a>
                <a href="/course-film-konten-kreator" class="ecourse-card fade-in">
                    <img src="{{ asset('images/Home FKK.png') }}" alt="Film & Konten Kreator">
                </a>
                <a href="/ecourse/komik" class="ecourse-card fade-in">
                    <img src="{{ asset('images/Home Komik.png') }}" alt="Komik">
                </a>
            </div>
        </div>
    </section>

    <!-- Komunitas & Club Section -->
    <section class="komunitas-club">
        <div class="komunitas-club-container">
            <h2>Komunitas & Club</h2>
            <p>Komunitas & Club LatihHobi adalah wadah lanjutan bagi anak-anak untuk terus mengembangkan minat dan bakat
                mereka setelah mengikuti kelas atau ekskul. Komunitas ini tidak hanya diperuntukkan bagi siswa ekskul
                reguler, tetapi juga terbuka bagi anak-anak dari luar sekolah mitra yang ingin bergabung dan belajar
                bersama. Di komunitas ini, siswa dapat berinteraksi dengan mentor, mengikuti diskusi dan tantangan berkala,
                mempublikasikan karya, serta berpartisipasi dalam kegiatan showcase atau kompetisi mini. Komunitas ini
                dirancang sebagai ekosistem belajar yang aktif, suportif, dan mendorong eksplorasi prestasi secara
                berkelanjutan.</p>
            <div class="komunitas-club-grid">
                <div class="komunitas-club-item">
                    <div class="club-image-wrapper">
                        <img src="{{ asset('images/Club Robotik.png') }}" alt="Robonesia Club Robotik">
                    </div>
                    <a href="#" class="btn-club-daftar">Daftar Sekarang</a>
                </div>
                <div class="komunitas-club-item">
                    <div class="club-image-wrapper">
                        <img src="{{ asset('images/Club FKK.png') }}" alt="Kids Content Creator">
                    </div>
                    <a href="#" class="btn-club-daftar">Daftar Sekarang</a>
                </div>
                <div class="komunitas-club-item">
                    <div class="club-image-wrapper">
                        <img src="{{ asset('images/Club Panahan.png') }}" alt="Latih Hobi Club Archery">
                    </div>
                    <a href="#" class="btn-club-daftar">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootcamp & Workshop Section -->
    <section class="bootcamp-workshop">
        <div class="bootcamp-workshop-container">
            <h2>Bootcamp & Workshop</h2>
            <p>Bootcamp & Workshop LatihHobi adalah program kelas intensif berbentuk webinar yang dirancang untuk orang tua,
                guru, dan anak dalam rangka memahami dan mengembangkan bakat anak secara lebih mendalam. Program ini
                menghadirkan materi aplikatif, narasumber ahli, sesi interaktif, hingga studi kasus nyata seputar potensi
                minat anak.</p>
            <div class="bootcamp-grid">
                <a href="#" class="bootcamp-card">
                    <img src="{{ asset('images/Bootcamp 1.png') }}" alt="Parenting Workshop - Takut Salah Arah">
                </a>
                <a href="#" class="bootcamp-card">
                    <img src="{{ asset('images/Bootcamp 2.png') }}" alt="Parenting Anak di Era Digitalisasi">
                </a>
                <a href="#" class="bootcamp-card">
                    <img src="{{ asset('images/Bootcamp 3.png') }}" alt="To be A Great Teacher for Kids">
                </a>
            </div>
        </div>
    </section>

    <!-- Tonton Podcast Section -->
    <section class="podcast-section">
        <div class="podcast-container">
            <h2>Tonton Podcast LatihHobi</h2>
            <div class="podcast-grid">
                @php
                    $featuredPodcasts = \App\Models\Podcast::active()->featured()->ordered()->limit(3)->get();
                @endphp
                @forelse($featuredPodcasts as $podcast)
                    <div class="podcast-item" data-youtube-id="{{ $podcast->youtube_id }}">
                        <div class="podcast-thumbnail">
                            @if ($podcast->embed_url)
                                <div class="video-embed-wrapper">
                                    <iframe src="{{ $podcast->embed_url }}" frameborder="0" allowfullscreen loading="lazy"
                                        title="{{ $podcast->title }}" class="embedded-podcast"></iframe>
                                </div>
                            @else
                                <img src="{{ $podcast->thumbnail_url }}" alt="{{ $podcast->title }}"
                                    class="thumbnail-img">
                                <div class="podcast-overlay">
                                    <h4>{{ Str::limit($podcast->title, 20) }}</h4>
                                    <p>{{ Str::limit($podcast->description, 30) }}</p>
                                    <span>{{ $podcast->duration }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="podcast-info">
                            <h3>{{ $podcast->title }}</h3>
                            <p>{{ $podcast->host }}</p>
                        </div>
                    </div>
                @empty
                    <div class="podcast-item">
                        <div class="podcast-thumbnail">
                            <img src="{{ asset('images/placeholder-gallery-1.svg') }}" alt="Podcast LatihHobi"
                                class="thumbnail-img">
                        </div>
                        <div class="podcast-info">
                            <h3>Latih Hobi</h3>
                            <p>LatihHobi membahas tentang bagaimana cara mengembangkan bakat anak</p>
                        </div>
                    </div>
                    <div class="podcast-item">
                        <div class="podcast-thumbnail">
                            <img src="{{ asset('images/placeholder-gallery-2.svg') }}" alt="Podcast LatihHobi"
                                class="thumbnail-img">
                        </div>
                        <div class="podcast-info">
                            <h3>Latih Hobi</h3>
                            <p>LatihHobi membahas tentang bagaimana cara mengembangkan bakat anak</p>
                        </div>
                    </div>
                    <div class="podcast-item">
                        <div class="podcast-thumbnail">
                            <img src="{{ asset('images/placeholder-gallery-3.svg') }}" alt="Podcast LatihHobi"
                                class="thumbnail-img">
                        </div>
                        <div class="podcast-info">
                            <h3>Latih Hobi</h3>
                            <p>LatihHobi membahas tentang bagaimana cara mengembangkan bakat anak</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sekolah Section -->
    <section class="sekolah-section">
        <div class="sekolah-container">
            <h2>Sekolah yang sudah bekerjasama</h2>
            <div class="sekolah-content">
                <div class="sekolah-image-wrapper">
                    <img src="{{ asset('images/Kerjasama Dengan Sekolah.png') }}" alt="Sekolah yang sudah bekerjasama"
                        class="sekolah-cooperation-image">
                </div>
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
        /* Additional Styles for Updated Design */

        /* Services Section Update */
        .service-card {
            background: #00a8e6;
            color: white;
            padding: 2rem 1.5rem;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80px;
        }

        .service-card h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        /* Private Class Cards Update */
        .private-card-image {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px 15px 0 0;
        }

        .private-card-image img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        /* E-Course Cards Update */
        .ecourse-card {
            display: block;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .ecourse-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .ecourse-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* Komunitas & Club Section Update */
        .komunitas-club {
            padding: 80px 5%;
            background: #ffffff;
        }

        .komunitas-club-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .komunitas-club h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .komunitas-club p {
            font-size: 1rem;
            color: #333;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            text-align: justify;
        }

        .komunitas-club-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .komunitas-club-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            background: #ffffff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .komunitas-club-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .club-image-wrapper {
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        .club-image-wrapper:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            border-color: #ffc107;
        }

        .club-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .btn-club-daftar {
            background: #ffc107;
            color: #2c3e50;
            padding: 0.8rem 2.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
            text-transform: capitalize;
        }

        .btn-club-daftar:hover {
            background: #ffb300;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        }

        /* Bootcamp & Workshop Section */
        .bootcamp-workshop {
            padding: 80px 5%;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }

        .bootcamp-workshop-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .bootcamp-workshop h2 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .bootcamp-workshop>.bootcamp-workshop-container>p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto 3rem;
            text-align: justify;
        }

        .bootcamp-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .bootcamp-card {
            display: block;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .bootcamp-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .bootcamp-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* Responsive Design for Bootcamp */
        @media (max-width: 1024px) {
            .bootcamp-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .bootcamp-workshop {
                padding: 60px 5%;
            }

            .bootcamp-workshop h2 {
                font-size: 2rem;
            }

            .bootcamp-workshop>.bootcamp-workshop-container>p {
                font-size: 1rem;
            }

            .bootcamp-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        /* Sekolah Section */
        .sekolah-section {
            padding: 80px 5%;
            background: #f8f9fa;
        }

        .sekolah-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .sekolah-section h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        .sekolah-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sekolah-image-wrapper {
            max-width: 1200px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .sekolah-image-wrapper:hover {
            transform: translateY(-5px);
        }

        .sekolah-cooperation-image {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
        }

        /* YouTube Modal Styles */
        .youtube-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
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
            background: rgba(0, 0, 0, 0.5);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .close-modal:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .video-container {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
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

        /* Responsive embedded podcast iframe */
        .video-embed-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 */
            background: #000;
            border-radius: 8px;
            overflow: hidden;
        }

        .video-embed-wrapper .embedded-podcast {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
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

            .sekolah-section h2 {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .sekolah-image-wrapper {
                max-width: 100%;
                margin: 0 1rem;
            }

            .komunitas-club h2 {
                font-size: 2rem;
            }

            .komunitas-club p {
                text-align: left;
                font-size: 0.95rem;
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
                    player.src =
                        `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1`;
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
