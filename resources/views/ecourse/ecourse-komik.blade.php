@extends('layout.app')

@section('title', 'E-Course Komik - LatihHobi')

@section('content')
<section class="ecourse-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 40px 20px; text-align: center; margin-bottom: 40px;">
    <div class="ecourse-container">
        <h1 style="font-size: 2.5rem; margin: 0 0 10px 0;">E-Course Komik</h1>
        <p style="font-size: 1.1rem; margin: 0;">Pelajari seni membuat komik dari dasar hingga mahir</p>
    </div>
</section>

<section class="products-section" style="padding: 40px 20px;">
    <div class="products-container" style="max-width: 1200px; margin: 0 auto;">
        <h2>Kursus Komik Tersedia</h2>
        
        @if($komikCourses->count() > 0)
            <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
                @foreach($komikCourses as $course)
                    <div class="product-card" style="background: white; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                        <div class="product-image" style="width: 100%; height: 200px; overflow: hidden; background: #f5f5f5;">
                            <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="product-info" style="padding: 15px;">
                            <h3 style="margin: 0 0 8px 0; font-size: 1.1rem;">{{ $course->name }}</h3>
                            <p style="color: #666; font-size: 0.9rem; margin: 5px 0;">By {{ $course->course_by ?? 'Latihhobi' }}</p>
                            <div style="margin: 10px 0;">
                                <span style="font-size: 1.3rem; font-weight: bold; color: #f5576c;">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top: 15px;">
                                <a href="{{ route('ecourse.show', $course->id_course) }}" style="flex: 1; padding: 8px 12px; border: none; border-radius: 4px; background: #f0f0f0; color: #333; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">Lihat Detail</a>
                                <form action="{{ route('ecourse.addToCart', $course->id_course) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" style="width: 100%; padding: 8px 12px; border: none; border-radius: 4px; background: #f5576c; color: white; cursor: pointer;">Tambah ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px; color: #999;">
                <p>Belum ada kursus komik tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>
@endsection
