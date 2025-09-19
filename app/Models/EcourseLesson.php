<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseLesson extends Model
{
    protected $fillable = [
        'ecourse_id',
        'title',
        'description',
        'content',
        'video_url',
        'duration',
        'sort_order',
        'is_free',
        'is_active',
    ];

    protected $casts = [
        'duration' => 'integer',
        'sort_order' => 'integer',
        'is_free' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the ecourse that owns the lesson
     */
    public function ecourse()
    {
        return $this->belongsTo(Ecourse::class);
    }

    /**
     * Get the progress for the lesson
     */
    public function progress()
    {
        return $this->hasMany(EcourseProgress::class);
    }

    /**
     * Scope for active lessons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for free lessons
     */
    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}