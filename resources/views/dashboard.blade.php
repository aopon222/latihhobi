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
                        <strong>Role:</strong> {{ ucfirst($user->role) }}
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
    </style>
@endsection
