@extends('layout.app')

@section('title', 'Podcast LatihHobi - Tonton Video Pembelajaran')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="/ekskul-reguler">Ekskul Reguler</a></li>
                <li class="nav-item"><a href="/ecourse">E-course</a></li>
                <li class="nav-item"><a href="/event">Event</a></li>
                <li class="nav-item"><a href="/podcasts" class="active">Podcast</a></li>
            </ul>
            <div class="user-menu">
                @auth
                    <span class="username">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-signin">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-signin">Sign in</a>
                    <a href="{{ route('register') }}" class="btn-signup">Sign up</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Podcast Hero Section -->
    <section class="podcast-hero">
        <div class="podcast-container">
            <div class="hero-content">
                <h1>TONTON PODCAST LATIH HOBI</h1>
                <p>Nikmati konten pembelajaran menarik melalui podcast video yang dapat Anda tonton langsung di website ini</p>
            </div>
        </div>
    </section>

    <!-- Podcast Grid Section -->
    <section class="podcast-grid-section">
        <div class="podcast-container">
            <div class="podcast-grid">
                @foreach($podcasts as $podcast)
                <div class="podcast-card" data-podcast-id="{{ $podcast->id }}">
                    <div class="podcast-thumbnail">
                        <img src="{{ $podcast->thumbnail_url }}" alt="{{ $podcast->title }}" class="thumbnail-img">
                        <div class="play-overlay">
                            <div class="play-button" data-youtube-id="{{ $podcast->youtube_id }}">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="duration-badge">{{ $podcast->duration }}</div>
                    </div>
                    <div class="podcast-info">
                        <h3 class="podcast-title">{{ $podcast->title }}</h3>
                        <p class="podcast-description">{{ Str::limit($podcast->description, 100) }}</p>
                        <div class="podcast-meta">
                            <span class="host">👤 {{ $podcast->host }}</span>
                            @if($podcast->guest)
                                <span class="guest">👥 {{ $podcast->guest }}</span>
                            @endif
                            <span class="views">👁 {{ number_format($podcast->views) }} views</span>
                        </div>
                        <div class="podcast-topics">
                            @if($podcast->topics)
                                @foreach($podcast->topics as $topic)
                                    <span class="topic-tag">{{ $topic }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="podcast-actions">
                            <a href="{{ route('podcasts.show', $podcast) }}" class="btn-watch">Tonton Sekarang</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $podcasts->links() }}
            </div>
        </div>
    </section>

    <!-- YouTube Modal -->
    <div id="youtubeModal" class="youtube-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="video-container">
                <iframe id="youtubePlayer" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <style>
        .podcast-hero {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
        }

        .podcast-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .podcast-grid-section {
            padding: 4rem 5%;
            background: #f8f9fa;
        }

        .podcast-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .podcast-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .podcast-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .podcast-thumbnail {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .thumbnail-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .podcast-card:hover .play-overlay {
            opacity: 1;
        }

        .play-button {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .play-button:hover {
            transform: scale(1.1);
        }

        .play-button i {
            font-size: 1.5rem;
            color: #007bff;
            margin-left: 3px;
        }

        .duration-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .podcast-info {
            padding: 1.5rem;
        }

        .podcast-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .podcast-description {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .podcast-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .podcast-topics {
            margin-bottom: 1rem;
        }

        .topic-tag {
            display: inline-block;
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .btn-watch {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-watch:hover {
            background: #0056b3;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }

        /* YouTube Modal */
        .youtube-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            position: relative;
            margin: 5% auto;
            width: 90%;
            max-width: 800px;
            height: 80%;
        }

        .close-modal {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }

        .close-modal:hover {
            opacity: 0.7;
        }

        .video-container {
            width: 100%;
            height: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .podcast-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                height: 70%;
                margin: 10% auto;
            }
        }
    </style>

    <script>
        // YouTube Modal functionality
        const modal = document.getElementById('youtubeModal');
        const player = document.getElementById('youtubePlayer');
        const closeModal = document.querySelector('.close-modal');
        const playButtons = document.querySelectorAll('.play-button');

        playButtons.forEach(button => {
            button.addEventListener('click', function() {
                const youtubeId = this.getAttribute('data-youtube-id');
                player.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`;
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });

        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            player.src = '';
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                player.src = '';
                document.body.style.overflow = 'auto';
            }
        });
    </script>
@endsection
