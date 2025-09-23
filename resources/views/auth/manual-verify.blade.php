
@extends('layout.app')

@section('title', 'Manual Email Verification')

@section('content')
<div style="display:flex;justify-content:center;align-items:center;min-height:80vh;background:#f8fafc;">
    <div style="background:#fff;padding:40px 32px;border-radius:16px;box-shadow:0 4px 16px rgba(0,0,0,0.08);max-width:500px;width:100%;">
        <div style="text-align:center;margin-bottom:32px;">
            <h1 style="font-size:2rem;font-weight:700;color:#2563eb;margin-bottom:12px;">📧 Email Verification</h1>
            <p style="color:#374151;font-size:1rem;">Solusi untuk masalah verifikasi email</p>
        </div>

        @if(session('success'))
            <div style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;border-radius:8px;padding:16px;margin-bottom:24px;">
                <strong>✅ {{ session('success') }}</strong>
            </div>
        @endif

        @if(session('info'))
            <div style="background:#dbeafe;color:#1e40af;border:1px solid #93c5fd;border-radius:8px;padding:16px;margin-bottom:24px;">
                <strong>ℹ️ {{ session('info') }}</strong>
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;padding:16px;margin-bottom:24px;">
                @foreach($errors->all() as $error)
                    <strong>❌ {{ $error }}</strong><br>
                @endforeach
            </div>
        @endif

        <div style="margin-bottom:24px;">
            <h3 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;">🔧 Manual Verification</h3>
            <p style="color:#6b7280;font-size:0.875rem;margin-bottom:16px;">Jika Anda tidak menerima email verifikasi, gunakan form di bawah untuk verifikasi manual:</p>
            
            <form method="POST" action="{{ route('manual.verify.submit') }}">
                @csrf
                <div style="margin-bottom:16px;">
                    <label for="email" style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Email Address:</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           style="width:100%;padding:12px;border:2px solid #e5e7eb;border-radius:8px;font-size:1rem;"
                           placeholder="Masukkan email Anda">
                </div>
                <button type="submit" 
                        style="width:100%;background:#10b981;color:#fff;padding:12px;border:none;border-radius:8px;font-weight:600;font-size:1rem;">
                    ✅ Verifikasi Email Manual
                </button>
            </form>
        </div>

        <div style="border-top:1px solid #e5e7eb;padding-top:24px;">
            <h3 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;">📞 Kontak Support</h3>
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <a href="mailto:multimedia.latihhobi@gmail.com" 
                   style="background:#2563eb;color:#fff;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;font-size:0.875rem;">
                    📧 Email Admin
                </a>
                <a href="{{ route('login') }}" 
                   style="background:#6b7280;color:#fff;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;font-size:0.875rem;">
                    🔙 Kembali Login
                </a>
            </div>
        </div>

        <div style="margin-top:24px;padding:16px;background:#f3f4f6;border-radius:8px;">
            <h4 style="font-size:1rem;font-weight:600;color:#374151;margin-bottom:8px;">💡 Tips:</h4>
            <ul style="color:#6b7280;font-size:0.875rem;margin:0;padding-left:20px;">
                <li>Cek folder spam/junk email</li>
                <li>Pastikan email address benar</li>
                <li>Gunakan manual verification jika email tidak sampai</li>
                <li>Hubungi admin jika masih bermasalah</li>
            </ul>
        </div>
    </div>
</div>
@endsection
