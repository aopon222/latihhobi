@extends('admin.layout')

@section('title', 'Kelola Enrollment E-course - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Kelola Enrollment E-course</h1>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border-left:4px solid #10b981;padding:12px;border-radius:8px;margin-bottom:16px;color:#065f46;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#fee2e2;border-left:4px solid #ef4444;padding:12px;border-radius:8px;margin-bottom:16px;color:#991b1b;">
        {{ session('error') }}
    </div>
@endif

<!-- Filters -->
<div style="background:white;padding:20px;border-radius:12px;margin-bottom:24px;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
    <form method="GET" action="{{ route('admin.enrollments.index') }}" style="display:flex;gap:16px;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Cari User</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau email user"
                   style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;">
        </div>

        <div style="min-width:150px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Status</label>
            <select name="status" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div style="min-width:150px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Status Lock</label>
            <select name="lock_status" style="width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;">
                <option value="">Semua</option>
                <option value="locked" {{ request('lock_status') == 'locked' ? 'selected' : '' }}>Terkunci</option>
                <option value="unlocked" {{ request('lock_status') == 'unlocked' ? 'selected' : '' }}>Terbuka</option>
            </select>
        </div>

        <div style="display:flex;align-items:end;gap:8px;">
            <button type="submit" style="background:#2563eb;color:white;padding:8px 16px;border-radius:6px;border:none;font-weight:600;">
                Filter
            </button>
            <a href="{{ route('admin.enrollments.index') }}" style="background:#6b7280;color:white;padding:8px 16px;border-radius:6px;text-decoration:none;font-weight:600;">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Enrollments Table -->
<div style="background:white;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f9fafb;">
                <tr>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">User</th>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">E-course</th>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Status</th>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Lock Status</th>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Tanggal Enroll</th>
                    <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:16px;">
                        <div style="font-weight:600;color:#111827;">{{ $enrollment->user->name }}</div>
                        <div style="font-size:14px;color:#6b7280;">{{ $enrollment->user->email }}</div>
                    </td>
                    <td style="padding:16px;">
                        <div style="font-weight:600;color:#111827;">{{ $enrollment->ecourse->name }}</div>
                        <div style="font-size:14px;color:#6b7280;">ID: {{ $enrollment->ecourse->id_course }}</div>
                    </td>
                    <td style="padding:16px;">
                        <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;
                            {{ $enrollment->status == 'active' ? 'background:#d1fae5;color:#065f46;' :
                               ($enrollment->status == 'completed' ? 'background:#dbeafe;color:#1e40af;' :
                               'background:#fee2e2;color:#991b1b;') }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </td>
                    <td style="padding:16px;">
                        @if($enrollment->is_locked)
                            <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;background:#fee2e2;color:#991b1b;">
                                🔒 Terkunci
                            </span>
                        @else
                            <span style="padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600;background:#d1fae5;color:#065f46;">
                                🔓 Terbuka
                            </span>
                        @endif
                    </td>
                    <td style="padding:16px;color:#6b7280;">
                        {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d M Y H:i') : '-' }}
                    </td>
                    <td style="padding:16px;">
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('admin.enrollments.show', $enrollment) }}"
                               style="background:#2563eb;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:14px;font-weight:600;">
                                Lihat
                            </a>
                            <form method="POST" action="{{ route('admin.enrollments.toggle-lock', $enrollment) }}"
                                  style="display:inline;" onsubmit="return confirm('{{ $enrollment->is_locked ? 'Buka kunci' : 'Kunci' }} enrollment ini?')">
                                @csrf
                                <button type="submit"
                                        style="background:{{ $enrollment->is_locked ? '#10b981' : '#ef4444' }};color:white;padding:6px 12px;border-radius:4px;border:none;font-size:14px;font-weight:600;cursor:pointer;">
                                    {{ $enrollment->is_locked ? '🔓 Buka' : '🔒 Kunci' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:32px;text-align:center;color:#6b7280;">
                        Tidak ada enrollment ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($enrollments->hasPages())
    <div style="padding:16px;border-top:1px solid #e5e7eb;">
        {{ $enrollments->links() }}
    </div>
    @endif
</div>
@endsection