@php $hideNavbar = true; @endphp
@extends('layout.app')

@section('title', $title ?? 'Dashboard Admin - LatihHobi')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div style="min-height:100vh;background:#f8fafc;display:flex;">
    <!-- Sidebar -->
    <aside style="width:240px;background:#fff;border-right:1px solid #e5e7eb;box-shadow:0 2px 8px rgba(0,0,0,0.04);display:flex;flex-direction:column;align-items:center;padding:32px 0;">
        <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" style="height:48px;margin-bottom:32px;">
        <nav style="width:100%;">
            <a href="{{ route('admin.dashboard') }}" style="display:block;padding:12px 32px;color:{{ request()->routeIs('admin.dashboard') ? '#2563eb' : '#374151' }};font-weight:{{ request()->routeIs('admin.dashboard') ? '600' : '500' }};text-decoration:none;border-radius:8px;margin-bottom:8px;{{ request()->routeIs('admin.dashboard') ? 'background:#e0e7ff;' : '' }}">Dashboard</a>
            <a href="{{ route('admin.ecourses.index') }}" style="display:block;padding:12px 32px;color:{{ request()->routeIs('admin.ecourses.*') ? '#2563eb' : '#374151' }};font-weight:{{ request()->routeIs('admin.ecourses.*') ? '600' : '500' }};text-decoration:none;border-radius:8px;margin-bottom:8px;{{ request()->routeIs('admin.ecourses.*') ? 'background:#e0e7ff;' : '' }}">E-course</a>
            <a href="{{ route('admin.podcasts.index') }}" style="display:block;padding:12px 32px;color:{{ request()->routeIs('admin.podcasts.*') ? '#2563eb' : '#374151' }};font-weight:{{ request()->routeIs('admin.podcasts.*') ? '600' : '500' }};text-decoration:none;border-radius:8px;margin-bottom:8px;{{ request()->routeIs('admin.podcasts.*') ? 'background:#e0e7ff;' : '' }}">Podcast</a>
            <a href="#" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Event</a>
            <a href="{{ route('password.change.form') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">🔐 Ganti Password</a>
            <a href="{{ route('home') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Kembali ke Website</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <main style="flex:1;padding:48px 32px;">
        <!-- Admin Topbar with Profile Dropdown -->
        <header style="display:flex;justify-content:flex-end;align-items:center;margin-bottom:24px;">
            <div class="profile-dropdown" style="position:relative;">
                <button type="button" class="profile-btn" aria-haspopup="true" aria-expanded="false" style="display:flex;align-items:center;gap:8px;background:transparent;border:0;cursor:pointer;padding:8px 12px;border-radius:8px;font-weight:600;color:#374151;">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Profile" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                    <span style="display:inline-block;">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <svg style="width:14px;height:14px;opacity:0.8" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </button>

                <div class="dropdown-menu" style="display:none;position:absolute !important;right:0;top:calc(100% + 8px);background:#fff;border-radius:8px;box-shadow:0 8px 24px rgba(0,0,0,0.12);padding:8px 0;min-width:160px;z-index:99999;pointer-events:auto;">
                    <a href="{{ route('admin.dashboard') }}" style="display:block;padding:10px 16px;color:#111827;text-decoration:none;font-weight:500;">Dashboard</a>
                    <a href="{{ route('password.change.form') }}" style="display:block;padding:10px 16px;color:#111827;text-decoration:none;font-weight:500;">🔐 Ganti Password</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;text-align:left;padding:10px 16px;background:transparent;border:0;color:#ef4444;font-weight:500;cursor:pointer;">Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        @yield('admin-content')
    </main>
</div>

<!-- Toast Notification -->
@if(session('success'))
<div id="toast" style="position:fixed;top:20px;right:20px;background:#10b981;color:white;padding:16px 24px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:1000;display:flex;align-items:center;gap:8px;">
    <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    {{ session('success') }}
</div>
<!-- Small CSS fallback: show dropdown on hover and ensure it stays on top -->
<style>
    .profile-dropdown .dropdown-menu{ display:none; pointer-events:auto; z-index:2147483647; position:fixed !important; right:16px !important; }
    .profile-dropdown:hover .dropdown-menu{ display:block !important; }
    .profile-btn{ background:transparent; }
</style>

<script>
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="toast-error" style="position:fixed;top:20px;right:20px;background:#ef4444;color:white;padding:16px 24px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:1000;display:flex;align-items:center;gap:8px;">
    <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    {{ session('error') }}
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('toast-error');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 5000);
        }
    }, 5000);
</script>
@endif
<script>
    // Profile dropdown hover + click toggle
    (function(){
        const pd = document.querySelector('.profile-dropdown');
        if(!pd) return;
        const btn = pd.querySelector('.profile-btn');
        const menu = pd.querySelector('.dropdown-menu');

        // Helper to open menu using fixed positioning to avoid clipping by parents
        function openMenu(menu, btn){
            menu.style.display = 'block';
            menu.style.position = 'fixed';
            menu.style.right = 'auto';
            // compute position after element is visible
            const rect = btn.getBoundingClientRect();
            const mRect = menu.getBoundingClientRect();
            // align right edge of menu to right edge of button when possible
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

        // Show on hover (desktop)
        pd.addEventListener('mouseenter', () => openMenu(menu, btn));
        pd.addEventListener('mouseleave', () => closeMenu(menu, btn));

        // Toggle on click (touch devices)
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
@endsection