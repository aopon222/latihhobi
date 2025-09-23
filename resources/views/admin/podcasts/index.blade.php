@extends('admin.layout')

@section('title', 'Kelola Podcast - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Kelola Podcast</h1>
    <a href="{{ route('admin.podcasts.create') }}" 
       style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;box-shadow:0 2px 4px rgba(37,99,235,0.2);">
        <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Tambah Podcast
    </a>
</div>

<!-- Filter Section -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
    <form method="GET" style="display:flex;gap:16px;align-items:end;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Cari Podcast</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari berdasarkan judul, host, atau guest..." 
                   style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
        </div>
        <div style="min-width:150px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Host</label>
            <select name="host" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                <option value="">Semua Host</option>
                @foreach($hosts as $host)
                    <option value="{{ $host }}" {{ request('host') == $host ? 'selected' : '' }}>
                        {{ $host }}
                    </option>
                @endforeach
            </select>
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
            <a href="{{ route('admin.podcasts.index') }}" 
               style="background:#6b7280;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;margin-left:8px;">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Podcast Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden;">
    @if($podcasts->count() > 0)
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead style="background:#f9fafb;">
                    <tr>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Thumbnail</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Judul</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Host</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Guest</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Tanggal</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Status</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($podcasts as $podcast)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:16px;">
                            <img src="{{ $podcast->thumbnail_url }}" 
                                 alt="{{ $podcast->title }}"
                                 style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                        </td>
                        <td style="padding:16px;">
                            <div>
                                <h3 style="font-weight:600;color:#111827;margin-bottom:4px;">{{ $podcast->title }}</h3>
                                <p style="color:#6b7280;font-size:14px;">{{ Str::limit($podcast->description, 80) }}</p>
                                @if($podcast->duration)
                                    <span style="background:#e5e7eb;color:#374151;padding:2px 6px;border-radius:4px;font-size:12px;">{{ $podcast->duration }}</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <span style="color:#374151;font-weight:500;">{{ $podcast->host }}</span>
                        </td>
                        <td style="padding:16px;">
                            <span style="color:#6b7280;">{{ $podcast->guest ?: '-' }}</span>
                        </td>
                        <td style="padding:16px;">
                            <span style="color:#374151;">{{ $podcast->published_date->format('d M Y') }}</span>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <button onclick="toggleActive({{ $podcast->id }})" 
                                        style="background:{{ $podcast->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $podcast->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                                <button onclick="toggleFeatured({{ $podcast->id }})" 
                                        style="background:{{ $podcast->is_featured ? '#f59e0b' : '#6b7280' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $podcast->is_featured ? 'Featured' : 'Normal' }}
                                </button>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ $podcast->watch_url }}" target="_blank"
                                   style="background:#dc2626;color:white;padding:8px;border-radius:6px;text-decoration:none;">
                                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.podcasts.show', $podcast) }}" 
                                   style="background:#3b82f6;color:white;padding:8px;border-radius:6px;text-decoration:none;">
                                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.podcasts.edit', $podcast) }}" 
                                   style="background:#f59e0b;color:white;padding:8px;border-radius:6px;text-decoration:none;">
                                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.podcasts.destroy', $podcast) }}" 
                                      style="display:inline;" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus podcast: {{ $podcast->title }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background:#ef4444;color:white;padding:8px;border:none;border-radius:6px;cursor:pointer;">
                                        <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
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
            {{ $podcasts->appends(request()->query())->links() }}
        </div>
    @else
        <div style="padding:64px;text-align:center;">
            <svg style="width:64px;height:64px;color:#d1d5db;margin:0 auto 16px;" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"/>
            </svg>
            <h3 style="color:#374151;margin-bottom:8px;">Tidak ada podcast ditemukan</h3>
            <p style="color:#6b7280;margin-bottom:24px;">Mulai dengan menambahkan podcast pertama Anda.</p>
            <a href="{{ route('admin.podcasts.create') }}" 
               style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                Tambah Podcast
            </a>
        </div>
    @endif
</div>

<script>
function toggleActive(id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/admin/podcasts/${id}/toggle-active`, {
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
    
    fetch(`/admin/podcasts/${id}/toggle-featured`, {
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