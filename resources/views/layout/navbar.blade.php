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
                <div class="profile-dropdown" style="position:relative;display:flex;align-items:center;gap:12px;">
                    <button class="profile-btn" aria-haspopup="true" aria-expanded="false" style="display:flex;align-items:center;gap:8px;background:transparent;border:0;cursor:pointer;padding:6px 8px;border-radius:8px;text-decoration:none;color:inherit;">
                        <span style="display:inline-block;width:36px;height:36px;border-radius:50%;background:#f3f4f6;overflow:hidden;text-align:center;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;vertical-align:middle;">
                        </span>
                        <span style="color:#ffc107;font-weight:600;font-size:1rem;">{{ Auth::user()->name ?? 'Profil' }}</span>
                        <svg style="width:12px;height:12px;opacity:0.9;" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                    </button>

                    <div class="dropdown-menu" style="display:none;position:absolute;right:0;top:calc(100% + 8px);background:#fff;border-radius:8px;box-shadow:0 8px 24px rgba(0,0,0,0.12);padding:6px 0;min-width:180px;z-index:1000;">
                        @if(auth()->user()->email === 'multimedia.latihhobi@gmail.com')
                            <a href="{{ route('admin.dashboard') }}" style="display:block;padding:10px 14px;color:#111827;text-decoration:none;font-weight:500;">Dashboard</a>
                        @endif
                        <a href="{{ route('profile') }}" style="display:block;padding:10px 14px;color:#111827;text-decoration:none;font-weight:500;">Profil</a>
                        @if($hasLogoutRoute)
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="width:100%;text-align:left;padding:10px 14px;background:transparent;border:0;color:#ef4444;font-weight:500;cursor:pointer;">Keluar</button>
                        </form>
                        @endif
                    </div>
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

<!-- CSS fallback: show dropdown on hover and ensure it stays on top -->
<style>
    .profile-dropdown .dropdown-menu{ display:none; pointer-events:auto; z-index:99999; }
    .profile-dropdown:hover .dropdown-menu{ display:block !important; }
    .profile-btn{ background:transparent; }
</style>

<script>
    // Profile dropdown behavior for main navbar
    (function(){
        const pd = document.querySelector('.profile-dropdown');
        if(!pd) return;
        const btn = pd.querySelector('.profile-btn');
        const menu = pd.querySelector('.dropdown-menu');

        function openMenu(menu, btn){
            menu.style.display = 'block';
            menu.style.position = 'fixed';
            menu.style.right = 'auto';
            const rect = btn.getBoundingClientRect();
            const mRect = menu.getBoundingClientRect();
            let left = rect.right - mRect.width;
            if(left < 8) left = rect.left;
            const top = rect.bottom + 8;
            menu.style.left = left + 'px';
            menu.style.top = top + 'px';
            menu.style.zIndex = '999999';
            btn.setAttribute('aria-expanded', 'true');
        }
        function closeMenu(menu, btn){
            menu.style.display = 'none';
            btn.setAttribute('aria-expanded', 'false');
        }

        // Desktop: show on hover
        pd.addEventListener('mouseenter', () => openMenu(menu, btn));
        pd.addEventListener('mouseleave', () => closeMenu(menu, btn));

        // Touch / click: toggle
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const isOpen = menu.style.display === 'block';
            if(isOpen) closeMenu(menu, btn); else openMenu(menu, btn);
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if(!pd.contains(e.target)){
                menu.style.display = 'none';
                btn.setAttribute('aria-expanded', 'false');
            }
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                menu.style.display = 'none';
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>
