@extends('layout.app')

@section('title', 'Sign in - LatihHobi')

@section('content')
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
        </div>
    </section>
@endsection

