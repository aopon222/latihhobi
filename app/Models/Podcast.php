<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_id',
        'thumbnail_url',
        'duration',
        'host',
        'guest',
        'topics',
        'published_date',
        'views',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'topics' => 'array',
        'published_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get YouTube embed URL
     */
    public function getEmbedUrlAttribute()
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }

    /**
     * Get YouTube watch URL
     */
    public function getWatchUrlAttribute()
    {
        return "https://www.youtube.com/watch?v={$this->youtube_id}";
    }

    /**
     * Get YouTube URL for form input
     */
    public function getYoutubeUrlAttribute()
    {
        return $this->youtube_id ? "https://www.youtube.com/watch?v={$this->youtube_id}" : '';
    }

    /**
     * Get thumbnail URL from YouTube
     */
    public function getThumbnailUrlAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
    }

    /**
     * Scope for active podcasts
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured podcasts
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
        return $query->orderBy('sort_order')->orderBy('published_date', 'desc');
    }
}