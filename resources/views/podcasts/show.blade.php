@extends('layout.app')

@section('title', $podcast->title . ' - Podcast LatihHobi')

@section('content')
    @include('layout.navbar')

    <!-- Podcast Detail Section -->
    <section class="podcast-detail-section">
        <div class="podcast-container">
            <div class="podcast-detail-grid">
                <!-- Main Video -->
                <div class="main-video">
                    <div class="video-container">
                        <iframe 
                            src="{{ $podcast->embed_url }}" 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    
                    <div class="video-info">
                        <h1 class="video-title">{{ $podcast->title }}</h1>
                        <div class="video-meta">
                            <!-- views removed -->
                            <span class="duration">⏱ {{ $podcast->duration }}</span>
                            <span class="date">📅 {{ $podcast->published_date->format('d M Y') }}</span>
                        </div>
                        <div class="video-description">
                            <p>{{ $podcast->description }}</p>
                        </div>
                        <div class="video-participants">
                            <div class="participant">
                                <strong>Host:</strong> {{ $podcast->host }}
                            </div>
                            @if($podcast->guest)
                            <div class="participant">
                                <strong>Guest:</strong> {{ $podcast->guest }}
                            </div>
                            @endif
                        </div>
                        <div class="video-topics">
                            <strong>Topics:</strong>
                            @if($podcast->topics)
                                @foreach($podcast->topics as $topic)
                                    <span class="topic-tag">{{ $topic }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related Podcasts -->
                <div class="related-podcasts">
                    <h3>Podcast Terkait</h3>
                    @foreach($relatedPodcasts as $related)
                    <div class="related-card">
                        <div class="related-thumbnail">
                            <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}">
                            <div class="related-duration">{{ $related->duration }}</div>
                        </div>
                        <div class="related-info">
                            <h4><a href="{{ route('podcasts.show', $related) }}">{{ $related->title }}</a></h4>
                            <p>{{ Str::limit($related->description, 80) }}</p>
                            <div class="related-meta">
                                <!-- views removed -->
                                <span>{{ $related->published_date->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .podcast-detail-section {
            padding: 8rem 5% 4rem;
            margin-top: 70px;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .podcast-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .podcast-detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .main-video {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .video-container {
            position: relative;
            width: 100%;
            height: 400px;
            background: #000;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
        }

        .video-info {
            padding: 1.5rem;
        }

        .video-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .video-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .video-description {
            margin-bottom: 1.5rem;
        }

        .video-description p {
            color: #4a5568;
            line-height: 1.6;
        }

        .video-participants {
            margin-bottom: 1.5rem;
        }

        .participant {
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .video-topics {
            margin-bottom: 1rem;
        }

        .video-topics strong {
            color: #2d3748;
            margin-right: 0.5rem;
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

        .related-podcasts {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .related-podcasts h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .related-card {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .related-card:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .related-thumbnail {
            position: relative;
            width: 120px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .related-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-duration {
            position: absolute;
            bottom: 4px;
            right: 4px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 0.125rem 0.25rem;
            border-radius: 3px;
            font-size: 0.7rem;
        }

        .related-info {
            flex: 1;
        }

        .related-info h4 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .related-info h4 a {
            color: #2d3748;
            text-decoration: none;
        }

        .related-info h4 a:hover {
            color: #007bff;
        }

        .related-info p {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .related-meta {
            font-size: 0.7rem;
            color: #999;
            display: flex;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .podcast-detail-grid {
                grid-template-columns: 1fr;
            }

            .video-container {
                height: 250px;
            }

            .related-card {
                flex-direction: column;
            }

            .related-thumbnail {
                width: 100%;
                height: 150px;
            }
        }
    </style>
@endsection
