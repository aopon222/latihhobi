@extends('layout.app')

@section('title', 'Profil Saya - LatihHobi')

@section('content')
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="/dashboard">Dashboard</a></li>
                <li class="nav-item"><a href="/ekskul-reguler">Ekskul Reguler</a></li>
                <li class="nav-item"><a href="/ecourse">E-course</a></li>
                <li class="nav-item"><a href="/event">Event</a></li>
            </ul>
            <div class="user-menu">
                <span class="username">{{ $user->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-signin">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Profile Content -->
    <section class="profile-hero">
        <div class="profile-container">
            <div class="profile-header">
                <h1>Profil Saya</h1>
                <p>Kelola informasi akun dan profil Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="profile-content">
                <div class="profile-card">
                    <h2>Informasi Akun</h2>
                    
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Fitur upload avatar dihapus sesuai permintaan -->

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <small style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                                ⚠️ Jika Anda mengubah email, verifikasi akan direset dan Anda perlu verifikasi email baru.
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Status Email</label>
                            <div class="status-display">
                                @if($user->hasVerifiedEmail())
                                    <span class="status verified">✅ Email Terverifikasi</span>
                                @else
                                    <span class="status unverified">❌ Email Belum Terverifikasi</span>
                                    <a href="{{ route('manual.verify') }}" class="btn-verify">Verifikasi Manual</a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Bergabung Sejak</label>
                            <div class="date-display">{{ $user->created_at->format('d M Y H:i') }}</div>
                        </div>

                        <button type="submit" class="btn-primary">Perbarui Profil</button>
                    </form>
                    <script>
                        function previewAvatar(event) {
                            const reader = new FileReader();
                            reader.onload = function(){
                                document.getElementById('avatarPreview').src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    </script>
                </div>

                <div class="profile-actions">
                    <div class="action-card">
                        <h3>Keamanan Akun</h3>
                        <p>Kelola keamanan dan privasi akun Anda</p>
                        <a href="{{ route('password.change.form') }}" class="btn-secondary">🔐 Ubah Password</a>
                    </div>

                    <div class="action-card">
                        <h3>Email Status</h3>
                        <p>Cek status email dan troubleshooting</p>
                        <a href="{{ route('email.status') }}" class="btn-secondary">📧 Email Status</a>
                    </div>

                    <div class="action-card">
                        <h3>Verifikasi Manual</h3>
                        <p>Jika email verifikasi tidak diterima</p>
                        <a href="{{ route('manual.verify') }}" class="btn-secondary">✅ Verifikasi Manual</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .profile-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
            min-height: 100vh;
        }

        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .profile-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .profile-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .profile-card h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255,255,255,0.1);
            color: white;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: rgba(255,255,255,0.5);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.1);
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .status-display {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .status.verified {
            color: #10b981;
            font-weight: 500;
        }

        .status.unverified {
            color: #f59e0b;
            font-weight: 500;
        }

        .btn-verify {
            background: #f59e0b;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }

        .btn-verify:hover {
            background: #d97706;
        }

        .role-display, .date-display {
            color: rgba(255,255,255,0.8);
            padding: 0.5rem 0;
        }

        .btn-primary {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #5a67d8;
        }

        .profile-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .action-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .action-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .action-card p {
            margin-bottom: 1rem;
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
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

        .error-message {
            color: #f87171;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: rgba(248, 113, 113, 0.5) !important;
        }

        @media (max-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
