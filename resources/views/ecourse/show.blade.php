@extends('layout.app')

@section('title', '{{ $course->name }} - LatihHobi')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px;">
        <!-- Course Image -->
        <div>
            <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>

        <!-- Course Info -->
        <div>
            <div style="margin-bottom: 20px;">
                <h1 style="font-size: 2rem; margin: 0 0 10px 0; color: #333;">{{ $course->name }}</h1>
                <p style="color: #666; font-size: 1.1rem; margin: 0;">By {{ $course->course_by ?? 'Latihhobi' }}</p>
            </div>

            <!-- Category -->
            @if($course->category)
            <div style="margin-bottom: 20px;">
                <span style="display: inline-block; background: #667eea; color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.9rem;">
                    {{ $course->category->name }}
                </span>
            </div>
            @endif

            <!-- Price -->
            <div style="margin-bottom: 30px; padding: 20px; background: #f5f5f5; border-radius: 8px;">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 0.9rem;">Harga Kursus</p>
                <h2 style="margin: 0; font-size: 2.5rem; color: #667eea;">Rp {{ number_format($course->price, 0, ',', '.') }}</h2>
            </div>

            <!-- Buttons -->
            <div style="display: flex; gap: 15px; margin-bottom: 30px;">
                @auth
                    <form action="{{ route('ecourse.addToCart', $course->id_course) }}" method="POST" style="flex: 1;">
                        @csrf
                        <button type="submit" style="width: 100%; padding: 15px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="flex: 1; padding: 15px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                        🔒 Login untuk Membeli
                    </a>
                @endauth

                <a href="{{ route('ecourse.index') }}" style="flex: 1; padding: 15px; background: #e0e0e0; color: #333; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                    ← Kembali
                </a>
            </div>

            <!-- Course Stats -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                <div style="padding: 15px; background: #f9f9f9; border-radius: 8px; text-align: center;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: 0.9rem;">Peserta</p>
                    <p style="margin: 0; font-size: 1.5rem; font-weight: bold; color: #333;">{{ $course->enrolled ?? 0 }}</p>
                </div>
                <div style="padding: 15px; background: #f9f9f9; border-radius: 8px; text-align: center;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: 0.9rem;">Rating</p>
                    <p style="margin: 0; font-size: 1.5rem; font-weight: bold; color: #f5a623;">★★★★★</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Description -->
    <div style="background: white; padding: 30px; border-radius: 8px; border: 1px solid #e0e0e0;">
        <h2 style="margin-top: 0; color: #333;">Tentang Kursus Ini</h2>
        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
            Pelajari {{ $course->name }} dengan materi yang komprehensif dan praktis. Kursus ini dirancang untuk pemula hingga tingkat lanjut.
        </p>

        <h3 style="color: #333; margin-bottom: 15px;">Yang Akan Anda Dapatkan:</h3>
        <ul style="color: #666; line-height: 1.8;">
            @if($course->ebook)
            <li>✅ E-book lengkap</li>
            @endif
            @if($course->worksheet)
            <li>✅ Worksheet praktis</li>
            @endif
            @if($course->live_session)
            <li>✅ Live session eksklusif</li>
            @endif
            @if($course->mini_competition)
            <li>✅ Mini competition dengan hadiah</li>
            @endif
            @if($course->certificate)
            <li>✅ Sertifikat resmi</li>
            @endif
            <li>✅ Akses seumur hidup</li>
            <li>✅ Support dari instruktur</li>
            <li>✅ Update materi gratis selamanya</li>
        </ul>

        <h3 style="color: #333; margin-bottom: 15px; margin-top: 25px;">Level Kursus:</h3>
        <p style="color: #666;">
            <span style="display: inline-block; background: #e8f5e9; color: #2e7d32; padding: 6px 12px; border-radius: 20px; font-size: 0.9rem;">
                {{ $course->level ?? 'Semua Level' }}
            </span>
        </p>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#d4edda;color:#155724;padding:12px 18px;border-radius:8px;border:1px solid #c3e6cb;">
            {!! session('success') !!}
        </div>
    </div>
@endif

@if(session('info'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#d1ecf1;color:#0c5460;padding:12px 18px;border-radius:8px;border:1px solid #bee5eb;">
            {!! session('info') !!}
        </div>
    </div>
@endif

@if(session('error'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#f8d7da;color:#721c24;padding:12px 18px;border-radius:8px;border:1px solid #f5c6cb;">
            {!! session('error') !!}
        </div>
    </div>
@endif

@endsection
