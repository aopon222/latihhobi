<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ecourse extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'category',
        'price',
        'discount_price',
        'duration',
        'total_lessons',
        'level',
        'image',
        'thumbnail',
        'demo_video',
        'is_featured',
        'is_active',
        'prerequisites',
        'learning_outcomes',
        'tools_needed',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'total_lessons' => 'integer',
        'prerequisites' => 'array',
        'learning_outcomes' => 'array',
        'tools_needed' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the lessons for the ecourse
     */
    public function lessons()
    {
        return $this->hasMany(EcourseLesson::class);
    }

    /**
     * Get the enrollments for the ecourse
     */
    public function enrollments()
    {
        return $this->hasMany(EcourseEnrollment::class);
    }

    /**
     * Scope for active ecourses
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured ecourses
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for ecourses by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for ecourses by level
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }
}