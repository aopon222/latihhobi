
@extends('layout.app')

@section('title', 'Manual Email Verification')

@section('content')
<div style="display:flex;justify-content:center;align-items:center;min-height:80vh;">
    <div style="background:#fff;padding:40px 32px;border-radius:16px;box-shadow:0 4px 16px rgba(0,0,0,0.08);max-width:400px;width:100%;text-align:center;">
        <h1 style="font-size:2rem;font-weight:700;color:#2563eb;margin-bottom:18px;">Manual Email Verification</h1>
        <p style="color:#374151;font-size:1rem;margin-bottom:24px;">Silakan cek email Anda untuk link verifikasi.<br>Jika belum menerima email, klik tombol di bawah atau hubungi admin.</p>
        <a href="mailto:multimedia.latihhobi@gmail.com" style="display:inline-block;background:#2563eb;color:#fff;padding:12px 32px;border-radius:8px;font-weight:600;text-decoration:none;">Hubungi Admin</a>
    </div>
</div>
@endsection
