<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseProgress extends Model
{
    protected $fillable = [
        'ecourse_enrollment_id',
        'ecourse_lesson_id',
        'started_at',
        'completed_at',
        'watched_duration',
        'total_duration',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'watched_duration' => 'integer',
        'total_duration' => 'integer',
    ];

    /**
     * Get the enrollment for the progress
     */
    public function enrollment()
    {
        return $this->belongsTo(EcourseEnrollment::class, 'ecourse_enrollment_id');
    }

    /**
     * Get the lesson for the progress
     */
    public function lesson()
    {
        return $this->belongsTo(EcourseLesson::class, 'ecourse_lesson_id');
    }

    /**
     * Check if lesson is completed
     */
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    /**
     * Get completion percentage
     */
    public function getCompletionPercentageAttribute()
    {
        if ($this->total_duration > 0) {
            return ($this->watched_duration / $this->total_duration) * 100;
        }
        return 0;
    }
}