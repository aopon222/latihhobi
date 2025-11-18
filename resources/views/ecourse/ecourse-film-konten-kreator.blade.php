@extends('layout.app')
@section('title', 'E-Course Film & Konten Kreator - LatihHobi')

@section('content')
    <style>
        .film-page {
            background: linear-gradient(135deg, #00b4db 0%, #0083b0 100%);
            min-height: 100vh;
            padding: 120px 20px 60px;
        }

        .film-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .film-header h1 {
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
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .film-card {
            width: 380px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .film-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .film-image {
            width: 100%;
            height: 280px;
            background: #2c3e50;
            position: relative;
            overflow: hidden;
        }

        .film-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .film-info {
            padding: 25px;
            text-align: left;
        }

        .film-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .film-instructor {
            color: #7f8c8d;
            font-size: 0.95rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .price-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .current-price {
            font-size: 1.6rem;
            font-weight: 800;
            color: #27ae60;
        }

        .original-price {
            font-size: 1.1rem;
            color: #95a5a6;
            text-decoration: line-through;
            font-weight: 500;
        }

        /* Specific film card coloring */
        .film-card:nth-child(1) .film-image {
            border-top: 4px solid #3498db;
        }

        .film-card:nth-child(2) .film-image {
            border-top: 4px solid #e74c3c;
        }

        .film-card:nth-child(3) .film-image {
            border-top: 4px solid #f39c12;
        }

        .film-card:nth-child(4) .film-image {
            border-top: 4px solid #9b59b6;
        }

        .film-card:nth-child(5) .film-image {
            border-top: 4px solid #1abc9c;
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
            .film-header h1 {
                font-size: 2.5rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 10px;
            }

            .film-card {
                width: 100%;
                max-width: 380px;
            }
    </style>

    <!-- Hero Section -->
    <section class="film-page">
        <div class="film-header">
            <h1>E-Course Film & Konten Kreator</h1>
        </div>

        <div class="courses-container">
            @if ($filmCourses->count() > 0)
                <div class="courses-grid">
                    @foreach ($filmCourses as $course)
                        <div class="film-card">
                            <div class="film-image">
                                @if ($course->image_url)
                                    <img src="{{ asset('images/' . $course->image_url) }}" alt="{{ $course->name }}">
                                @else
                                    <img src="{{ asset('images/FILM1.svg') }}" alt="{{ $course->name }}">
                                @endif
                            </div>
                            <div class="film-info">
                                <h3 class="film-title">{{ $course->name }}</h3>
                                @if ($course->course_by)
                                    <p class="film-instructor">By {{ $course->course_by }}</p>
                                @endif

                                <div class="price-section">
                                    <span class="current-price">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                    @if ($course->original_price)
                                        <span
                                            class="original-price">Rp{{ number_format($course->original_price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-courses">
                    <i class="fas fa-video"></i>
                    <h3>Belum Ada Kursus Film & Content Creation</h3>
                    <p>Kursus film dan content creation akan segera hadir. Pantau terus untuk update terbaru!</p>
                </div>
            @endif
        </div>
    </section>
@endsection
