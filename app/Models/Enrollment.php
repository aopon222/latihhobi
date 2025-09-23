<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'enrollment_number',
        'student_id',
        'class_id',
        'parent_id',
        'original_price',
        'discount_amount',
        'final_price',
        'paid_amount',
        'payment_status',
        'status',
        'enrolled_at',
        'started_at',
        'completed_at',
        'notes',
        'parent_notes',
        'emergency_contact',
        'special_needs',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'enrolled_at' => 'date',
        'started_at' => 'date',
        'completed_at' => 'date',
        'emergency_contact' => 'array',
        'special_needs' => 'array',
    ];

    /**
     * Get the student for the enrollment
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the parent for the enrollment
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Get the class for the enrollment
     */
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Get the payments for the enrollment
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Generate enrollment number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($enrollment) {
            if (empty($enrollment->enrollment_number)) {
                $enrollment->enrollment_number = 'ENR-' . now()->format('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    /**
     * Scope for enrollments by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for enrollments by payment status
     */
    public function scopeByPaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    /**
     * Get remaining amount to be paid
     */
    public function getRemainingAmountAttribute()
    {
        return $this->final_price - $this->paid_amount;
    }

    /**
     * Check if enrollment is fully paid
     */
    public function isFullyPaid()
    {
        return $this->paid_amount >= $this->final_price;
    }
}