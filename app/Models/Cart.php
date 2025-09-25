<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'quantity',
        'price',
        'discount_price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item associated with the cart item
     */
    public function item()
    {
        return $this->morphTo();
    }

    /**
     * Get the total price for this cart item
     */
    public function getTotalPriceAttribute()
    {
        $price = $this->discount_price ?? $this->price;
        return $price * $this->quantity;
    }
}