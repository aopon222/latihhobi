<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EcourseCategoryViewService
{
    /**
     * Generate a view file for a new ecourse category
     * 
     * @param string $categoryName
     * @param int $categoryId
     * @return bool
     */
    public static function generateCategoryView($categoryName, $categoryId)
    {
        try {
            $slugName = Str::slug($categoryName);
            $viewPath = resource_path("views/ecourse/ecourse-{$slugName}.blade.php");

            // Check if view already exists
            if (File::exists($viewPath)) {
                return true;
            }

            // Generate the view content
            $viewContent = self::generateViewContent($categoryName, $categoryId);

            // Create the view file
            File::put($viewPath, $viewContent);

            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to generate ecourse category view: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate the content for the category view file
     * 
     * @param string $categoryName
     * @param int $categoryId
     * @return string
     */
    private static function generateViewContent($categoryName, $categoryId)
    {
        // Use a single shared teal gradient and consistent structure to match existing pages
        $slug = Str::slug($categoryName);
        $gradient1 = '#00b4db';
        $gradient2 = '#0083b0';
        $accent = '#00b4db';
        $accentDark = '#0099b5';

        return <<<EOT
@extends('layout.app')
@section('title', 'E-Course {$categoryName} - LatihHobi')

@section('head')
    <style>
        html {
            overflow-x: hidden !important;
            width: 100% !important;
        }
        body {
            overflow-x: hidden !important;
            width: 100% !important;
        }
        main {
            width: 100% !important;
            overflow-x: hidden !important;
        }
    </style>
@endsection

@section('content')
    <style>
        .ecourse-category-page {
            background: linear-gradient(135deg, {$gradient1} 0%, {$gradient2} 100%);
            min-height: 100vh;
            padding: 120px 20px 60px;
        }

        .ecourse-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .ecourse-header h1 {
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
            min-height: 480px;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .course-image-wrapper {
            width: 100%;
            height: 240px;
            background: #f0f0f0;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            background: #f0f0f0;
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
            color: {$accent};
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
            background: {$accent};
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
            background: {$accentDark};
            transform: translateX(2px);
        }

        @media (max-width: 768px) {
            .ecourse-header h1 {
                font-size: 2rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>

    <div class="ecourse-category-page">
        <div class="courses-container">
            <div class="ecourse-header">
                <h1>E-Course {$categoryName}</h1>
                <p style="color: white; font-size: 1.1rem; margin-top: 10px;">Pelajari kursus {$categoryName} dengan instruktur berpengalaman</p>
            </div>

            @php
                // Use the generic variable name 'courses' provided by controller
                \$courseList = \$courses ?? collect();
            @endphp

            @if(\$courseList && \$courseList->count() > 0)
                <div class="courses-grid">
                    @foreach(\$courseList as \$course)
                        <div class="course-card">
                            <div class="course-image-wrapper">
                                <img src="{{ getEcourseImageUrl(\$course->image_url) }}" 
                                     alt="{{ \$course->name }}">
                            </div>
                            <div class="course-info">
                                <div>
                                    <div class="course-name">{{ \$course->name }}</div>
                                    <div class="course-instructor">{{ \$course->course_by ?? 'LatihHobi' }}</div>
                                </div>
                                <div>
                                    <div class="course-price">
                                        Rp {{ number_format(\$course->price ?? 0, 0, ',', '.') }}
                                        @if(\$course->original_price && \$course->original_price > \$course->price)
                                            <div class="course-price-original">Rp {{ number_format(\$course->original_price, 0, ',', '.') }}</div>
                                        @endif
                                    </div>
                                    <a href="{{ route('ecourse.show', \$course->id_course) }}" class="view-course-btn">
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
                    <p>Kursus {$categoryName} akan segera tersedia</p>
                </div>
            @endif
        </div>
    </div>
@endsection
EOT;
    }

    /**
     * Get color scheme for category based on its name
     * 
     * @param string $categoryName
     * @return array
     */
    private static function getCategoryColor($categoryName)
    {
        $colors = [
            'default' => [
                'gradient1' => '#667eea',
                'gradient2' => '#764ba2',
                'accent' => '#667eea',
                'accentDark' => '#5568d3',
            ],
            'robotik' => [
                'gradient1' => '#00b4db',
                'gradient2' => '#0083b0',
                'accent' => '#00b4db',
                'accentDark' => '#0099b5',
            ],
            'komik' => [
                'gradient1' => '#f093fb',
                'gradient2' => '#f5576c',
                'accent' => '#f5576c',
                'accentDark' => '#d94655',
            ],
            'film' => [
                'gradient1' => '#ff6b35',
                'gradient2' => '#f7931e',
                'accent' => '#ff6b35',
                'accentDark' => '#e55a2a',
            ],
        ];

        $categorySlug = Str::slug($categoryName);
        
        // Check if there's a specific color scheme for this category
        foreach ($colors as $key => $color) {
            if (Str::contains($categorySlug, $key)) {
                return $color;
            }
        }

        // Return default color scheme
        return $colors['default'];
    }
}
