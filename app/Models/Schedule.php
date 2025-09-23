<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'class_id',
        'day_of_week',
        'start_time',
        'end_time',
        'specific_date',
        'session_topic',
        'session_description',
        'status',
    ];

    protected $casts = [
        'specific_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the class that owns the schedule
     */
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Scope for schedules by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}