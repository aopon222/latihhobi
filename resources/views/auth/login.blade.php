@extends('layout.app')

@section('title', 'Sign in - LatihHobi')

@section('content')
<<<<<<< HEAD
    <section class="ecourse-hero">
        <div class="ecourse-hero-content">
            <h1>Sign in</h1>
        </div>
    </section>

    <section class="ecourse-categories">
        <div class="ecourse-container" style="max-width:480px;margin:0 auto;">
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

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="padding:0.8rem 1rem;border:1px solid #e5e7eb;border-radius:8px;">
                    <input type="password" name="password" placeholder="Password" required style="padding:0.8rem 1rem;border:1px solid #e5e7eb;border-radius:8px;">
                    <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.9rem;color:#374151;">
                        <input type="checkbox" name="remember" value="1"> Remember me
                    </label>
                    <button class="btn-category" type="submit" style="width:100%">Sign in</button>
                </div>
            </form>
=======
    <section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" class="auth-logo">
                <h2>Sign in</h2>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-actions">
                    <label class="checkbox">
                        <input type="checkbox" name="remember"> Ingat Saya
                    </label>
                    <a href="#" class="link-small">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-primary">Log Masuk</button>
            </form>

            <div class="auth-footer">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}" class="link">Register Now</a>
            </div>
>>>>>>> 6316f588acf8a25da91ca151a34aebd9f8379c00
        </div>
    </section>
@endsection

<<<<<<< HEAD
=======

>>>>>>> 6316f588acf8a25da91ca151a34aebd9f8379c00
