@extends('layout.app')

@section('title', 'Sign in - LatihHobi')

@section('content')
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
        </div>
    </section>
@endsection


