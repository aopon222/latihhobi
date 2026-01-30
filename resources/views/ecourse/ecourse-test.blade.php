@extends('layout.app')
@section('title', 'E-Course test - LatihHobi')

@section('content')
    <style>
        .test-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 120px 20px 60px;
        }

        .test-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .test-header h1 {
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

        .course-card {
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

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .course-image-wrapper {
            width: 100%;
            height: 260px !important;
            max-height: 260px !important;
            background: #2c3e50;
            position: relative;
            overflow: hidden;
        }

        .course-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .course-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .course-instructor {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 12px;
        }

        .course-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            margin-top: 12px;
        }

        .course-price-original {
            font-size: 0.9rem;
            text-decoration: line-through;
            color: #9ca3af;
        }

        .view-course-btn {
            margin-top: 16px;
            padding: 10px 16px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .view-course-btn:hover {
            background: #5568d3;
            transform: translateX(2px);
        }

        @media (max-width: 768px) {
            .test-header h1 {
                font-size: 2rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>

    <div class="test-page">
        <div class="courses-container">
            <div class="test-header">
                <h1>test</h1>
                <p style="color: white; font-size: 1.1rem; margin-top: 10px;">Pelajari kursus test dengan instruktur berpengalaman</p>
            </div>

            @if($courses && $courses->count() > 0)
                <div class="courses-grid">
                    @foreach($courses as $course)
                        <div class="course-card">
                            <div class="course-image-wrapper">
                                <img src="{{ getEcourseImageUrl($course->image_url) }}" 
                                     alt="{{ $course->name }}" 
                                     onerror="this.src='{{ asset('images/placeholder-gallery-1.svg') }}'">
                            </div>
                            <div class="course-info">
                                <div>
                                    <div class="course-name">{{ $course->name }}</div>
                                    <div class="course-instructor">{{ $course->course_by ?? 'LatihHobi' }}</div>
                                </div>
                                <div>
                                    <div class="course-price">
                                        Rp {{ number_format($course->price ?? 0, 0, ',', '.') }}
                                        @if($course->original_price && $course->original_price > $course->price)
                                            <div class="course-price-original">Rp {{ number_format($course->original_price, 0, ',', '.') }}</div>
                                        @endif
                                    </div>
                                    <a href="{{ route('ecourse.show', $course->id_course) }}" class="view-course-btn">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; color: white;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 10px;">Belum ada kursus</h2>
                    <p>Kursus test akan segera tersedia</p>
                </div>
            @endif
        </div>
    </div>
@endsection