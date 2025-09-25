@extends('admin.layout')

@section('title', 'Kelola E-course - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Kelola E-course</h1>
    <a href="{{ route('admin.ecourses.create') }}" 
       style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;box-shadow:0 2px 4px rgba(37,99,235,0.2);">
        <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Tambah E-course
    </a>
</div>

<!-- Filter Section -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
    <form method="GET" style="display:flex;gap:16px;align-items:end;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Cari E-course</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari berdasarkan judul..." 
                   style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
        </div>
        <div style="min-width:150px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Kategori</label>
            <select name="category" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="min-width:120px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Level</label>
            <select name="level" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                <option value="">Semua Level</option>
                @foreach($levels as $level)
                    <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                        {{ $level }}
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
        <div>
            <button type="submit" 
                    style="background:#2563eb;color:white;padding:12px 20px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                Filter
            </button>
            <a href="{{ route('admin.ecourses.index') }}" 
               style="background:#6b7280;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;margin-left:8px;">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- E-course Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden;">
    @if($ecourses->count() > 0)
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead style="background:#f9fafb;">
                    <tr>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Gambar</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Judul</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Kategori</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Level</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Harga</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Status</th>
                        <th style="padding:16px;text-align:left;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ecourses as $ecourse)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:16px;">
                            @if($ecourse->thumbnail)
                                <img src="{{ Storage::url($ecourse->thumbnail) }}" 
                                     alt="{{ $ecourse->title }}"
                                     style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                            @else
                                <div style="width:60px;height:40px;background:#e5e7eb;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                    <svg style="width:20px;height:20px;color:#9ca3af;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td style="padding:16px;">
                            <div>
                                <h3 style="font-weight:600;color:#111827;margin-bottom:4px;">{{ $ecourse->title }}</h3>
                                <p style="color:#6b7280;font-size:14px;">{{ Str::limit($ecourse->short_description, 50) }}</p>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <span style="background:#e0e7ff;color:#3730a3;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                                {{ $ecourse->category }}
                            </span>
                        </td>
                        <td style="padding:16px;">
                            <span style="background:#{{ $ecourse->level == 'Beginner' ? 'dcfce7' : ($ecourse->level == 'Intermediate' ? 'fef3c7' : 'fee2e2') }};color:#{{ $ecourse->level == 'Beginner' ? '166534' : ($ecourse->level == 'Intermediate' ? '92400e' : '991b1b') }};padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                                {{ $ecourse->level }}
                            </span>
                        </td>
                        <td style="padding:16px;">
                            <div>
                                @if($ecourse->discount_price)
                                    <span style="color:#dc2626;font-weight:600;">Rp {{ number_format($ecourse->discount_price, 0, ',', '.') }}</span>
                                    <br>
                                    <span style="color:#9ca3af;text-decoration:line-through;font-size:14px;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</span>
                                @else
                                    <span style="color:#111827;font-weight:600;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <button onclick="toggleActive({{ $ecourse->id }})" 
                                        style="background:{{ $ecourse->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;border:none;">
                                    {{ $ecourse->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                                <button onclick="toggleFeatured({{ $ecourse->id }})" 
                                        style="background:{{ $ecourse->is_featured ? '#f59e0b' : '#6b7280' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $ecourse->is_featured ? 'Featured' : 'Normal' }}
                                </button>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.ecourses.show', $ecourse) }}" 
                                   style="background:#3b82f6;color:white;padding:8px;border-radius:6px;text-decoration:none;">
                                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.ecourses.edit', $ecourse) }}" 
                                   style="background:#f59e0b;color:white;padding:8px;border-radius:6px;text-decoration:none;">
                                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.ecourses.destroy', $ecourse) }}" 
                                      style="display:inline;" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus e-course: {{ $ecourse->title }}?')">
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
            {{ $ecourses->appends(request()->query())->links() }}
        </div>
    @else
        <div style="padding:64px;text-align:center;">
            <svg style="width:64px;height:64px;color:#d1d5db;margin:0 auto 16px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
            </svg>
            <h3 style="color:#374151;margin-bottom:8px;">Tidak ada e-course ditemukan</h3>
            <p style="color:#6b7280;margin-bottom:24px;">Mulai dengan menambahkan e-course pertama Anda.</p>
            <a href="{{ route('admin.ecourses.create') }}" 
               style="background:#2563eb;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                Tambah E-course
            </a>
        </div>
    @endif
</div>

<script>
function toggleActive(id) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/admin/ecourses/${id}/toggle-active`, {
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
    
    fetch(`/admin/ecourses/${id}/toggle-featured`, {
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