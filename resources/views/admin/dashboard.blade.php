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
                    <h3 style="color:#166534;font-size:14px;font-weight:600;margin:0 0 8px 0;">TOTAL KATEGORI</h3>
                    <p style="color:#14532d;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\Category::count() }}</p>
                </div>
                
                <div style="background:#fef3c7;padding:20px;border-radius:12px;">
                    <h3 style="color:#92400e;font-size:14px;font-weight:600;margin:0 0 8px 0;">E-COURSE TERSEDIA</h3>
                    <p style="color:#78350f;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\Ecourse::whereNotNull('id_category')->count() }}</p>
                </div>
                
                <div style="background:#fee2e2;padding:20px;border-radius:12px;">
                    <h3 style="color:#991b1b;font-size:14px;font-weight:600;margin:0 0 8px 0;">TOTAL PENDAFTARAN</h3>
                    <p style="color:#7f1d1d;font-size:24px;font-weight:700;margin:0;">{{ \App\Models\EcourseEnrollment::count() }}</p>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div style="margin-top:24px;display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                <a href="{{ route('admin.ecourses.create') }}" style="background:#2563eb;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;">
                    + Tambah E-course
                </a>
                <a href="{{ route('admin.ecourses.index') }}" style="background:#6b7280;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;">
                    Kelola E-course
                </a>
            </div>

            <!-- Recent E-courses (quick manage) -->
            <div style="margin-top:28px;background:#fff;border-radius:12px;padding:18px;border:1px solid #eef2ff;">
                <h3 style="margin:0 0 12px 0;font-size:1rem;font-weight:700;color:#111827;">E-course Terbaru</h3>
                @php $latest = \App\Models\Ecourse::orderBy('created_at','desc')->take(5)->get(); @endphp
                @if($latest->isEmpty())
                    <p style="color:#6b7280;margin:0;">Belum ada e-course.</p>
                @else
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="text-align:left;border-bottom:1px solid #eef2ff;">
                                <th style="padding:10px 8px;font-weight:600;color:#374151;">Judul</th>
                                <th style="padding:10px 8px;font-weight:600;color:#374151;">Harga</th>
                                <th style="padding:10px 8px;font-weight:600;color:#374151;">Tanggal</th>
                                <th style="padding:10px 8px;font-weight:600;color:#374151;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest as $ec)
                                <tr style="border-bottom:1px solid #f8fafc;">
                                    <td style="padding:10px 8px;">{{ $ec->name }}</td>
                                    <td style="padding:10px 8px;">Rp {{ number_format($ec->price,0,',','.') }}</td>
                                    <td style="padding:10px 8px;">{{ $ec->created_at->format('Y-m-d') }}</td>
                                    <td style="padding:10px 8px;">
                                        <a href="{{ route('admin.ecourses.edit', $ec) }}" style="background:#f59e0b;color:white;padding:6px 10px;border-radius:6px;text-decoration:none;margin-right:8px;">Edit</a>
                                        <form method="POST" action="{{ route('admin.ecourses.destroy', $ec) }}" style="display:inline-block;margin:0;" onsubmit="return confirm('Hapus e-course {{ addslashes($ec->name) }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:#ef4444;color:white;padding:6px 10px;border-radius:6px;border:none;cursor:pointer;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
