<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'image',
        'rating',
        'total_reviews',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_active' => 'boolean'
    ];

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/placeholder-course.jpg');
    }
}