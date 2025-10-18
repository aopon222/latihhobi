<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    
    protected $fillable = [
        'id_user',
        'id_course'
    ];

        public function course()
    {
        return $this->belongsTo(Ecourse::class, 'id_course');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'id_cart', 'id_cart');
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }
}