<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    protected $fillable = [
        'kota',
        'provinsi',
        'kecamatan',
        'is_priority',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'kecamatan' => 'array',
        'is_priority' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the classes for the service area
     */
    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }

    /**
     * Scope for active service areas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for priority service areas
     */
    public function scopePriority($query)
    {
        return $query->where('is_priority', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}