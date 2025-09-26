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
                    @if(Route::has('workshop-bootcamp'))
                    <a href="{{ route('workshop-bootcamp') }}" class="dropdown-item">
                        <span class="dropdown-icon">💼</span>
                        WORKSHOP & BOOTCAMP
                    </a>
                    @else
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); alert('Route not configured in this environment')">
                        <span class="dropdown-icon">💼</span>
                        WORKSHOP & BOOTCAMP
                    </a>
                    @endif
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
            <a href="#" class="user-icon nav-search" aria-label="Buka pencarian" title="Cari"><i class="fas fa-search" style="color:#ffc107;font-size:1.5rem;"></i></a>
            <!-- Inline navbar search form (hidden by default; toggled with .open) -->
            <form class="navbar-search-form" action="/search" method="GET">
                <input type="text" name="query" class="navbar-search-input" placeholder="Cari..." aria-label="Cari">
                <button type="submit" class="navbar-search-submit"><i class="fas fa-search"></i></button>
            </form>
            <a href="#" class="user-icon"><i class="fas fa-bell" style="color:#ffc107;font-size:1.5rem;"></i></a>
            <a href="#" class="user-icon" style="position:relative;">
                <i class="fas fa-shopping-cart" style="color:#ffc107;font-size:1.5rem;"></i>
                <span style="position:absolute;top:-8px;right:-8px;background:#1e293b;color:#fff;font-size:0.8rem;padding:2px 7px;border-radius:50%;font-weight:700;">1</span>
            </a>
            @php
                $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
                // Avoid trying to query the users table when it doesn't exist (local dev before migrations).
                $usersTableExists = \Illuminate\Support\Facades\Schema::hasTable('users');
            @endphp

            @if($usersTableExists && auth()->check())
                <div class="user-dropdown" style="display:flex;align-items:center;gap:12px;position:relative;">
                    @if(auth()->user()->email === 'multimedia.latihhobi@gmail.com')
                        <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                    @else
                        <a href="{{ route('profile') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                    @endif
                        <span class="profile-trigger" style="display:inline-block;width:36px;height:36px;border-radius:50%;background:#f3f4f6;overflow:hidden;text-align:center;cursor:pointer;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;vertical-align:middle;">
                        </span>
                        <span class="profile-trigger" style="color:#ffc107;font-weight:600;font-size:1rem;cursor:pointer;">{{ Auth::user()->name ?? 'Profil' }}</span>
                    </a>

                    {{-- Profile dropdown menu --}}
                    <div class="user-profile-menu" aria-hidden="true" style="display:none;">
                        <div class="profile-menu-inner">
                            @if(auth()->user()->email === 'multimedia.latihhobi@gmail.com')
                                @if(Route::has('admin.dashboard'))
                                <a href="{{ route('admin.dashboard') }}" class="profile-item">Dashboard Admin</a>
                                @endif
                            @else
                                @if(Route::has('profile'))
                                <a href="{{ route('profile') }}" class="profile-item">Profil Saya</a>
                                @endif
                            @endif
                            @if($hasLogoutRoute)
                            <a href="#" class="profile-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Profile menu initialization moved to layout/app.blade.php script to avoid Blade/JS render issues -->
            @else
                @if($hasLoginRoute)
                <a href="{{ route('login') }}" class="btn-signin">Sign in</a>
                @endif
                @if($hasRegisterRoute)
                <a href="{{ route('register') }}" class="btn-signup">Sign up</a>
                @endif
            @endif
        </div>
    </nav>
</header>