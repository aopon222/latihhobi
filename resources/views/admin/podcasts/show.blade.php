@extends('admin.layout')

@section('title', 'Detail Podcast - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Detail Podcast</h1>
    <div style="display:flex;gap:12px;">
        <a href="{{ route('admin.podcasts.edit', $podcast) }}" 
           style="background:#f59e0b;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
            Edit
        </a>
        <a href="{{ route('admin.podcasts.index') }}" 
           style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
            ← Kembali
        </a>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:32px;">
    <!-- Main Content -->
    <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
        <!-- Video Player -->
        <div style="margin-bottom:32px;">
            <div style="position:relative;width:100%;height:0;padding-bottom:56.25%;border-radius:12px;overflow:hidden;">
                <iframe src="{{ $podcast->embed_url }}" 
                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;"
                        allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- Title and Description -->
        <div style="margin-bottom:24px;">
            <h2 style="font-size:1.5rem;font-weight:700;color:#111827;margin-bottom:12px;">
                {{ $podcast->title }}
            </h2>
            <p style="color:#6b7280;line-height:1.6;">
                {{ $podcast->description }}
            </p>
        </div>

        <!-- Topics -->
        @if($podcast->topics && count($podcast->topics) > 0)
        <div style="margin-bottom:24px;">
            <h3 style="font-weight:600;color:#374151;margin-bottom:12px;">Topik:</h3>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                @foreach($podcast->topics as $topic)
                    <span style="background:#e0e7ff;color:#3730a3;padding:4px 12px;border-radius:6px;font-size:14px;">
                        {{ $topic }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- External Links -->
        <div style="display:flex;gap:12px;">
            <a href="{{ $podcast->watch_url }}" target="_blank"
               style="background:#dc2626;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                </svg>
                Lihat di YouTube
            </a>
            <a href="{{ route('podcasts.show', $podcast) }}" target="_blank"
               style="background:#2563eb;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                Lihat di Frontend
            </a>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:24px;">
        <h3 style="font-weight:700;color:#111827;margin-bottom:20px;">Informasi Podcast</h3>
        
        <div style="display:flex;flex-direction:column;gap:16px;">
            {{-- Host and Guest info removed --}}

            <!-- Duration -->
            @if($podcast->duration)
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Durasi:</label>
                <span style="color:#6b7280;">{{ $podcast->duration }}</span>
            </div>
            @endif

            <!-- Published Date -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Tanggal Publikasi:</label>
                <span style="color:#6b7280;">{{ $podcast->published_date->format('d M Y') }}</span>
            </div>

            <!-- Sort Order -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Urutan Tampil:</label>
                <span style="color:#6b7280;">{{ $podcast->sort_order }}</span>
            </div>

            <!-- Views -->
            @if($podcast->views)
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:4px;">Views:</label>
                <span style="color:#6b7280;">{{ number_format($podcast->views) }}</span>
            </div>
            @endif
        </div>

        <!-- Status -->
        <div style="margin-top:24px;padding-top:24px;border-top:1px solid #e5e7eb;">
            <h4 style="font-weight:600;color:#374151;margin-bottom:12px;">Status:</h4>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <span style="background:{{ $podcast->is_active ? '#10b981' : '#ef4444' }};color:white;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                        {{ $podcast->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span style="background:{{ $podcast->is_featured ? '#f59e0b' : '#6b7280' }};color:white;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:500;">
                        {{ $podcast->is_featured ? 'Featured' : 'Normal' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="margin-top:24px;padding-top:24px;border-top:1px solid #e5e7eb;">
            <div style="display:flex;flex-direction:column;gap:8px;">
                <button onclick="toggleActive({{ $podcast->id }})" 
                        style="background:{{ $podcast->is_active ? '#ef4444' : '#10b981' }};color:white;padding:8px 16px;border:none;border-radius:6px;font-weight:500;cursor:pointer;width:100%;">
                    {{ $podcast->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                </button>
                <button onclick="toggleFeatured({{ $podcast->id }})" 
                        style="background:{{ $podcast->is_featured ? '#6b7280' : '#f59e0b' }};color:white;padding:8px 16px;border:none;border-radius:6px;font-weight:500;cursor:pointer;width:100%;">
                    {{ $podcast->is_featured ? 'Unfeature' : 'Feature' }}
                </button>
            </div>
        </div>
    </div>
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