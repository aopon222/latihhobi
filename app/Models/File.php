<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'fileable_type',
        'fileable_id',
        'name',
        'original_name',
        'path',
        'size',
        'mime_type',
        'disk',
        'is_public',
    ];

    protected $casts = [
        'size' => 'integer',
        'is_public' => 'boolean',
    ];

    /**
     * Get the user that owns the file
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning fileable model
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * Get the URL for the file
     */
    public function getUrlAttribute()
    {
        if ($this->is_public) {
            return asset('storage/' . $this->path);
        }
        
        // For private files, we would generate a signed URL
        return route('files.download', $this->id);
    }
}