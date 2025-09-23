<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_number',
        'enrollment_id',
        'amount',
        'payment_method',
        'transaction_id',
        'reference_number',
        'gateway_response',
        'status',
        'paid_at',
        'expired_at',
        'notes',
        'proof_images',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'gateway_response' => 'array',
        'proof_images' => 'array',
    ];

    /**
     * Get the enrollment that owns the payment
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Generate payment number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->payment_number)) {
                $payment->payment_number = 'PAY-' . now()->format('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    /**
     * Scope for payments by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for payments by payment method
     */
    public function scopeByMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }
}