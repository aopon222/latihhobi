<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ecourse extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id_course';

    protected $fillable = [
        'id_category',
        'name',
        'course_by',
        'price',
        'original_price',
        'image_url',
        'perakitan',
        'worksheet',
        'ebook',
        'live_session',
        'mini_competition',
        'level',
        'enrolled',
        'validity',
        'certificate',
    ];

    // Laravel otomatis pakai created_at dan updated_at
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query;
    }

    public function category()
    {
        // Pastikan foreign key & local key sesuai struktur tabel kamu
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
