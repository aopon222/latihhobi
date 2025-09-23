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
            <div class="event-grid">
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">🏆</span>
                    </div>
                    <h3>LHEC IV 2025</h3>
                    <p>Kompetisi robotik tingkat nasional yang menantang kreativitas dan inovasi anak-anak Indonesia</p>
                    <a href="#lhec" class="btn-event">Lihat Detail</a>
                </div>
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">💼</span>
                    </div>
                    <h3>WORKSHOP & BOOTCAMP</h3>
                    <p>Program intensif untuk mengembangkan keterampilan dalam berbagai bidang teknologi dan kreativitas</p>
                    <a href="#workshop" class="btn-event">Lihat Detail</a>
                </div>
                <div class="event-category">
                    <div class="event-icon">
                        <span class="event-emoji">🎉</span>
                    </div>
                    <h3>HOLIDAY FUN CLASS</h3>
                    <p>Kelas seru selama liburan sekolah untuk mengisi waktu dengan kegiatan yang bermanfaat dan menyenangkan</p>
                    <a href="#holiday" class="btn-event">Lihat Detail</a>
                </div>
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
                            @if($event->is_free)
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