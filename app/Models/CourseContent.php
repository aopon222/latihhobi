<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $table = 'course_content';
    protected $primaryKey = 'id_content';
    
    protected $fillable = [
        'id_course',
        'id_category',
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

    protected $casts = [
        'certificate' => 'boolean',
        'enrolled' => 'integer',
        'validity' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(CourseCard::class, 'id_course', 'id_course');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
