@extends('admin.layout')

@section('title', 'Detail E-course - Admin LatihHobi')

@section('admin-content')
@php
    // Safe counts for relations - use controller-provided flags to avoid querying missing tables
    $lessonsCount = 0;
    $enrollmentsCount = 0;

    try {
        if (isset($lessonsTableExists) && $lessonsTableExists) {
            if (is_callable([$ecourse, 'lessons'])) {
                $lessonsCount = $ecourse->relationLoaded('lessons') ? $ecourse->lessons->count() : $ecourse->lessons()->count();
            }
        }
    } catch (\Throwable $e) {
        $lessonsCount = 0;
    }

    try {
        if (isset($enrollmentsTableExists) && $enrollmentsTableExists) {
            if (is_callable([$ecourse, 'enrollments'])) {
                $enrollmentsCount = $ecourse->relationLoaded('enrollments') ? $ecourse->enrollments->count() : $ecourse->enrollments()->count();
            }
        }
    } catch (\Throwable $e) {
        $enrollmentsCount = 0;
    }
@endphp
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Detail E-course</h1>
    <div style="display:flex;gap:12px;">
        <a href="{{ route('admin.ecourses.edit', $ecourse) }}" 
           style="background:#f59e0b;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
            </svg>
            Edit
        </a>
        <a href="{{ route('admin.ecourses.index') }}" 
           style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0L2.586 11a2 2 0 010-2.828L6.293 4.465a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali
        </a>
    </div>
</div>

@if(isset($lessonsTableExists) && !$lessonsTableExists)
    <div style="background:#fff4f4;border-left:4px solid #f87171;padding:12px;border-radius:8px;margin-bottom:12px;color:#7f1d1d;">
        <strong>Perhatian:</strong> Data pelajaran tidak tersedia. Tabel `course_content` atau `ecourse_lessons` belum dibuat di database.
    </div>
@endif

@if(isset($enrollmentsTableExists) && !$enrollmentsTableExists)
    <div style="background:#fff7ed;border-left:4px solid #f59e0b;padding:12px;border-radius:8px;margin-bottom:12px;color:#92400e;">
        <strong>Perhatian:</strong> Data pendaftar tidak tersedia. Tabel `ecourse_enrollments` belum dibuat di database.
    </div>
@endif

