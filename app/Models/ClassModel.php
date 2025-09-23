<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'code',
        'program_id',
        'tutor_id',
        'school_id',
        'service_area_id',
        'name',
        'description',
        'type',
        'max_students',
        'current_students',
        'price',
        'registration_start',
        'registration_end',
        'start_date',
        'end_date',
        'schedule',
        'location',
        'location_details',
        'meeting_link',
        'meeting_password',
        'status',
        'notes',
        'materials',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'max_students' => 'integer',
        'current_students' => 'integer',
        'registration_start' => 'date',
        'registration_end' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'schedule' => 'array',
        'materials' => 'array',
    ];

    /**
     * Get the program that owns the class
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the tutor for the class
     */
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    /**
     * Get the school for the class
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the service area for the class
     */
    public function serviceArea()
    {
        return $this->belongsTo(ServiceArea::class);
    }

    /**
     * Get the schedules for the class
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the enrollments for the class
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Check if class is available for enrollment
     */
    public function isAvailable()
    {
        return $this->status === 'open' && 
               $this->current_students < $this->max_students &&
               now()->between($this->registration_start, $this->registration_end);
    }

    /**
     * Scope for active classes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope for classes by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for classes by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}