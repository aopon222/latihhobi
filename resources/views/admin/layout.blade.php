@php $hideNavbar = true; $hideFooter = true; @endphp
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
            <a href="{{ route('admin.events.index') }}" style="display:block;padding:12px 32px;color:{{ request()->routeIs('admin.events.*') ? '#2563eb' : '#374151' }};font-weight:{{ request()->routeIs('admin.events.*') ? '600' : '500' }};text-decoration:none;border-radius:8px;margin-bottom:8px;{{ request()->routeIs('admin.events.*') ? 'background:#e0e7ff;' : '' }}">Event</a>
            <a href="{{ route('password.change.form') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">🔐 Ganti Password</a>
            <a href="{{ route('home') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">Kembali ke Website</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <main style="flex:1;padding:48px 32px;">
        <!-- add small experimental profile trigger for fixed dropdown (local branch) -->
        <div style="display:flex;justify-content:flex-end;align-items:center;margin-bottom:16px;">
            <span class="admin-profile-trigger" style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:#eef2ff;color:#374151;font-weight:700;">{{ strtoupper(substr(Auth::user()->name ?? 'A',0,1)) }}</span>
                <span style="font-weight:600;color:#374151;">{{ Auth::user()->name ?? 'Admin' }}</span>
            </span>
        </div>

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
    // Local branch: create fixed dropdown for admin profile trigger
    (function(){
        const trigger = document.querySelector('.admin-profile-trigger');
        if(!trigger) return;
        let menu = null;
        function createMenu(){
            if(menu) return menu;
            menu = document.createElement('div');
            Object.assign(menu.style, {position:'fixed', right:'16px', top:'64px', background:'#fff', borderRadius:'8px', boxShadow:'0 8px 24px rgba(0,0,0,0.12)', padding:'8px 0', minWidth:'180px', zIndex:2147483647, display:'none'});
            const a = document.createElement('a'); a.href='{{ route('admin.dashboard') }}'; a.textContent='Dashboard'; a.style.display='block'; a.style.padding='10px 14px'; a.style.color='#111827'; a.style.textDecoration='none'; menu.appendChild(a);
            const p = document.createElement('a'); p.href='{{ route('password.change.form') }}'; p.textContent='Ganti Password'; p.style.display='block'; p.style.padding='10px 14px'; p.style.color='#111827'; p.style.textDecoration='none'; menu.appendChild(p);
            const form = document.createElement('form'); form.method='POST'; form.action='{{ route('logout') }}'; form.style.margin='0';
            const csrf = document.createElement('input'); csrf.type='hidden'; csrf.name='_token'; csrf.value='{{ csrf_token() }}'; form.appendChild(csrf);
            const btn = document.createElement('button'); btn.type='submit'; btn.textContent='Keluar'; Object.assign(btn.style,{width:'100%',textAlign:'left',padding:'10px 14px',background:'transparent',border:'0',color:'#ef4444',cursor:'pointer'}); form.appendChild(btn);
            menu.appendChild(form);
            document.body.appendChild(menu);
            return menu;
        }
        trigger.addEventListener('click', (e)=>{ e.preventDefault(); const m = createMenu(); m.style.display = m.style.display === 'block' ? 'none' : 'block'; });
        document.addEventListener('click', (e)=>{ if(menu && !menu.contains(e.target) && !trigger.contains(e.target)) menu.style.display='none'; });
    })();
</script>

@endsection