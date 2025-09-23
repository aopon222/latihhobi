<header class="header">
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
        </a>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li class="nav-item"><a href="/ekskul-reguler" class="{{ request()->is('ekskul-reguler') ? 'active' : '' }}">Ekskul Reguler</a></li>
            <li class="nav-item dropdown">
                <a href="/ecourse">E-course <span class="dropdown-arrow">▼</span></a>
                <div class="dropdown-menu">
                    <a href="/ecourse/robotik" class="dropdown-item">
                        <span class="dropdown-icon">🤖</span>
                        Ecourse Robotik
                    </a>
                    <a href="/course-film-konten-kreator" class="dropdown-item">
                        <span class="dropdown-icon">🎬</span>
                        Ecourse Film & Konten Kreator
                    </a>
                    <a href="/ecourse-komik" class="dropdown-item">
                        <span class="dropdown-icon">📖</span>
                        Ecourse Komik
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="/ecourse" class="{{ request()->is('ecourse*') ? 'active' : '' }}">E-Course <span class="dropdown-arrow">▼</span></a>
                <div class="dropdown-menu">
                    <a href="/ecourse/film-konten-kreator" class="dropdown-item">Film & Konten Kreator</a>
                    <a href="/ecourse/komik" class="dropdown-item">Komik</a>
                    <a href="/ecourse/robotik" class="dropdown-item">Robotik</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#">Event <span class="dropdown-arrow">▼</span></a>
                <div class="dropdown-menu">
                    <a href="{{ route('lhec2025') }}" class="dropdown-item">
                        <span class="dropdown-icon">🏆</span>
                        LHEC 2025
                    </a>
                    <a href="{{ route('workshop-bootcamp') }}" class="dropdown-item">
                        <span class="dropdown-icon">💼</span>
                        WORKSHOP & BOOTCAMP
                    </a>
                    <a href="{{ route('holiday-fun-class') }}" class="dropdown-item">
                        <span class="dropdown-icon">🎉</span>
                        HOLIDAY FUN CLASS
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#"><span class="dropdown-icon"></span> Tentang Kami <span class="dropdown-arrow">▼</span></a>
                <div class="dropdown-menu">
                    <a href="/karier" class="dropdown-item">Latih Hobi Karier</a>
                    <a href="/magang" class="dropdown-item">Program Magang (Internship)</a>
                    <a href="/profil" class="dropdown-item">PROFIL</a>
                    <a href="/contact" class="dropdown-item">CONTACT</a>
                </div>
            </li>
        </ul>
        <div class="user-menu">
            <a href="#" class="user-icon">🔍</a>
            <a href="#" class="user-icon">🛒</a>
            @php
                $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
            @endphp
            @auth
                <!-- User dropdown dihilangkan sementara -->
            @else
                @if($hasLoginRoute)
                <a href="{{ route('login') }}" class="btn-signin">Sign in</a>
                @endif
                @if($hasRegisterRoute)
                <a href="{{ route('register') }}" class="btn-signup">Sign up</a>
                @endif
            @endauth
        </div>
    </nav>
</header>