@php $hideNavbar = true; @endphp
@extends('layout.app')

@section('title', 'Dashboard Admin - LatihHobi')

@section('content')
<div style="min-height:100vh;background:#f8fafc;display:flex;">
    <!-- Sidebar -->
    <aside style="width:240px;background:#fff;border-right:1px solid #e5e7eb;box-shadow:0 2px 8px rgba(0,0,0,0.04);display:flex;flex-direction:column;align-items:center;padding:32px 0;">
        <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" style="height:48px;margin-bottom:32px;">
        <nav style="width:100%;">
            <a href="{{ route('admin.dashboard') }}" style="display:block;padding:12px 32px;color:#2563eb;font-weight:600;text-decoration:none;border-radius:8px;margin-bottom:8px;background:#e0e7ff;">Dashboard</a>
            <a href="{{ route('admin.ecourses.index') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">E-course</a>
            <a href="{{ route('admin.podcasts.index') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Podcast</a>
            <a href="#" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Event</a>
            <a href="{{ route('password.change.form') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">🔐 Ganti Password</a>
            <a href="{{ route('home') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Kembali ke Website</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <main style="flex:1;padding:48px 32px;">
        <h1 style="font-size:2rem;font-weight:700;color:#2563eb;margin-bottom:24px;">Dashboard Admin</h1>
        <div style="background:#fff;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;margin-bottom:12px;">Selamat datang di Dashboard LatihHobi!</h2>
            <p style="color:#374151;font-size:1rem;margin-bottom:24px;">Kelola produk, event, podcast, dan konten website LatihHobi dengan mudah melalui menu di samping.</p>
            
            <!-- Quick Stats -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:20px;margin-top:24px;">
                <div style="background:#e0e7ff;padding:20px;border-radius:12px;">
                    <h3 style="color:#3730a3;font-size:14px;font-weight:600;margin:0 0 8px 0;">TOTAL E-COURSE</h3>
                    <p style="color:#1e1b4b;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\Ecourse::count() }}</p>
                </div>
                
                <div style="background:#dcfce7;padding:20px;border-radius:12px;">
                    <h3 style="color:#166534;font-size:14px;font-weight:600;margin:0 0 8px 0;">E-COURSE AKTIF</h3>
                    <p style="color:#14532d;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\Ecourse::where('is_active', true)->count() }}</p>
                </div>
                
                <div style="background:#fef3c7;padding:20px;border-radius:12px;">
                    <h3 style="color:#92400e;font-size:14px;font-weight:600;margin:0 0 8px 0;">FEATURED COURSE</h3>
                    <p style="color:#78350f;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\Ecourse::where('is_featured', true)->count() }}</p>
                </div>
                
                <div style="background:#fee2e2;padding:20px;border-radius:12px;">
                    <h3 style="color:#991b1b;font-size:14px;font-weight:600;margin:0 0 8px 0;">TOTAL PENDAFTARAN</h3>
                    <p style="color:#7f1d1d;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\EcourseEnrollment::count() }}</p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
