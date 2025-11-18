@extends('layout.app')

@section('title', 'Event - LatihHobi')

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
                        <img src="{{ asset('images/Event LHEC.png') }}" alt="LHEC 2025"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                    </div>
                    <h3>LHEC IV 2025</h3>
                    <p>Latih Hobi Expo & Competition 2025. Kompetisi robotik, komik, panahan, foto & video tingkat nasional.
                        25-27 Desember 2025.</p>
                    <a href="/lhec2025" class="btn-event">Lihat Detail</a>
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
                    <p>Kelas seru selama liburan sekolah untuk mengisi waktu dengan kegiatan yang bermanfaat dan
                        menyenangkan</p>
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
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">DES</span>
                        <span class="day">20</span>
                    </div>
                    <div class="event-details">
                        <h4>LHEC IV 2025 - Batas Akhir Pendaftaran</h4>
                        <p>Pendaftaran kompetisi robotik, komik, panahan, foto & video tingkat nasional akan segera ditutup.
                            Jangan sampai terlewat!</p>
                        <span class="event-status">Pendaftaran Dibuka</span>
                    </div>
                </div>
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">DES</span>
                        <span class="day">22</span>
                    </div>
                    <div class="event-details">
                        <h4>Technical Meeting LHEC IV 2025</h4>
                        <p>Briefing teknis untuk semua peserta LHEC IV 2025. Wajib dihadiri oleh semua tim yang telah
                            terdaftar.</p>
                        <span class="event-status">Coming Soon</span>
                    </div>
                </div>
                <div class="event-item">
                    <div class="event-date">
                        <span class="month">DES</span>
                        <span class="day">25</span>
                    </div>
                    <div class="event-details">
                        <h4>LHEC IV 2025 - Hari Kompetisi</h4>
                        <p>Kompetisi utama LHEC IV 2025 dimulai! Robotik, komik, panahan, dan foto & video. HTM: 150-250K.
                        </p>
                        <span class="event-status">Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
