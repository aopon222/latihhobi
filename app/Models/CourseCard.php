<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCard extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id_course';
    
    protected $fillable = [
        'id_category',
        'name',
        'course_by',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function content()
    {
        return $this->hasOne(CourseContent::class, 'id_course', 'id_course');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'id_course', 'id_course');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_course', 'id_course');
    }
}
