@extends('layout.app')
@section('title', 'E-Course Robotik - LatihHobi')

@section('content')
    <style>
        .robotik-page {
            background: linear-gradient(135deg, #00b4db 0%, #0083b0 100%);
            min-height: 100vh;
            padding: 120px 20px 60px;
        }

        .robotik-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .robotik-header h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .courses-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .robot-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .robot-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .robot-image-wrapper {
            width: 100%;
            height: 260px !important;
            max-height: 260px !important;
            background: #2c3e50;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
            display: block;
        }

        .robot-image-wrapper img {
            width: 100% !important;
            height: 100% !important;
            max-height: 260px !important;
            object-fit: cover !important;
            aspect-ratio: 16 / 9 !important;
            display: block !important;
        }

        .robot-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .robot-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .robot-instructor {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .price-section {
            display: flex;
            align-items: baseline;
            gap: 10px;
        }

        .current-price {
            font-size: 1.4rem;
            font-weight: 800;
            color: #27ae60;
        }

        .original-price {
            font-size: 0.95rem;
            color: #95a5a6;
            text-decoration: line-through;
        }

        .no-courses {
            text-align: center;
            padding: 80px 20px;
            color: white;
        }

        .no-courses i {
            font-size: 5rem;
            margin-bottom: 30px;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .robotik-header h1 {
                font-size: 2.5rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>

    <section class="robotik-page">
        <div class="robotik-header">
            <h1>E-Course Robotik</h1>
        </div>

        <div class="courses-container">
            @if (session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {!! session('success') !!}
                </div>
            @endif
            @if (session('info'))
                <div style="background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bee5eb;">
                    {!! session('info') !!}
                </div>
            @endif
            @if (session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    {!! session('error') !!}
                </div>
            @endif

            @php
                // Support both old and new variable names
                $coursesToShow = $robotikCourses ?? $courses ?? collect();
            @endphp

            @if ($coursesToShow->count() > 0)
                <div class="courses-grid">
                    @foreach ($coursesToShow as $course)
                        <div class="robot-card">
                            <div class="robot-image-wrapper">
                                <img src="{{ getEcourseImageUrl($course->image_url) }}" alt="{{ $course->name }}" style="width:100%;height:260px;max-height:260px;object-fit:cover;aspect-ratio:16/9;display:block;">
                            </div>
                            <div class="robot-info">
                                <h3 class="robot-title">{{ $course->name }}</h3>
                                @if ($course->course_by)
                                    <p class="robot-instructor">{{ $course->course_by }}</p>
                                @endif

                                <div class="price-section">
                                    <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                </div>

                                <div class="button-group" style="display: flex; gap: 10px; margin-top: auto;">
                                    <a href="{{ route('ecourse.show', $course->id_course) }}" class="btn-detail" style="flex: 1; background: #007bff; color: white; text-decoration: none; padding: 10px; border-radius: 6px; text-align: center; font-weight: 500; transition: background 0.3s;">
                                        Lihat Detail
                                    </a>
                                    <form action="{{ route('ecourse.addToCart', $course->id_course) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn-cart" style="width: 100%; background: #28a745; color: white; border: none; padding: 10px; border-radius: 6px; font-weight: 500; cursor: pointer; transition: background 0.3s;">
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-courses">
                    <i class="fas fa-robot"></i>
                    <h3>Belum Ada Kursus Robotik</h3>
                    <p>Kursus robotik akan segera hadir. Pantau terus untuk update terbaru!</p>
                </div>
            @endif
        </div>
    </section>
@endsection

<style>
.btn-detail:hover {
    background: #0056b3 !important;
}

.btn-cart:hover {
    background: #218838 !important;
}
</style>
