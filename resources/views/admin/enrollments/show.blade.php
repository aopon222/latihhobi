@extends('admin.layout')

@section('title', 'Detail Enrollment - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Detail Enrollment</h1>
    <a href="{{ route('admin.enrollments.index') }}"
       style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
        ← Kembali
    </a>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border-left:4px solid #10b981;padding:12px;border-radius:8px;margin-bottom:16px;color:#065f46;">
        {{ session('success') }}
    </div>
@endif

<div style="background:white;padding:24px;border-radius:12px;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px;">
        <!-- User Info -->
        <div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Informasi User</h3>
            <div style="space-y:8px;">
                <div><strong>Nama:</strong> {{ $enrollment->user->name }}</div>
                <div><strong>Email:</strong> {{ $enrollment->user->email }}</div>
                <div><strong>User ID:</strong> {{ $enrollment->user->id }}</div>
                <div><strong>Bergabung:</strong> {{ $enrollment->user->created_at->format('d M Y H:i') }}</div>
            </div>
        </div>

        <!-- Course Info -->
        <div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Informasi E-course</h3>
            <div style="space-y:8px;">
                <div><strong>Judul:</strong> {{ $enrollment->ecourse->name }}</div>
                <div><strong>Course ID:</strong> {{ $enrollment->ecourse->id_course }}</div>
                <div><strong>Kategori:</strong> {{ $enrollment->ecourse->category->name ?? 'N/A' }}</div>
                <div><strong>Harga:</strong> Rp {{ number_format($enrollment->ecourse->price, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- Enrollment Details -->
    <div style="border-top:1px solid #e5e7eb;padding-top:24px;">
        <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Detail Enrollment</h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;">
            <div>
                <strong>Status:</strong>
                <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;margin-left:8px;
                    {{ $enrollment->status == 'active' ? 'background:#d1fae5;color:#065f46;' :
                       ($enrollment->status == 'completed' ? 'background:#dbeafe;color:#1e40af;' :
                       'background:#fee2e2;color:#991b1b;') }}">
                    {{ ucfirst($enrollment->status) }}
                </span>
            </div>

            <div>
                <strong>Status Lock:</strong>
                @if($enrollment->is_locked)
                    <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;margin-left:8px;background:#fee2e2;color:#991b1b;">
                        🔒 Terkunci
                    </span>
                @else
                    <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;margin-left:8px;background:#d1fae5;color:#065f46;">
                        🔓 Terbuka
                    </span>
                @endif
            </div>

            <div><strong>Tanggal Enroll:</strong> {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d M Y H:i') : '-' }}</div>
            <div><strong>Tanggal Selesai:</strong> {{ $enrollment->completed_at ? $enrollment->completed_at->format('d M Y H:i') : '-' }}</div>
            <div><strong>Dibuat:</strong> {{ $enrollment->created_at->format('d M Y H:i') }}</div>
            <div><strong>Diupdate:</strong> {{ $enrollment->updated_at->format('d M Y H:i') }}</div>
        </div>
    </div>

    <!-- Actions -->
    <div style="border-top:1px solid #e5e7eb;padding-top:24px;margin-top:24px;">
        <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Aksi</h3>
        <div style="display:flex;gap:12px;">
            <form method="POST" action="{{ route('admin.enrollments.toggle-lock', $enrollment) }}"
                  style="display:inline;" onsubmit="return confirm('{{ $enrollment->is_locked ? 'Buka kunci' : 'Kunci' }} enrollment ini?')">
                @csrf
                <button type="submit"
                        style="background:{{ $enrollment->is_locked ? '#10b981' : '#ef4444' }};color:white;padding:10px 20px;border-radius:6px;border:none;font-weight:600;cursor:pointer;">
                    {{ $enrollment->is_locked ? '🔓 Buka Kunci' : '🔒 Kunci' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection