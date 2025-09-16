@extends('layout.app')

@section('title', 'Sign up - LatihHobi')

@section('content')
    <section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" class="auth-logo">
                <h2>Create an Account</h2>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Full Name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn-primary">Sign up</button>
            </form>

            <div class="auth-footer">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}" class="link">Sign in</a>
            </div>
        </div>
    </section>
@endsection


