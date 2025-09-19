<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    protected $fillable = [
        'community_id',
        'user_id',
        'role',
        'joined_at',
        'is_active',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the community that owns the member
     */
    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * Get the user for the member
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for members by role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}