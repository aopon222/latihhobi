<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'name',
        'icon',
    ];

    public function courses()
    {
        return $this->hasMany(CourseCard::class, 'id_category', 'id_category');
    }

    public function courseContents()
    {
        return $this->hasMany(CourseContent::class, 'id_category', 'id_category');
    }

}