<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseLesson extends Model
{
    protected $table = 'ecourse_lessons';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function ecourse()
    {
        return $this->belongsTo(Ecourse::class, 'ecourse_id', 'id_course');
    }
}