<!-- Course Header -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
    <div style="display:grid;grid-template-columns:300px 1fr;gap:32px;">
        <!-- Course Image -->
        <div>
            @if($ecourse->image_url)
                @php $showDebugInfo = \App\Helpers\ImageHelper::debugImagePath($ecourse->image_url); @endphp
                <img src="{{ getEcourseImageUrl($ecourse->image_url) }}" 
                     alt="{{ $ecourse->name }}"
                     style="width:100%;height:200px;object-fit:cover;border-radius:12px;border:1px solid #e5e7eb;">
                <!-- Debug Info -->
                <div style="margin-top:8px;padding:8px;background:#f3f4f6;border-radius:4px;font-size:11px;">
                    <div style="color:#6b7280;">Path: {{ $ecourse->image_url }}</div>
                    <div style="color:{{ $showDebugInfo['storage_exists'] ? '#10b981' : '#ef4444' }};">Storage: {{ $showDebugInfo['storage_exists'] ? '✓' : '✗' }}</div>
                    <div style="color:{{ $showDebugInfo['public_exists'] ? '#10b981' : '#ef4444' }};">Public: {{ $showDebugInfo['public_exists'] ? '✓' : '✗' }}</div>
                </div>
            @else
                <div style="width:100%;height:200px;background:#f3f4f6;border-radius:12px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                    <svg style="width:64px;height:64px;color:#9ca3af;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Course Info -->
        <div>
            <div style="display:flex;gap:12px;align-items:center;margin-bottom:16px;">
                <h1 style="font-size:2rem;font-weight:700;color:#111827;margin:0;">{{ $ecourse->name }}</h1>
                <div style="display:flex;gap:8px;">
                    @if($ecourse->is_featured)
                        <span style="background:#f59e0b;color:white;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                            ⭐ FEATURED
                        </span>
                    @endif
                    <span style="background:{{ $ecourse->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ $ecourse->is_active ? '✅ AKTIF' : '❌ TIDAK AKTIF' }}
                    </span>
                </div>
            </div>
            
            <p style="color:#6b7280;font-size:1.125rem;margin-bottom:24px;">{{ $ecourse->short_description }}</p>
            
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(150px, 1fr));gap:16px;">
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">KATEGORI</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">
                        @php
                            if (is_object($ecourse->category)) {
                                echo $ecourse->category->name ?? ($ecourse->category->id ?? '-');
                            } else {
                                echo $ecourse->category ?? '-';
                            }
                        @endphp
                    </p>
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">LEVEL</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->level ?? '-' }}</p>
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">DURASI</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->duration }}</p>
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">PELAJARAN</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->total_lessons }} Lessons</p>
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">HARGA</h3>
                    @if($ecourse->discount_price)
                        <div>
                            <p style="font-size:16px;font-weight:700;color:#dc2626;margin:0;">Rp {{ number_format($ecourse->discount_price, 0, ',', '.') }}</p>
                            <p style="font-size:14px;color:#9ca3af;text-decoration:line-through;margin:0;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</p>
                        </div>
                    @else
                        <p style="font-size:16px;font-weight:700;color:#111827;margin:0;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</p>
                    @endif
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">PENDAFTARAN</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $enrollmentsCount }} Siswa</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Course Content Grid -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">
    <!-- Main Content -->
    <div>
        <!-- Description -->
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
            <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:16px;">Deskripsi</h2>
            <div style="color:#374151;line-height:1.7;white-space:pre-line;">{{ $ecourse->description }}</div>
        </div>

        <!-- Learning Outcomes -->
        @if($ecourse->learning_outcomes && count($ecourse->learning_outcomes) > 0)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
            <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:16px;">Hasil Pembelajaran</h2>
            <ul style="list-style:none;padding:0;margin:0;">
                @foreach($ecourse->learning_outcomes as $outcome)
                    <li style="display:flex;align-items:start;gap:12px;margin-bottom:12px;">
                        <span style="background:#10b981;color:white;border-radius:50%;width:20px;height:20px;display:flex;align-items:center;justify-content:center;font-size:12px;margin-top:2px;">✓</span>
                        <span style="color:#374151;flex:1;">{{ $outcome }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Prerequisites -->
        @if($ecourse->prerequisites && count($ecourse->prerequisites) > 0)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
            <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:16px;">Prasyarat</h2>
            <ul style="list-style:none;padding:0;margin:0;">
                @foreach($ecourse->prerequisites as $prerequisite)
                    <li style="display:flex;align-items:start;gap:12px;margin-bottom:12px;">
                        <span style="background:#f59e0b;color:white;border-radius:50%;width:20px;height:20px;display:flex;align-items:center;justify-content:center;font-size:12px;margin-top:2px;">!</span>
                        <span style="color:#374151;flex:1;">{{ $prerequisite }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Tools Needed -->
        @if($ecourse->tools_needed && count($ecourse->tools_needed) > 0)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
            <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:16px;">Tools yang Dibutuhkan</h2>
            <div style="display:flex;flex-wrap:gap:8px;">
                @foreach($ecourse->tools_needed as $tool)
                    <span style="background:#e0e7ff;color:#3730a3;padding:8px 16px;border-radius:20px;font-size:14px;font-weight:500;">
                        {{ $tool }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Materi Pembelajaran -->
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin:0;">Materi Pembelajaran</h2>
                <a href="{{ route('admin.ecourses.edit', $ecourse) }}" style="background:#10b981;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
                    <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Minggu
                </a>
            </div>

            @if($ecourse->weeks && $ecourse->weeks->count() > 0)
                @foreach($ecourse->weeks as $week)
                <div style="border:1px solid #e5e7eb;border-radius:8px;padding:24px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                        <h3 style="font-size:1.25rem;font-weight:600;color:#111827;margin:0;">{{ $week->title }}</h3>
                        <div style="display:flex;gap:8px;">
                            <button onclick="editWeek({{ $week->id }})" style="background:#f59e0b;color:white;padding:8px 16px;border-radius:6px;text-decoration:none;font-weight:600;border:none;cursor:pointer;">
                                Edit Minggu
                            </button>
                            <button onclick="addMaterial({{ $week->id }})" style="background:#10b981;color:white;padding:8px 16px;border-radius:6px;text-decoration:none;font-weight:600;border:none;cursor:pointer;">
                                Tambah Materi
                            </button>
                        </div>
                    </div>

                    <p style="color:#6b7280;margin-bottom:16px;">{{ $week->description }}</p>

                    @if($week->materials && $week->materials->count() > 0)
                        <div style="space-y:12px;">
                            @foreach($week->materials as $material)
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px;border:1px solid #e5e7eb;border-radius:6px;">
                                <div>
                                    <h4 style="font-weight:600;color:#111827;margin:0 0 4px 0;">{{ $material->title }}</h4>
                                    <p style="color:#6b7280;margin:0;font-size:14px;">{{ $material->description }}</p>
                                    <p style="color:#9ca3af;margin:4px 0 0 0;font-size:12px;">Tipe: {{ $material->type }} | Urutan: {{ $material->sort_order }}</p>
                                </div>
                                <div style="display:flex;gap:8px;">
                                    @if($material->video_url)
                                        <a href="{{ $material->video_url }}" target="_blank" style="background:#dc2626;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:12px;font-weight:600;">
                                            Video
                                        </a>
                                    @endif
                                    @if($material->file_path)
                                        <a href="{{ Storage::url($material->file_path) }}" target="_blank" style="background:#6b7280;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:12px;font-weight:600;">
                                            File
                                        </a>
                                    @endif
                                    <button onclick="editMaterial({{ $material->id }})" style="background:#f59e0b;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:12px;font-weight:600;border:none;cursor:pointer;">
                                        Edit
                                    </button>
                                    <button onclick="deleteMaterial({{ $material->id }})" style="background:#dc2626;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:12px;font-weight:600;border:none;cursor:pointer;">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color:#9ca3af;font-style:italic;">Belum ada materi untuk minggu ini.</p>
                    @endif
                </div>
                @endforeach
            @else
                <p style="color:#9ca3af;font-style:italic;">Belum ada minggu pembelajaran.</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Media -->
        @if($ecourse->thumbnail || $ecourse->demo_video)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Media</h3>
            
            @php $adminThumb = $ecourse->image_url ?? null; @endphp
            @if($adminThumb)
            <div style="margin-bottom:16px;">
                <h4 style="font-size:14px;font-weight:600;color:#6b7280;margin-bottom:8px;">THUMBNAIL</h4>
                <img src="{{ getEcourseImageUrl($adminThumb) }}" 
                     alt="Thumbnail"
                     style="width:100%;height:120px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
            </div>
            @endif
            
            @if($ecourse->demo_video)
            <div>
                <h4 style="font-size:14px;font-weight:600;color:#6b7280;margin-bottom:8px;">VIDEO DEMO</h4>
                <a href="{{ $ecourse->demo_video }}" target="_blank"
                   style="background:#dc2626;color:white;padding:8px 16px;border-radius:6px;text-decoration:none;font-size:14px;font-weight:500;display:inline-flex;align-items:center;gap:8px;">
                    <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                    </svg>
                    Tonton Demo
                </a>
            </div>
            @endif
        </div>
        @endif

        <!-- Course Stats -->
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Statistik</h3>
            
            <div style="space-y:12px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="color:#6b7280;">Total Pelajaran:</span>
                    <span style="font-weight:600;color:#111827;">{{ $lessonsCount }}/{{ $ecourse->total_lessons }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="color:#6b7280;">Total Siswa:</span>
                    <span style="font-weight:600;color:#111827;">{{ $enrollmentsCount }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="color:#6b7280;">Dibuat:</span>
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->created_at ? $ecourse->created_at->format('d M Y') : '-' }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;">
                    <span style="color:#6b7280;">Diperbarui:</span>
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->updated_at ? $ecourse->updated_at->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Aksi Cepat</h3>
            
            <div style="space-y:8px;">
                <button onclick="toggleActive({{ $ecourse->id_course }})" 
                        style="width:100%;background:{{ $ecourse->is_active ? '#ef4444' : '#10b981' }};color:white;padding:10px;border:none;border-radius:6px;font-weight:600;cursor:pointer;margin-bottom:8px;">
                    {{ $ecourse->is_active ? 'Nonaktifkan Course' : 'Aktifkan Course' }}
                </button>
                
                <button onclick="toggleFeatured({{ $ecourse->id_course }})" 
                        style="width:100%;background:{{ $ecourse->is_featured ? '#6b7280' : '#f59e0b' }};color:white;padding:10px;border:none;border-radius:6px;font-weight:600;cursor:pointer;margin-bottom:8px;">
                    {{ $ecourse->is_featured ? 'Hapus dari Featured' : 'Jadikan Featured' }}
                </button>
                
                <form method="POST" action="{{ route('admin.ecourses.destroy', $ecourse) }}" 
                      style="width:100%;"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus e-course ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="width:100%;background:#dc2626;color:white;padding:10px;border:none;border-radius:6px;font-weight:600;cursor:pointer;">
                        Hapus Course
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleActive(id) {
    fetch(`/admin/ecourses/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

function toggleFeatured(id) {
    fetch(`/admin/ecourses/${id}/toggle-featured`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<!-- Modal for Adding/Editing Week -->
<div id="weekModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;padding:32px;border-radius:12px;width:500px;max-width:90%;">
        <h3 id="weekModalTitle" style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:24px;">Edit Minggu</h3>
        <form id="weekForm" method="POST">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Judul Minggu</label>
                <input type="text" name="title" id="weekTitle" required style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi</label>
                <textarea name="description" id="weekDescription" rows="3" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;"></textarea>
            </div>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button type="button" onclick="closeWeekModal()" style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">Batal</button>
                <button type="submit" style="background:#10b981;color:white;padding:12px 24px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Adding/Editing Material -->
<div id="materialModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;padding:32px;border-radius:12px;width:600px;max-width:90%;">
        <h3 id="materialModalTitle" style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:24px;">Tambah Materi</h3>
        <form id="materialForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Judul Materi</label>
                <input type="text" name="title" id="materialTitle" required style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi</label>
                <textarea name="description" id="materialDescription" rows="2" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;"></textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Tipe</label>
                    <select name="type" id="materialType" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
                        <option value="video">Video</option>
                        <option value="pdf">PDF</option>
                        <option value="document">Dokumen</option>
                        <option value="quiz">Kuis</option>
                        <option value="assignment">Tugas</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Urutan</label>
                    <input type="number" name="sort_order" id="materialSortOrder" value="0" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Video URL</label>
                <input type="url" name="video_url" id="materialVideoUrl" placeholder="https://youtube.com/..." style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">File Materi</label>
                <input type="file" name="file" id="materialFile" style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button type="button" onclick="closeMaterialModal()" style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">Batal</button>
                <button type="submit" style="background:#10b981;color:white;padding:12px 24px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function editWeek(weekId) {
    // Fetch week data and populate modal
    fetch(`/admin/ecourses/weeks/${weekId}`, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('weekTitle').value = data.title;
        document.getElementById('weekDescription').value = data.description;
        document.getElementById('weekForm').action = `/admin/ecourses/weeks/${weekId}`;
        
        // Add method override for PUT
        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('weekForm').appendChild(methodInput);
        
        document.getElementById('weekModal').style.display = 'flex';
    });
}

function addMaterial(weekId) {
    document.getElementById('materialModalTitle').innerText = 'Tambah Materi';
    document.getElementById('materialForm').reset();
    document.getElementById('materialForm').action = `/admin/ecourses/weeks/${weekId}/materials`;
    
    // Remove method override if exists
    let methodInput = document.querySelector('#materialForm input[name="_method"]');
    if (methodInput) methodInput.remove();
    
    document.getElementById('materialModal').style.display = 'flex';
}

function editMaterial(materialId) {
    fetch(`/admin/ecourses/materials/${materialId}`, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('materialModalTitle').innerText = 'Edit Materi';
        document.getElementById('materialTitle').value = data.title;
        document.getElementById('materialDescription').value = data.description || '';
        document.getElementById('materialType').value = data.type;
        document.getElementById('materialSortOrder').value = data.sort_order;
        document.getElementById('materialVideoUrl').value = data.video_url || '';
        document.getElementById('materialForm').action = `/admin/ecourses/materials/${materialId}`;
        
        // Add method override for PUT
        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('materialForm').appendChild(methodInput);
        
        document.getElementById('materialModal').style.display = 'flex';
    });
}

function deleteMaterial(materialId) {
    if (confirm('Apakah Anda yakin ingin menghapus materi ini?')) {
        fetch(`/admin/ecourses/materials/${materialId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function closeWeekModal() {
    document.getElementById('weekModal').style.display = 'none';
    // Remove method override
    let methodInput = document.querySelector('#weekForm input[name="_method"]');
    if (methodInput) methodInput.remove();
}

function closeMaterialModal() {
    document.getElementById('materialModal').style.display = 'none';
    // Remove method override
    let methodInput = document.querySelector('#materialForm input[name="_method"]');
    if (methodInput) methodInput.remove();
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target == document.getElementById('weekModal')) {
        closeWeekModal();
    }
    if (event.target == document.getElementById('materialModal')) {
        closeMaterialModal();
    }
}
</script>
@endsection
