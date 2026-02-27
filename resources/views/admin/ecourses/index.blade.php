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

@if(isset($dbError) && $dbError)
    <div style="background:#fff4f4;border-left:4px solid #f87171;padding:12px;border-radius:8px;margin-bottom:12px;color:#7f1d1d;">
        <strong>Perhatian:</strong> Gagal memuat data e-course dari database. Periksa koneksi database atau pastikan tabel `course` tersedia.
    </div>
@endif

@if(session()->has('ecourse_update_diff'))
    @php $diff = session('ecourse_update_diff'); @endphp
    <div style="background:#f0f9ff;border-left:4px solid #2563eb;padding:16px;border-radius:8px;margin-bottom:16px;">
        <strong>Perubahan tersimpan untuk E-course ID {{ $diff['id'] }} — Perbandingan Sebelum / Sesudah:</strong>
        <div style="margin-top:8px;overflow:auto;">
            <table style="width:100%;border-collapse:collapse;margin-top:8px;">
                <thead>
                    <tr style="text-align:left;color:#374151;font-weight:600;">
                        <th style="padding:8px 12px;border-bottom:1px solid #e5e7eb;">Field</th>
                        <th style="padding:8px 12px;border-bottom:1px solid #e5e7eb;">Sebelum</th>
                        <th style="padding:8px 12px;border-bottom:1px solid #e5e7eb;">Sesudah</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $before = $diff['before'] ?? [];
                        $after = $diff['after'] ?? [];
                        $keys = array_unique(array_merge(array_keys($before), array_keys($after)));

                        // Helper closure to produce friendly display values
                        $formatValue = function($key, $value) {
                            if (is_null($value) || $value === '') {
                                return '-';
                            }

                            // Category id -> name
                            if ($key === 'id_category') {
                                $name = \Illuminate\Support\Facades\DB::table('category')
                                    ->where('id_category', $value)
                                    ->value('name');
                                return $name ?? $value;
                            }

                            // Currency fields
                            if (in_array($key, ['price', 'original_price', 'discount_price', 'discount'])) {
                                // ensure numeric
                                if (is_numeric($value)) {
                                    return 'Rp ' . number_format($value, 0, ',', '.');
                                }
                                return $value;
                            }

                            // Boolean fields
                            if (in_array($key, ['is_active', 'is_featured'])) {
                                return ($value == 1 || $value === true || $value === '1') ? 'Ya' : 'Tidak';
                            }

                            // Timestamps
                            if (strpos($key, '_at') !== false) {
                                try {
                                    return \Carbon\Carbon::parse($value)->format('d M Y H:i');
                                } catch (\Throwable $e) {
                                    return $value;
                                }
                            }

                            return $value;
                        };
                    @endphp
                    @foreach($keys as $key)
                        @php
                            $b = $before[$key] ?? null;
                            $a = $after[$key] ?? null;

                            // Friendly labels for common fields
                            $labels = [
                                'id' => 'ID',
                                'name' => 'Judul',
                                'id_category' => 'Kategori',
                                'level' => 'Level',
                                'price' => 'Harga',
                                'original_price' => 'Harga Diskon',
                                'discount_price' => 'Harga Diskon',
                                'short_description' => 'Deskripsi Singkat',
                                'description' => 'Deskripsi Lengkap',
                                'duration' => 'Durasi',
                                'total_lessons' => 'Total Pelajaran',
                                'is_active' => 'Aktif',
                                'is_featured' => 'Featured',
                                'created_at' => 'Dibuat',
                                'updated_at' => 'Diperbarui',
                                'thumbnail' => 'Thumbnail',
                                'image' => 'Gambar',
                                'course_by' => 'Pembuat',
                            ];

                            $label = $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
                        @endphp
                        @if($b != $a)
                        <tr>
                            <td style="padding:8px 12px;border-bottom:1px solid #f3f4f6;color:#111827;font-weight:600;">{{ $label }}</td>
                            <td style="padding:8px 12px;border-bottom:1px solid #f3f4f6;color:#6b7280;">{{ $formatValue($key, $b) }}</td>
                            <td style="padding:8px 12px;border-bottom:1px solid #f3f4f6;color:#0f172a;">{{ $formatValue($key, $a) }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

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
                @foreach($categories as $value => $label)
                    <option value="{{ $value }}" {{ request('category') == $value ? 'selected' : '' }}>
                        {{ $label }}
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
            <button type="button" onclick="openCategoryManager()" 
                    style="background:#ef4444;color:white;padding:12px 20px;border:none;border-radius:8px;font-weight:600;margin-left:8px;cursor:pointer;">
                Kelola Kategori
            </button>
        </div>
    </form>
</div>

<!-- Category Manager Modal -->
<div id="category-manager" style="display:none;position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:2000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:8px;max-width:700px;width:100%;padding:20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <h3 style="margin:0;font-size:1.25rem;color:#111827;">Kelola Kategori E-course</h3>
            <button onclick="closeCategoryManager()" style="background:#f3f4f6;border:none;padding:8px 10px;border-radius:6px;cursor:pointer;">Tutup</button>
        </div>
        <div id="category-list" style="max-height:360px;overflow:auto;padding-right:8px;">
            @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:8px;border-bottom:1px solid #f3f4f6;">
                    <div>{{ $cat->name }} <small style="color:#6b7280;margin-left:8px;">(ID: {{ $cat->id_category }})</small></div>
                    <div>
                        <button onclick="deleteCategory({{ $cat->id_category }})" style="background:#ef4444;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;">
                            Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="text-align:right;margin-top:12px;">
            <button onclick="closeCategoryManager()" style="background:#6b7280;color:white;padding:8px 12px;border-radius:6px;border:none;">Selesai</button>
        </div>
    </div>
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
                            @php 
                                $adminThumb = $ecourse->image_url ?? null;
                                $thumbDebug = \App\Helpers\ImageHelper::debugImagePath($adminThumb);
                            @endphp
                            @if($adminThumb)
                                <img src="{{ getEcourseImageUrl($adminThumb) }}" 
                                     alt="{{ $ecourse->name }}"
                                     style="width:120px;height:80px;object-fit:cover;border-radius:6px;"
                                     title="Path: {{ $adminThumb }} | Storage: {{ $thumbDebug['storage_exists'] ? '✓' : '✗' }} | Public: {{ $thumbDebug['public_exists'] ? '✓' : '✗' }}">
                            @else
                                <div style="width:120px;height:80px;background:#e5e7eb;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                    <svg style="width:40px;height:40px;color:#9ca3af;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td style="padding:16px;">
                            <div>
                                <h3 style="font-weight:600;color:#111827;margin-bottom:4px;">{{ $ecourse->name }}</h3>
                                <p style="color:#6b7280;font-size:14px;">{{ $ecourse->course_by ?? '-' }}</p>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <span style="background:#e0e7ff;color:#3730a3;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                                {{-- Show display label if mapping exists, otherwise show stored value --}}
                                @php
                                    // Normalize category value: it may be stored as a string/id or loaded as a Category model
                                    $catValue = null;
                                    if (is_object($ecourse->category)) {
                                        // If relation is loaded as a Category model, prefer its name, then id
                                        $catValue = $ecourse->category->name ?? ($ecourse->category->id ?? null);
                                    } else {
                                        $catValue = $ecourse->category;
                                    }

                                    // Show combined label for Film / Content Creation
                                    if ($catValue && in_array($catValue, ['Film', 'Content Creation'])) {
                                        echo 'Film & Konten Kreator';
                                    } else {
                                        // If $categories mapping uses ids as keys, try to resolve; otherwise fall back to raw value
                                        if ($catValue !== null && isset($categories[$catValue])) {
                                            echo $categories[$catValue];
                                        } else {
                                            echo $catValue ?? '-';
                                        }
                                    }
                                @endphp
                            </span>
                        </td>
                        <td style="padding:16px;">
                            @php
                                $bgColor = 'e5e7eb';
                                $textColor = '6b7280';
                                if ($ecourse->level) {
                                    $bgColor = ($ecourse->level == 'Beginner' ? 'dcfce7' : ($ecourse->level == 'Intermediate' ? 'fef3c7' : 'fee2e2'));
                                    $textColor = ($ecourse->level == 'Beginner' ? '166534' : ($ecourse->level == 'Intermediate' ? '92400e' : '991b1b'));
                                }
                            @endphp
                            <span style="background:#{{ $bgColor }};color:#{{ $textColor }};padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                                {{ $ecourse->level ?? 'N/A' }}
                            </span>
                        </td>
                        <td style="padding:16px;">
                            <div>
                                <span style="color:#111827;font-weight:600;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</span>
                                @if($ecourse->original_price && $ecourse->original_price > $ecourse->price)
                                    <br>
                                    <span style="color:#9ca3af;text-decoration:line-through;font-size:14px;">Rp {{ number_format($ecourse->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <button onclick="toggleActive({{ $ecourse->id_course }})" 
                                        style="background:{{ $ecourse->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;border:none;">
                                    {{ $ecourse->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                                <button onclick="toggleFeatured({{ $ecourse->id_course }})" 
                                        style="background:{{ $ecourse->is_featured ? '#f59e0b' : '#6b7280' }};color:white;padding:4px 8px;border:none;border-radius:4px;font-size:12px;font-weight:500;cursor:pointer;">
                                    {{ $ecourse->is_featured ? 'Featured' : 'Normal' }}
                                </button>
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex;gap:8px;">
                                          <a href="{{ route('ecourse.show', $ecourse->id_course) }}" 
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
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus e-course: {{ $ecourse->name }}?')">
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

function openCategoryManager() {
    document.getElementById('category-manager').style.display = 'flex';
}

function closeCategoryManager() {
    document.getElementById('category-manager').style.display = 'none';
}

function deleteCategory(id) {
    if (!confirm('Hapus kategori ini? Pastikan tidak ada e-course menggunakan kategori ini.')) return;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/admin/categories/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Kategori dihapus');
            location.reload();
        } else {
            alert(data.message || 'Gagal menghapus kategori');
        }
    })
    .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
}
</script>
@endsection
