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
                <i class="fas fa-shopping-cart" id="cart-icon" style="color:#ffc107;font-size:1.5rem;cursor:pointer;"></i>
                <span id="cart-count" style="position:absolute;top:-8px;right:-8px;background:#1e293b;color:#fff;font-size:0.8rem;padding:2px 7px;border-radius:50%;font-weight:700;display:none;">0</span>
            </a>
            @php
                $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
            @endphp
            @auth
                <div class="user-dropdown" style="display:flex;align-items:center;gap:12px;">
                    <a href="{{ route('profile') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                        <span class="profile-trigger" style="display:inline-block;width:36px;height:36px;border-radius:50%;background:#f3f4f6;overflow:hidden;text-align:center;cursor:pointer;">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;vertical-align:middle;">
                        </span>
                        <span class="profile-trigger" style="color:#ffc107;font-weight:600;font-size:1rem;cursor:pointer;">{{ Auth::user()->name ?? 'Profil' }}</span>
                    </a>
                    {{-- Logout moved into profile dropdown (kept in experimental fixed menu) --}}
                </div>
                
                    <script>
                        // Profile dropdown menu with Dashboard access for admin
                        (function(){
                            const triggers = document.querySelectorAll('.profile-trigger');
                            if(!triggers.length) return;
                            let menuEl = null;

                            function createMenu(){
                                if(menuEl && document.body.contains(menuEl)) return menuEl;
                                menuEl = document.createElement('div');
                                menuEl.className = 'profile-fixed-menu';
                                
                                // Build inner content (Dashboard if admin, Profile, Logout form)
                                const isAdmin = {{ auth()->user() && auth()->user()->email === 'multimedia.latihhobi@gmail.com' ? 'true' : 'false' }};
                                
                                let html = '';
                                if(isAdmin){
                                    html += '<a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>';
                                }
                                html += '<a href="{{ route('profile') }}">Profil</a>';
                                html += '<form method="POST" action="{{ route('logout') }}" style="margin:0;"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit">Keluar</button></form>';
                                
                                menuEl.innerHTML = html;
                                document.body.appendChild(menuEl);
                                return menuEl;
                            }

                            function toggleMenu(){
                                const m = createMenu();
                                if(m.style.display === 'block') { 
                                    m.style.display='none'; 
                                } else { 
                                    m.style.display='block';
                                }
                            }

                            triggers.forEach(t => {
                                t.addEventListener('click', (e) => { 
                                    e.preventDefault(); 
                                    e.stopPropagation(); 
                                    toggleMenu(); 
                                });
                            });
                            
                            document.addEventListener('click', (e) => { 
                                if(menuEl && document.body.contains(menuEl)) {
                                    if(!menuEl.contains(e.target) && !Array.from(triggers).some(t => t.contains(e.target))) {
                                        menuEl.style.display='none'; 
                                    }
                                }
                            });
                        })();

                        // Cart dropdown functionality
                        (function(){
                            const cartIcon = document.getElementById('cart-icon');
                            const cartCount = document.getElementById('cart-count');
                            let cartDropdown = null;

                            function createCartDropdown(){
                                if(cartDropdown && document.body.contains(cartDropdown)) return cartDropdown;
                                cartDropdown = document.createElement('div');
                                Object.assign(cartDropdown.style, {
                                    position: 'fixed',
                                    right: '16px',
                                    top: '64px',
                                    background: '#fff',
                                    borderRadius: '8px',
                                    boxShadow: '0 8px 24px rgba(0,0,0,0.12)',
                                    padding: '12px',
                                    minWidth: '300px',
                                    maxWidth: '400px',
                                    maxHeight: '400px',
                                    overflowY: 'auto',
                                    zIndex: '999998',
                                    display: 'none'
                                });
                                document.body.appendChild(cartDropdown);
                                return cartDropdown;
                            }

                            function loadCartData(){
                                fetch('{{ route('cart.data') }}')
                                    .then(r => r.json())
                                    .then(data => {
                                        const dropdown = createCartDropdown();
                                        dropdown.innerHTML = '';

                                        if(cartCount) {
                                            if(data.count > 0) {
                                                cartCount.textContent = data.count;
                                                cartCount.style.display = 'block';
                                            } else {
                                                cartCount.style.display = 'none';
                                            }
                                        }

                                        if(data.items.length === 0){
                                            dropdown.innerHTML = '<p style="padding:10px;color:#6b7280;">Keranjang kosong</p>';
                                        } else {
                                            let html = '<div style="font-weight:700;margin-bottom:8px;">Keranjang ('+data.count+')</div>';
                                            data.items.forEach(item => {
                                                html += `<div style="padding:8px;border-bottom:1px solid #f3f4f6;">
                                                    <div style="font-weight:600;color:#111827;">${item.name}</div>
                                                    <div style="font-size:0.85rem;color:#6b7280;">Qty: ${item.quantity} × Rp ${Math.round(item.price).toLocaleString('id-ID')}</div>
                                                    <div style="font-weight:600;color:#2563eb;">Rp ${Math.round(item.subtotal).toLocaleString('id-ID')}</div>
                                                </div>`;
                                            });
                                            html += '<div style="padding:8px;font-weight:700;border-top:2px solid #e5e7eb;">Total: Rp '+Math.round(data.total).toLocaleString('id-ID')+'</div>';
                                            html += '<div style="padding:8px;text-align:center;"><a href="{{ route('cart.index') }}" style="background:#2563eb;color:white;padding:8px 16px;border-radius:6px;text-decoration:none;display:inline-block;">Lihat Keranjang</a></div>';
                                            dropdown.innerHTML = html;
                                        }
                                    })
                                    .catch(e => console.error('Error loading cart:', e));
                            }

                            if(cartIcon){
                                cartIcon.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    const d = createCartDropdown();
                                    d.style.display = d.style.display === 'block' ? 'none' : 'block';
                                    if(d.style.display === 'block') loadCartData();
                                });
                            }

                            document.addEventListener('click', (e) => {
                                if(cartDropdown && document.body.contains(cartDropdown) && !cartDropdown.contains(e.target) && e.target !== cartIcon) {
                                    cartDropdown.style.display = 'none';
                                }
                            });

                            // Load cart count on page load
                            loadCartData();
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