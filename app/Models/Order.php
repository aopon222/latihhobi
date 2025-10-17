<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    
    protected $fillable = [
        'id_user',
        'id_coupon',
        'coupon_code',
        'discount_amount',
        'subtotal',
        'total_amount',
        'order_date',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'order_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'id_coupon', 'id_coupon');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }
}
