@extends('admin.layout')

@section('title', 'Kelola Event - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Kelola Event</h1>
    <a href="{{ route('admin.events.create') }}" 
       style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;box-shadow:0 2px 4px rgba(37,99,235,0.2);">
        <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Tambah Event
    </a>
</div>

<!-- Filter Section -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
    <form method="GET" style="display:flex;gap:16px;align-items:end;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Cari Event</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari berdasarkan judul atau deskripsi singkat..." 
                   style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
        </div>
        <div style="min-width:120px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Status</label>
            <select name="status" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div style="min-width:120px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Featured</label>
            <select name="featured" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                <option value="">Semua</option>
                <option value="yes" {{ request('featured') == 'yes' ? 'selected' : '' }}>Featured</option>
                <option value="no" {{ request('featured') == 'no' ? 'selected' : '' }}>Normal</option>
            </select>
        </div>
        <div>
            <button type="submit" 
                    style="background:#2563eb;color:white;padding:12px 20px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                Filter
            </button>
            <a href="{{ route('admin.events.index') }}" 
               style="background:#6b7280;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;margin-left:8px;">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Events Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden;">
    @if($events->count() > 0)
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead style="background:#f9fafb;">
                    <tr>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Judul</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Tanggal Mulai</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Lokasi</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Status</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:16px;">
                            <div>
                                <h3 style="font-weight:600;color:#111827;margin-bottom:4px;">{{ $event->title }}</h3>
                                <p style="color:#6b7280;font-size:14px;">{{ Str::limit($event->short_description, 80) }}</p>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <span style="color:#374151;">{{ $event->start_date ? $event->start_date->format('d M Y H:i') : '-' }}</span>
                        </td>
                        <td style="padding:16px;">
                            <span style="color:#374151;">{{ $event->location ?: '-' }}</span>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <button onclick="toggleActive({{ $event->id }})" 
                                        style="background:{{ $event->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $event->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                                <button onclick="toggleFeatured({{ $event->id }})" 
                                        style="background:{{ $event->is_featured ? '#f59e0b' : '#6b7280' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $event->is_featured ? 'Featured' : 'Normal' }}
                                </button>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.events.show', $event) }}" 
                                   style="background:#3b82f6;color:white;padding:8px;border-radius:6px;text-decoration:none;">Lihat</a>
                                <a href="{{ route('admin.events.edit', $event) }}" 
                                   style="background:#f59e0b;color:white;padding:8px;border-radius:6px;text-decoration:none;">Edit</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" 
                                      style="display:inline;" onsubmit="return confirm('Hapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background:#ef4444;color:white;padding:8px;border:none;border-radius:6px;cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="padding:20px;">
            {{ $events->appends(request()->query())->links() }}
        </div>
    @else
        <div style="padding:64px;text-align:center;">
            <h3 style="color:#374151;margin-bottom:8px;">Tidak ada event ditemukan</h3>
            <p style="color:#6b7280;margin-bottom:24px;">Mulai dengan menambahkan event pertama Anda.</p>
            <a href="{{ route('admin.events.create') }}" 
               style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">Tambah Event</a>
        </div>
    @endif
</div>

<script>
function toggleActive(id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/admin/events/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Terjadi kesalahan. Silakan refresh halaman dan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan refresh halaman dan coba lagi.');
    });
}

function toggleFeatured(id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/admin/events/${id}/toggle-featured`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Terjadi kesalahan. Silakan refresh halaman dan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan refresh halaman dan coba lagi.');
    });
}
</script>
@endsection
