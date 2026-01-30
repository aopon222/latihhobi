@extends('admin.layout')

@section('title', 'Edit Event - Admin LatihHobi')

@section('admin-content')
<style>
    /* Hide number input spinners */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
<div style="max-width:900px;margin:0 auto;">
    <h1 style="font-size:1.75rem;font-weight:700;color:#111827;margin-bottom:16px;">Edit Event</h1>

    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label class="block font-semibold">Judul</label>
                <input name="title" value="{{ old('title', $event->title) }}" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Tanggal Mulai</label>
                <input type="datetime-local" name="start_date" value="{{ old('start_date', optional($event->start_date)->format('Y-m-d\TH:i')) }}" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Tanggal Selesai</label>
                <input type="datetime-local" name="end_date" value="{{ old('end_date', optional($event->end_date)->format('Y-m-d\TH:i')) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Lokasi</label>
                <input name="location" value="{{ old('location', $event->location) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Link (WhatsApp / Google Form / URL)</label>
                <input name="link" value="{{ old('link', $event->link) }}" placeholder="https://wa.me/62... or https://forms.gle/..." style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div style="grid-column:1 / -1;">
                <label class="block font-semibold">Deskripsi Singkat</label>
                <textarea name="short_description" style="width:100%;min-height:100px;padding:10px;border:1px solid #d1d5db;border-radius:8px;">{{ old('short_description', $event->short_description) }}</textarea>
            </div>
            <div style="grid-column:1 / -1;">
                <label class="block font-semibold">Deskripsi Lengkap</label>
                <textarea name="description" style="width:100%;min-height:200px;padding:10px;border:1px solid #d1d5db;border-radius:8px;">{{ old('description', $event->description) }}</textarea>
            </div>
            <div>
                <label class="block font-semibold">Pendaftaran Mulai</label>
                <input type="datetime-local" name="registration_start" value="{{ old('registration_start', optional($event->registration_start)->format('Y-m-d\TH:i')) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Pendaftaran Selesai</label>
                <input type="datetime-local" name="registration_end" value="{{ old('registration_end', optional($event->registration_end)->format('Y-m-d\TH:i')) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Max Peserta</label>
                <input type="number" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div>
                <label class="block font-semibold">Harga (IDR)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $event->price) }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;" />
            </div>
            <div style="grid-column:1 / -1;display:flex;gap:12px;align-items:center;margin-top:8px;">
                <label style="display:flex;gap:8px;align-items:center;"><input type="checkbox" name="is_active" {{ old('is_active', $event->is_active) ? 'checked' : '' }}> Aktif</label>
                <label style="display:flex;gap:8px;align-items:center;"><input type="checkbox" name="is_featured" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}> Featured</label>
            </div>
            <div style="grid-column:1 / -1;display:flex;gap:12px;align-items:center;">
                <div style="flex:1;">
                    <label class="block font-semibold">Gambar Event (jpg, png, webp)</label>
                    <input type="file" name="image" accept="image/*" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:8px;" />
                </div>
                <div style="width:160px;">
                    <label class="block font-semibold">Preview saat ini</label>
                    @if($event->image)
                        <img src="{{ asset('images/' . $event->image) }}" alt="Gambar event" style="width:160px;height:90px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;" />
                    @else
                        <div style="width:160px;height:90px;display:flex;align-items:center;justify-content:center;background:#f3f4f6;border-radius:6px;border:1px solid #e5e7eb;color:#6b7280;">Tidak ada gambar</div>
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-top:20px;display:flex;gap:12px;">
            <button type="submit" style="background:#2563eb;color:white;padding:12px 20px;border:none;border-radius:8px;">Simpan</button>
            <a href="{{ route('admin.events.index') }}" style="background:#6b7280;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;">Batal</a>
        </div>
    </form>
</div>
@endsection
