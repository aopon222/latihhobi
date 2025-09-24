

@extends('layout.app')

@section('title', 'Sign up - LatihHobi')

@section('content')
@php $hideNavbar = true; @endphp
<div style="display:flex;min-height:100vh;background:#fff;">
    <div style="flex:1;background:url('{{ asset('images/trophy-bg.jpg') }}') center/cover no-repeat;min-height:100vh;"></div>
    <div style="flex:1;display:flex;align-items:center;justify-content:center;">
        <div style="width:100%;max-width:400px;margin:0 auto;padding:40px 32px;background:#fff;border-radius:24px;box-shadow:0 8px 32px rgba(37,99,235,0.10);">
            <div style="text-align:center;margin-bottom:32px;">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" style="height:54px;margin-bottom:12px;">
                <h2 style="font-weight:700;font-size:2rem;letter-spacing:0.5px;margin-bottom:8px;">Create Account</h2>
            </div>
            @if ($errors->any())
                <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                    <ul style="margin-left:1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div style="background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd;border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div style="margin-bottom:18px;">
                    <input id="name" name="name" type="text" style="width:100%;padding:12px;border-radius:10px;border:1px solid #d1d5db;font-size:1rem;" value="{{ old('name') }}" required autofocus placeholder="Full Name">
                </div>
                <div style="margin-bottom:18px;">
                    <input id="email" name="email" type="email" style="width:100%;padding:12px;border-radius:10px;border:1px solid #d1d5db;font-size:1rem;" value="{{ old('email') }}" required placeholder="Email">
                </div>
                <div style="margin-bottom:18px;">
                    <input id="password" name="password" type="password" style="width:100%;padding:12px;border-radius:10px;border:1px solid #d1d5db;font-size:1rem;" required placeholder="Password">
                </div>
                <div style="margin-bottom:18px;">
                    <input id="password_confirmation" name="password_confirmation" type="password" style="width:100%;padding:12px;border-radius:10px;border:1px solid #d1d5db;font-size:1rem;" required placeholder="Confirm Password">
                </div>
                <button type="submit" style="width:100%;background:#2563eb;color:#fff;padding:14px 0;border:none;border-radius:10px;font-weight:700;font-size:1.1rem;box-shadow:0 2px 8px rgba(37,99,235,0.08);margin-bottom:8px;">Create account</button>
            </form>
            <div style="margin-top:18px;text-align:center;font-size:1rem;">
                Sudah punya akun? <a href="{{ route('login') }}" style="color:#2563eb;text-decoration:underline;font-weight:500;">Login</a>
                <div style="margin-top:18px;">
                    <a href="{{ route('home') }}" style="display:inline-block;background:#fff;border-radius:50px;padding:10px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.08);font-weight:500;color:#2563eb;text-decoration:none;transition:box-shadow 0.2s;">← Kembali ke halaman</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
