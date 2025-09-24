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

                @php
                    $isEmailConfigured = config('mail.mailers.smtp.username') && 
                                       config('mail.mailers.smtp.username') !== 'your-email@gmail.com' &&
                                       config('mail.mailers.smtp.password') && 
                                       config('mail.mailers.smtp.password') !== 'your-app-password';
                @endphp

                @if($isEmailConfigured)
                    <p style="text-align: center; color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">
                        Terima kasih telah mendaftar! Kami telah mengirimkan link verifikasi ke email Anda.
                    </p>

                    <p style="text-align: center; color: #6b7280; margin-bottom: 2rem; line-height: 1.6;">
                        Silakan cek inbox email Anda dan klik link verifikasi untuk mengaktifkan akun.
                    </p>
                @else
                    <div style="background: #fef3c7; border: 1px solid #fde68a; border-radius: 8px; padding: 1rem; margin-bottom: 2rem;">
                        <p style="text-align: center; color: #92400e; margin-bottom: 1rem; font-weight: 600;">
                            ⚠️ Email Belum Dikonfigurasi
                        </p>
                        <p style="text-align: center; color: #92400e; margin-bottom: 1rem; line-height: 1.6; font-size: 0.9rem;">
                            Sistem email belum dikonfigurasi dengan benar. Email verifikasi tidak dapat dikirim.
                        </p>
                        <p style="text-align: center; color: #92400e; margin-bottom: 1rem; line-height: 1.6; font-size: 0.9rem;">
                            Silakan hubungi administrator atau gunakan verifikasi manual di bawah ini.
                        </p>
                        <div style="text-align: center;">
                            <a href="{{ route('email.config.check') }}" 
                               style="display: inline-block; background: #f59e0b; color: white; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-size: 0.9rem;">
                                <i class="fas fa-cog"></i>
                                Cek Konfigurasi Email
                            </a>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session('error'))
                    <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary" style="margin-bottom: 1rem;">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                @if (app()->environment('local'))
                    <div style="margin-top: 1rem; padding: 1rem; background: #f3f4f6; border-radius: 8px; border: 1px solid #d1d5db;">
                        <p style="font-size: 0.9rem; color: #6b7280; margin-bottom: 0.5rem;">
                            <strong>Mode Development:</strong> Untuk testing, Anda dapat memverifikasi email secara manual:
                        </p>
                        <a href="{{ route('manual.verify') }}" 
                           style="display: inline-block; background: #10b981; color: white; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i>
                            Verifikasi Manual (Testing Only)
                        </a>
                    </div>
                @endif

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
