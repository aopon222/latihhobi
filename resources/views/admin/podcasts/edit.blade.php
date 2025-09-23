@extends('admin.layout')

@section('title', 'Edit Podcast - Admin LatihHobi')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Edit Podcast</h1>
    <a href="{{ route('admin.podcasts.index') }}" 
       style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
        ← Kembali
    </a>
</div>

<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
    <form method="POST" action="{{ route('admin.podcasts.update', $podcast) }}">
        @csrf
        @method('PUT')
        
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-bottom:24px;">
            <!-- Judul -->
            <div style="grid-column:span 2;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Judul Podcast <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $podcast->title) }}" required
                       placeholder="Masukkan judul podcast..."
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('title') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('title')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- YouTube URL -->
            <div style="grid-column:span 2;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    YouTube URL <span style="color:#ef4444;">*</span>
                </label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $podcast->youtube_url) }}" required
                       placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/..."
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('youtube_url') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('youtube_url')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">
                    Masukkan URL lengkap video YouTube (contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ)
                </p>
            </div>

            <!-- Host -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Host <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="host" value="{{ old('host', $podcast->host) }}" required
                       placeholder="Nama host podcast..."
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('host') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('host')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guest -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Guest
                </label>
                <input type="text" name="guest" value="{{ old('guest', $podcast->guest) }}"
                       placeholder="Nama tamu (opsional)..."
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('guest') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('guest')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Publikasi -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Tanggal Publikasi <span style="color:#ef4444;">*</span>
                </label>
                <input type="date" name="published_date" value="{{ old('published_date', $podcast->published_date->format('Y-m-d')) }}" required
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('published_date') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('published_date')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Durasi -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Durasi
                </label>
                <input type="text" name="duration" value="{{ old('duration', $podcast->duration) }}"
                       placeholder="Contoh: 45 menit"
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('duration') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('duration')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div style="margin-bottom:24px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                Deskripsi <span style="color:#ef4444;">*</span>
            </label>
            <textarea name="description" rows="5" required
                      placeholder="Deskripsi lengkap tentang podcast..."
                      style="width:100%;padding:12px;border:1px solid {{ $errors->has('description') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;">{{ old('description', $podcast->description) }}</textarea>
            @error('description')
                <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Topics -->
        <div style="margin-bottom:24px;">
            <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                Topik/Tag
            </label>
            <input type="text" name="topics" value="{{ old('topics', is_array($podcast->topics) ? implode(', ', $podcast->topics) : '') }}"
                   placeholder="Pisahkan dengan koma: teknologi, robotik, pendidikan..."
                   style="width:100%;padding:12px;border:1px solid {{ $errors->has('topics') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
            @error('topics')
                <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
            @enderror
            <p style="color:#6b7280;font-size:12px;margin-top:4px;">
                Pisahkan setiap topik dengan koma
            </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:32px;">
            <!-- Sort Order -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">
                    Urutan Tampil
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $podcast->sort_order) }}" min="0"
                       style="width:100%;padding:12px;border:1px solid {{ $errors->has('sort_order') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                @error('sort_order')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">
                    Semakin kecil angka, semakin atas urutan tampil
                </p>
            </div>

            <!-- Status Checkboxes -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Status</label>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $podcast->is_active) ? 'checked' : '' }}
                               style="width:16px;height:16px;">
                        <span style="color:#374151;font-size:14px;">Aktif</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $podcast->is_featured) ? 'checked' : '' }}
                               style="width:16px;height:16px;">
                        <span style="color:#374151;font-size:14px;">Featured</span>
                    </label>
                </div>
            </div>

            <!-- Preview -->
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Preview</label>
                <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;">
                    <img src="{{ $podcast->thumbnail_url }}" alt="Thumbnail" 
                         style="width:100%;height:60px;object-fit:cover;border-radius:4px;margin-bottom:8px;">
                    <a href="{{ $podcast->watch_url }}" target="_blank" 
                       style="color:#2563eb;text-decoration:none;font-size:12px;">
                        ► Lihat di YouTube
                    </a>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div style="display:flex;justify-content:end;gap:16px;padding-top:24px;border-top:1px solid #e5e7eb;">
            <a href="{{ route('admin.podcasts.index') }}" 
               style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                Batal
            </a>
            <button type="submit" 
                    style="background:#2563eb;color:white;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                Update Podcast
            </button>
        </div>
    </form>
</div>
@endsection