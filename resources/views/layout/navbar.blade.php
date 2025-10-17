<header class="header">
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi Logo" class="logo-img">
        </a>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li class="nav-item"><a href="/ekskul-reguler" class="{{ request()->is('ekskul-reguler') ? 'active' : '' }}">Ekskul Reguler</a></li>
            <li class="nav-item dropdown">
                <a href="{{ route('ecourse.index') }}">E-course <span class="dropdown-arrow">▼</span></a>
                <div class="dropdown-menu">
                    <a href="{{ route('course.robotik') }}" class="dropdown-item">
                        <span class="dropdown-icon">🤖</span>
                        Ecourse Robotik
                    </a>
                    <a href="{{ route('course.film_konten_kreator') }}" class="dropdown-item">
                        <span class="dropdown-icon">🎬</span>
                        Ecourse Film & Konten Kreator
                    </a>
                    <a href="/ecourse/komik" class="dropdown-item">
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
                        <span class="profile-trigger" style="display:inline-block;width:36px;height:36px;border-radius:50%;background:#f3f4f6;overflow:hidden;text-align:center;cursor:pointer;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;vertical-align:middle;">
                        </span>
                        <span class="profile-trigger" style="color:#ffc107;font-weight:600;font-size:1rem;cursor:pointer;">{{ Auth::user()->name ?? 'Profil' }}</span>
                    </a>
                    {{-- Logout moved into profile dropdown (kept in experimental fixed menu) --}}
                </div>
                
                    <script>
                        // Experimental: append a fixed dropdown to body when profile-trigger is clicked (local branch)
                        (function(){
                            const triggers = document.querySelectorAll('.profile-trigger');
                            if(!triggers.length) return;
                            let menuEl = null;

                            function createMenu(){
                                if(menuEl) return menuEl;
                                menuEl = document.createElement('div');
                                menuEl.className = 'profile-fixed-menu';
                                Object.assign(menuEl.style, {
                                    position: 'fixed',
                                    right: '16px',
                                    top: '64px',
                                    background: '#fff',
                                    borderRadius: '8px',
                                    boxShadow: '0 8px 24px rgba(0,0,0,0.12)',
                                    padding: '8px 0',
                                    minWidth: '200px',
                                    zIndex: 2147483647,
                                    display: 'none'
                                });

                                // Build inner content (Dashboard if admin, Profile, Logout form)
                                const isAdmin = {{ auth()->user() && auth()->user()->email === 'multimedia.latihhobi@gmail.com' ? 'true' : 'false' }};
                                if(isAdmin){
                                    const a = document.createElement('a');
                                    a.href = '{{ route('admin.dashboard') }}';
                                    a.textContent = 'Dashboard';
                                    a.style.display = 'block'; a.style.padding = '10px 14px'; a.style.color = '#111827'; a.style.textDecoration='none';
                                    menuEl.appendChild(a);
                                }
                                const p = document.createElement('a');
                                p.href = '{{ route('profile') }}'; p.textContent = 'Profil';
                                p.style.display = 'block'; p.style.padding = '10px 14px'; p.style.color = '#111827'; p.style.textDecoration='none';
                                menuEl.appendChild(p);

                                @if($hasLogoutRoute ?? true)
                                const form = document.createElement('form'); form.method='POST'; form.action='{{ route('logout') }}'; form.style.margin='0';
                                const csrf = document.createElement('input'); csrf.type='hidden'; csrf.name='_token'; csrf.value='{{ csrf_token() }}'; form.appendChild(csrf);
                                const btn = document.createElement('button'); btn.type='submit'; btn.textContent='Keluar';
                                Object.assign(btn.style, {width:'100%',textAlign:'left',padding:'10px 14px',background:'transparent',border:'0',color:'#ef4444',cursor:'pointer'});
                                form.appendChild(btn);
                                menuEl.appendChild(form);
                                @endif

                                document.body.appendChild(menuEl);
                                return menuEl;
                            }

                            function toggleMenu(){
                                const m = createMenu();
                                if(m.style.display === 'block') { m.style.display='none'; }
                                else { m.style.display='block'; }
                            }

                            triggers.forEach(t => t.addEventListener('click', (e) => { e.preventDefault(); e.stopPropagation(); toggleMenu(); }));
                            document.addEventListener('click', (e) => { if(menuEl && !menuEl.contains(e.target)) menuEl.style.display='none'; });
                        })();
                    </script>
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