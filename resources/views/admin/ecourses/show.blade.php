@extends('admin.layout')

@section('title', 'Detail E-course - Admin LatihHobi')

@section('admin-content')
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

<!-- Course Header -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;margin-bottom:24px;">
    <div style="display:grid;grid-template-columns:300px 1fr;gap:32px;">
        <!-- Course Image -->
        <div>
            @if($ecourse->image)
                <img src="{{ Storage::url($ecourse->image) }}" 
                     alt="{{ $ecourse->title }}"
                     style="width:100%;height:200px;object-fit:cover;border-radius:12px;border:1px solid #e5e7eb;">
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
                <h1 style="font-size:2rem;font-weight:700;color:#111827;margin:0;">{{ $ecourse->title }}</h1>
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
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->category }}</p>
                </div>
                
                <div style="background:#f8fafc;padding:16px;border-radius:8px;">
                    <h3 style="font-size:14px;font-weight:600;color:#6b7280;margin:0 0 4px 0;">LEVEL</h3>
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->level }}</p>
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
                    <p style="font-size:16px;font-weight:600;color:#111827;margin:0;">{{ $ecourse->enrollments->count() }} Siswa</p>
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
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Media -->
        @if($ecourse->thumbnail || $ecourse->demo_video)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;margin-bottom:24px;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Media</h3>
            
            @if($ecourse->thumbnail)
            <div style="margin-bottom:16px;">
                <h4 style="font-size:14px;font-weight:600;color:#6b7280;margin-bottom:8px;">THUMBNAIL</h4>
                <img src="{{ Storage::url($ecourse->thumbnail) }}" 
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
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->lessons->count() }}/{{ $ecourse->total_lessons }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="color:#6b7280;">Total Siswa:</span>
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->enrollments->count() }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="color:#6b7280;">Dibuat:</span>
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->created_at->format('d M Y') }}</span>
                </div>
                
                <div style="display:flex;justify-content:space-between;">
                    <span style="color:#6b7280;">Diperbarui:</span>
                    <span style="font-weight:600;color:#111827;">{{ $ecourse->updated_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin-bottom:16px;">Aksi Cepat</h3>
            
            <div style="space-y:8px;">
                <button onclick="toggleActive({{ $ecourse->id }})" 
                        style="width:100%;background:{{ $ecourse->is_active ? '#ef4444' : '#10b981' }};color:white;padding:10px;border:none;border-radius:6px;font-weight:600;cursor:pointer;margin-bottom:8px;">
                    {{ $ecourse->is_active ? 'Nonaktifkan Course' : 'Aktifkan Course' }}
                </button>
                
                <button onclick="toggleFeatured({{ $ecourse->id }})" 
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
@endsection