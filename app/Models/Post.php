<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'content',
        'media',
        'type',
        'status',
        'likes_count',
        'comments_count',
        'views_count',
        'is_pinned',
        'is_featured',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'media' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
        'likes_count' => 'integer',
        'comments_count' => 'integer',
        'views_count' => 'integer',
        'is_pinned' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user that owns the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the community for the post
     */
    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * Scope for published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for featured posts
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for pinned posts
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope for posts by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for posts by community
     */
    public function scopeByCommunity($query, $communityId)
    {
        return $query->where('community_id', $communityId);
    }
}