@php $hideNavbar = true; @endphp
@extends('layout.app')

@section('title', 'Daftar Diskon - LatihHobi')

@section('content')
<div style="min-height:100vh;background:#f8fafc;display:flex;">
    <aside style="width:240px;background:#fff;border-right:1px solid #e5e7eb;box-shadow:0 2px 8px rgba(0,0,0,0.04);display:flex;flex-direction:column;align-items:center;padding:32px 0;">
        <img src="{{ asset('images/latihhobi-logo.png') }}" alt="LatihHobi" style="height:48px;margin-bottom:32px;">
        <nav style="width:100%;">
            <a href="{{ route('admin.dashboard') }}" style="display:block;padding:12px 32px;color:#2563eb;font-weight:600;text-decoration:none;border-radius:8px;margin-bottom:8px;background:#e0e7ff;">Dashboard</a>
            <a href="{{ route('admin.ecourses.index') }}" style="display:block;padding:12px 32px;color:#374151;font-weight:500;text-decoration:none;border-radius:8px;margin-bottom:8px;">E-course</a>
        </nav>
    </aside>

    <main style="flex:1;padding:48px 32px;">
        <h1 style="font-size:2rem;font-weight:700;color:#2563eb;margin-bottom:24px;">Daftar Diskon E-course</h1>
        <div style="background:#fff;border-radius:12px;padding:20px;border:1px solid #eef2ff;">
            @if($discounts->isEmpty())
                <p>Tidak ada e-course dengan diskon saat ini.</p>
            @else
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="text-align:left;border-bottom:1px solid #eef2ff;">
                            <th style="padding:10px 8px;font-weight:600;color:#374151;">Judul</th>
                            <th style="padding:10px 8px;font-weight:600;color:#374151;">Harga Asli</th>
                            <th style="padding:10px 8px;font-weight:600;color:#374151;">Harga Sekarang</th>
                            <th style="padding:10px 8px;font-weight:600;color:#374151;">Diskon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($discounts as $d)
                            <tr style="border-bottom:1px solid #f8fafc;">
                                <td style="padding:10px 8px;">{{ $d->name }}</td>
                                <td style="padding:10px 8px;">Rp {{ number_format((float)preg_replace('/[^0-9\.]/','',$d->original_price),0,',','.') }}</td>
                                <td style="padding:10px 8px;">Rp {{ number_format($d->price,0,',','.') }}</td>
                                <td style="padding:10px 8px;">Rp {{ number_format($d->discount_amount,0,',','.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</div>
@endsection
