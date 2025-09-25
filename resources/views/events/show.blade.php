@extends('layout.app')

@section('title', $event->title . ' - LatihHobi')

@section('content')
    <!-- Event Header -->
    <section class="event-hero">
        <div class="event-hero-content">
            <h1>{{ $event->title }}</h1>
            <p>{{ $event->short_description ?? $event->description }}</p>
        </div>
    </section>

    <!-- Event Details -->
    <section class="event-details-section">
        <div class="event-container">
            <div class="event-content">
                <div class="event-main">
                    @if($event->image)
                    <div class="event-image">
                        <img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->title }}">
                    </div>
                    @endif
                    
                    <div class="event-description">
                        <h2>Deskripsi Event</h2>
                        <p>{!! nl2br(e($event->description)) !!}</p>
                    </div>
                    
                    <div class="event-info">
                        <h2>Informasi Event</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <strong>Tanggal:</strong>
                                <span>{{ $event->date_range }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Lokasi:</strong>
                                <span>{{ $event->location ?? 'Online' }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Harga:</strong>
                                <span>
                                    @if($event->is_free)
                                        GRATIS
                                    @else
                                        Rp{{ number_format($event->price, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <strong>Kapasitas:</strong>
                                <span>{{ $event->capacity ?? 'Tidak dibatasi' }} peserta</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="event-sidebar">
                    <div class="event-registration">
                        <h3>Registrasi</h3>
                        @if($event->is_free)
                            <button class="btn-register">Daftar Sekarang (GRATIS)</button>
                        @else
                            <div class="price">Rp{{ number_format($event->price, 0, ',', '.') }}</div>
                            <button class="btn-register">Daftar Sekarang</button>
                        @endif
                    </div>
                    
                    <div class="event-share">
                        <h3>Bagikan Event</h3>
                        <div class="share-buttons">
                            <a href="#" class="share-btn">📱 WhatsApp</a>
                            <a href="#" class="share-btn">📘 Facebook</a>
                            <a href="#" class="share-btn">🐦 Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Events -->
    @if($relatedEvents->count() > 0)
    <section class="related-events">
        <div class="event-container">
            <h2>Event Lainnya</h2>
            <div class="event-grid">
                @foreach($relatedEvents as $relatedEvent)
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">📅</span>
                    </div>
                    <h3>{{ $relatedEvent->title }}</h3>
                    <p>{{ Str::limit($relatedEvent->short_description ?? $relatedEvent->description, 100) }}</p>
                    <a href="{{ route('events.show', $relatedEvent) }}" class="btn-event">Lihat Detail</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <style>
        .event-details-section {
            padding: 4rem 5%;
            background: #f8f9fa;
        }
        
        .event-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .event-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        
        .event-main {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .event-image {
            margin-bottom: 2rem;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .event-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .event-description h2,
        .event-info h2 {
            font-size: 1.5rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .event-description p {
            line-height: 1.8;
            color: #4a5568;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .event-sidebar {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: sticky;
            top: 100px;
        }
        
        .event-registration h3,
        .event-share h3 {
            font-size: 1.25rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin: 1rem 0;
            text-align: center;
        }
        
        .btn-register {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-bottom: 2rem;
        }
        
        .btn-register:hover {
            background: #0056b3;
        }
        
        .share-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .share-btn {
            background: #f8f9fa;
            color: #4a5568;
            text-decoration: none;
            padding: 0.75rem;
            border-radius: 6px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .share-btn:hover {
            background: #e9ecef;
        }
        
        .related-events {
            padding: 4rem 5%;
            background: white;
        }
        
        .related-events h2 {
            font-size: 2rem;
            color: #2d3748;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .event-content {
                grid-template-columns: 1fr;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection