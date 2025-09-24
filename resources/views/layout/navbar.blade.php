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
            <a href="#" class="user-icon"><i class="fas fa-search" style="color:#ffc107;font-size:1.5rem;"></i></a>
            <a href="#" class="user-icon"><i class="fas fa-bell" style="color:#ffc107;font-size:1.5rem;"></i></a>
            <a href="#" class="user-icon" style="position:relative;">
                <i class="fas fa-shopping-cart" style="color:#ffc107;font-size:1.5rem;"></i>
                <span style="position:absolute;top:-8px;right:-8px;background:#1e293b;color:#fff;font-size:0.8rem;padding:2px 7px;border-radius:50%;font-weight:700;">1</span>
            </a>
            @php
                $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
            @endphp
            @auth
                <div class="user-dropdown" style="display:flex;align-items:center;gap:12px;">
                    @if(auth()->user()->email === 'multimedia.latihhobi@gmail.com')
                        <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                    @else
                        <a href="{{ route('profile') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                    @endif
                        <span style="display:inline-block;width:36px;height:36px;border-radius:50%;background:#f3f4f6;overflow:hidden;text-align:center;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;vertical-align:middle;">
                        </span>
                        <span style="color:#ffc107;font-weight:600;font-size:1rem;">{{ Auth::user()->name ?? 'Profil' }}</span>
                    </a>
                    @if($hasLogoutRoute)
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:#fff;border:none;color:#374151;font-weight:500;padding:8px 18px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);cursor:pointer;transition:background 0.2s;">
                            <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>Logout
                        </button>
                    </form>
                    @endif
                </div>
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
