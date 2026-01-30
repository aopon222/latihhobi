@extends('layout.app')

@section('title', 'Events - LatihHobi')

@section('content')
    <!-- Hero Section -->
    <section class="event-hero">
        <div class="event-hero-content">
            <h1>EVENT</h1>
            <p>Ikuti berbagai event menarik dari LatihHobi untuk mengembangkan bakat dan hobi Anda</p>
        </div>
    </section>

    <!-- Event Categories -->
    <section class="event-categories">
        <div class="event-container">
            <h2>Event Terbaru</h2>
            <div class="event-grid">
                @php
                    $featuredEvents = \App\Models\Event::published()->featured()->take(3)->get();
                    if($featuredEvents->isEmpty()) {
                        $featuredEvents = \App\Models\Event::published()->take(3)->get();
                    }
                @endphp
                @foreach($featuredEvents as $event)
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">
                            @if($event->type == 'workshop')
                                💼
                            @elseif($event->type == 'competition')
                                🏆
                            @elseif($event->type == 'seminar')
                                🎓
                            @else
                                📅
                            @endif
                        </span>
                    </div>
                    <h3>{{ $event->title }}</h3>
                    <p>{{ Str::limit($event->short_description ?? $event->description, 120) }}</p>
                    <a href="{{ route('events.show', $event) }}" class="btn-event">Lihat Detail</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="upcoming-events">
        <div class="upcoming-container">
            <h2>Event Mendatang</h2>
            <div class="events-timeline">
                @foreach($events as $event)
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">{{ $event->start_date->format('M') }}</span>
                        <span class="day">{{ $event->start_date->format('d') }}</span>
                    </div>
                    <div class="event-details">
                        <h4>{{ $event->title }}</h4>
                        <p>{{ Str::limit($event->short_description ?? $event->description, 100) }}</p>
                        <span class="event-status">
                            @if($event->price == 0 || $event->price == null)
                                GRATIS
                            @else
                                Rp{{ number_format($event->price, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    <a href="{{ route('events.show', $event) }}" class="btn-event">Lihat Detail</a>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $events->links() }}
            </div>
        </div>
    </section>
@endsection