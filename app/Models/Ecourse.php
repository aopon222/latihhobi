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
        'level',
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

    /**
     * Lessons relation - no table currently in use
     * Returns empty collection if called
     */
    public function lessons()
    {
        // Placeholder for future implementation
        // Currently no lessons table exists in the database
        return $this->hasMany(\App\Models\EcourseLesson::class, 'ecourse_id', 'id_course');
    }

    /**
     * Enrollments relation
     */
    public function enrollments()
    {
        return $this->hasMany(\App\Models\EcourseEnrollment::class, 'ecourse_id', 'id_course');
    }
}
