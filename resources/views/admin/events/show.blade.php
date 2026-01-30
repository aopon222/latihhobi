@extends('admin.layout')

@section('title', 'Detail Event - Admin LatihHobi')

@section('admin-content')
<div style="max-width:900px;margin:0 auto;">
    <h1 style="font-size:1.75rem;font-weight:700;color:#111827;margin-bottom:8px;">{{ $event->title }}</h1>
    <p style="color:#6b7280;margin-bottom:16px;">{{ $event->short_description }}</p>

    <div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.04);">
        @if($event->image)
            <div style="margin-bottom:12px;">
                <img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->title }}" style="max-width:100%;height:auto;border-radius:8px;border:1px solid #e5e7eb;" />
            </div>
        @endif
        <p><strong>Mulai:</strong> {{ $event->start_date ? $event->start_date->format('d M Y H:i') : '-' }}</p>
        <p><strong>Selesai:</strong> {{ $event->end_date ? $event->end_date->format('d M Y H:i') : '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $event->location ?: '-' }}</p>
        <p><strong>Pendaftaran:</strong> {{ $event->registration_start? $event->registration_start->format('d M Y') : '-' }} - {{ $event->registration_end? $event->registration_end->format('d M Y') : '-' }}</p>
        <p><strong>Max Peserta:</strong> {{ $event->max_participants ?: '-' }}</p>
        <p><strong>Harga:</strong> {{ $event->price ? number_format($event->price,2) : '-' }}</p>
        @if($event->link)
            <p><strong>Link:</strong> <a href="{{ $event->link }}" target="_blank" style="color:#2563eb;">Buka Link</a></p>
        @endif
        <p><strong>Status:</strong> {{ $event->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
        <p style="margin-top:12px;"><strong>Deskripsi Lengkap:</strong></p>
        <div style="padding:12px;background:#f9fafb;border-radius:6px;">{!! nl2br(e($event->description)) !!}</div>
    </div>

    <div style="margin-top:16px;display:flex;gap:12px;">
        <a href="{{ route('admin.events.edit', $event) }}" style="background:#f59e0b;color:white;padding:12px;border-radius:8px;text-decoration:none;">Edit</a>
        <a href="{{ route('admin.events.index') }}" style="background:#6b7280;color:white;padding:12px;border-radius:8px;text-decoration:none;">Kembali</a>
    </div>
</div>
@endsection
