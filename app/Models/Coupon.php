<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $primaryKey = 'id_coupon';
    
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'used_count' => 'integer',
        'usage_limit' => 'integer',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_coupon', 'id_coupon');
    }

    public function isValid()
    {
        $now = Carbon::now();
        
        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }
        
        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }
        
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }
        
        return true;
    }

    public function calculateDiscount($subtotal)
    {
        if ($subtotal < $this->min_order_amount) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            $discount = $subtotal * ($this->discount_value / 100);
            
            if ($this->max_discount && $discount > $this->max_discount) {
                return $this->max_discount;
            }
            
            return $discount;
        }

        return $this->discount_value;
    }
}
