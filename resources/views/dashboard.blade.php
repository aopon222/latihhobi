@extends('layout.app')

@section('title', 'Dashboard - LatihHobi')

@section('content')
    <section class="dashboard-hero">
        <div class="dashboard-container">
            <div class="welcome-section">
                <h1>Selamat Datang, {{ $user->name }}!</h1>
                <p>Kelola pembelajaran dan eksplorasi bakat Anda di LatihHobi</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Stats Section -->
            <div class="stats-section">
                <h2>Statistik Anda</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📚</div>
                        <div class="stat-value">{{ $stats['ecourses_enrolled'] }}</div>
                        <div class="stat-label">E-Course Diikuti</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">🎯</div>
                        <div class="stat-value">{{ $stats['events_attended'] }}</div>
                        <div class="stat-label">Event Diikuti</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">📈</div>
                        <div class="stat-value">{{ $stats['learning_progress'] }}%</div>
                        <div class="stat-label">Progress Belajar</div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="quick-access-section">
                <h2>Akses Cepat</h2>
                <div class="quick-access-grid">
                    @foreach($quickAccess as $item)
                    <a href="{{ $item['url'] }}" class="quick-access-item">
                        <div class="quick-access-icon">{{ $item['icon'] }}</div>
                        <div class="quick-access-title">{{ $item['title'] }}</div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">📚</div>
                    <h3>E-Course Saya</h3>
                    <p>Lihat dan lanjutkan pembelajaran e-course Anda</p>
                    <a href="/ecourse" class="btn-category">Lihat E-Course</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🏫</div>
                    <h3>Ekskul Reguler</h3>
                    <p>Daftar dan ikuti ekstrakurikuler reguler</p>
                    <a href="/ekskul-reguler" class="btn-category">Lihat Ekskul</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🎯</div>
                    <h3>Event & Workshop</h3>
                    <p>Ikuti event dan workshop menarik</p>
                    <a href="/event" class="btn-category">Lihat Event</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">👤</div>
                    <h3>Profil Saya</h3>
                    <p>Kelola informasi profil dan akun Anda</p>
                    <a href="{{ route('profile') }}" class="btn-category">Kelola Profil</a>
                </div>
            </div>

            <!-- Recommended Content Section -->
            <div class="recommended-section">
                <h2>Rekomendasi untuk Anda</h2>
                <div class="recommended-grid">
                    @foreach($recommendedContent as $content)
                    <div class="recommended-card">
                        <div class="recommended-image">
                            <div class="image-placeholder">{{ $content['type'][0] }}</div>
                        </div>
                        <div class="recommended-content">
                            <div class="recommended-type">{{ $content['type'] }}</div>
                            <h3 class="recommended-title">{{ $content['title'] }}</h3>
                            <p class="recommended-description">{{ $content['description'] }}</p>
                            <button class="btn-recommended">Lihat Detail</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activities Section -->
            <div class="activities-section">
                <h2>Aktivitas Terbaru</h2>
                <div class="activities-list">
                    @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon">
                            @if($activity['type'] == 'login')
                                🔐
                            @elseif($activity['type'] == 'ecourse')
                                📚
                            @elseif($activity['type'] == 'profile')
                                👤
                            @else
                                📝
                            @endif
                        </div>
                        <div class="activity-content">
                            <div class="activity-description">{{ $activity['description'] }}</div>
                            <div class="activity-time">{{ $activity['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="user-info">
                <h2>Informasi Akun</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama:</strong> {{ $user->name }}
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="info-item">
                        <strong>Status Email:</strong>
                        @if($user->hasVerifiedEmail())
                            <span class="status verified">✅ Terverifikasi</span>
                        @else
                            <span class="status unverified">❌ Belum Terverifikasi</span>
                        @endif
                    </div>
                    <div class="info-item">
                        <strong>Role:</strong> {{ ucfirst($user->role ?? 'user') }}
                    </div>
                    <div class="info-item">
                        <strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}
                    </div>
                    @if($user->login_terakhir)
                    <div class="info-item">
                        <strong>Login Terakhir:</strong> {{ $user->login_terakhir->format('d M Y H:i') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        .dashboard-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .welcome-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Stats Section */
        .stats-section {
            margin-bottom: 3rem;
        }

        .stats-section h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Quick Access Section */
        .quick-access-section {
            margin-bottom: 3rem;
        }

        .quick-access-section h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        .quick-access-item {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1.5rem 1rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            display: block;
        }

        .quick-access-item:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
        }

        .quick-access-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .quick-access-title {
            font-size: 0.9rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .dashboard-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: white;
        }

        .dashboard-card p {
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }

        /* Recommended Content Section */
        .recommended-section {
            margin-bottom: 3rem;
        }

        .recommended-section h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .recommended-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .recommended-card:hover {
            transform: translateY(-5px);
        }

        .recommended-image {
            height: 150px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-placeholder {
            font-size: 3rem;
        }

        .recommended-content {
            padding: 1.5rem;
        }

        .recommended-type {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            color: #ffc107;
        }

        .recommended-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .recommended-description {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .btn-recommended {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-recommended:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Activities Section */
        .activities-section {
            margin-bottom: 3rem;
        }

        .activities-section h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .activities-list {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            width: 40px;
            text-align: center;
        }

        .activity-content {
            flex: 1;
        }

        .activity-description {
            margin-bottom: 0.3rem;
        }

        .activity-time {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .user-info {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .user-info h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .info-item {
            padding: 0.75rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
        }

        .status.verified {
            color: #10b981;
        }

        .status.unverified {
            color: #f59e0b;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(1, 1fr);
            }
            
            .welcome-section h1 {
                font-size: 2rem;
            }
            
            .stat-value {
                font-size: 1.5rem;
            }
            
            .quick-access-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .recommended-grid {
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
@endsection
