<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'type',
        'price',
        'discount_price',
        'duration',
        'total_sessions',
        'max_students',
        'min_students',
        'min_age',
        'max_age',
        'difficulty_level',
        'image',
        'gallery',
        'curriculum',
        'requirements',
        'benefits',
        'tools_needed',
        'terms_conditions',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'total_sessions' => 'integer',
        'max_students' => 'integer',
        'min_students' => 'integer',
        'min_age' => 'integer',
        'max_age' => 'integer',
        'gallery' => 'array',
        'curriculum' => 'array',
        'requirements' => 'array',
        'benefits' => 'array',
        'tools_needed' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the categories for the program
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'program_categories');
    }

    /**
     * Get the classes for the program
     */
    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Scope for active programs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured programs
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope for filtering by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}