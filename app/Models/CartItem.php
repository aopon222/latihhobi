<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ecourse;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'id_cart_items';
    
    protected $fillable = [
        'id_cart',
        'id_course',
        'quantity',
        'price',
        'sub_total',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id_cart');
    }

    public function course()
    {
        return $this->belongsTo(Ecourse::class, 'id_course', 'id_course');
    }
}
