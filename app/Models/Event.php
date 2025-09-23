<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'type',
        'start_date',
        'end_date',
        'registration_start',
        'registration_end',
        'location',
        'location_details',
        'max_participants',
        'current_participants',
        'price',
        'image',
        'is_featured',
        'is_active',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'max_participants' => 'integer',
        'current_participants' => 'integer',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active events
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Scope for featured events
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Check if event is available for registration
     */
    public function isAvailable()
    {
        return $this->is_active && 
               $this->status === 'open' &&
               now()->between($this->registration_start, $this->registration_end) &&
               $this->current_participants < $this->max_participants;
    }
}