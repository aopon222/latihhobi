@extends('layout.app')

@section('title', 'Verifikasi Email - LatihHobi')

@section('content')
    <section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" class="auth-logo">
                <h2>Verifikasi Email</h2>
            </div>

            <div class="verification-content">
                <div class="verification-icon">
                    <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                </div>

                <p style="text-align: center; color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">
                    Terima kasih telah mendaftar! Kami telah mengirimkan link verifikasi ke email Anda.
                </p>

                <p style="text-align: center; color: #6b7280; margin-bottom: 2rem; line-height: 1.6;">
                    Silakan cek inbox email Anda dan klik link verifikasi untuk mengaktifkan akun.
                </p>

                @if (session('success'))
                    <div style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary" style="margin-bottom: 1rem;">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <div class="auth-footer" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('home') }}" class="back-to-home">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .verification-content {
            text-align: center;
        }

        .verification-icon {
            margin-bottom: 1rem;
        }

        .btn-primary i {
            margin-right: 0.5rem;
        }
    </style>
@endsection
