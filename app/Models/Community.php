<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'image',
        'cover_image',
        'moderator_id',
        'member_count',
        'post_count',
        'type',
        'rules',
        'categories',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'member_count' => 'integer',
        'post_count' => 'integer',
        'rules' => 'array',
        'categories' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the moderator for the community
     */
    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    /**
     * Get the members for the community
     */
    public function members()
    {
        return $this->hasMany(CommunityMember::class);
    }

    /**
     * Get the posts for the community
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Scope for active communities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured communities
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for communities by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}