<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseEnrollment extends Model
{
    protected $fillable = [
        'ecourse_id',
        'user_id',
        'enrolled_at',
        'completed_at',
        'progress_percentage',
        'certificate_issued',
        'certificate_issued_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'certificate_issued_at' => 'datetime',
        'progress_percentage' => 'decimal:2',
        'certificate_issued' => 'boolean',
    ];

    /**
     * Get the ecourse for the enrollment
     */
    public function ecourse()
    {
        return $this->belongsTo(Ecourse::class);
    }

    /**
     * Get the user for the enrollment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the progress for the enrollment
     */
    public function progress()
    {
        return $this->hasMany(EcourseProgress::class);
    }

    /**
     * Check if enrollment is completed
     */
    public function isCompleted()
    {
        return $this->progress_percentage >= 100;
    }
}