@extends('layout.app')

@section('title', 'Podcast LatihHobi - Tonton Video Pembelajaran')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/podcast.css') }}">
@endpush

@section('content')
    @include('layout.navbar')

    <!-- Podcast Hero Section -->
    <section class="podcast-hero">
        <div class="podcast-container">
            <div class="hero-content">
                <h1>TONTON PODCAST LATIH HOBI</h1>
                <p>Nikmati konten pembelajaran menarik melalui podcast video yang dapat Anda tonton langsung di website ini
                </p>
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
@endsection

@push('scripts')
<script src="{{ asset('js/podcast.js') }}"></script>
@endpush