<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseWeek extends Model
{
    protected $table = 'ecourse_weeks';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function ecourse()
    {
        return $this->belongsTo(Ecourse::class, 'ecourse_id', 'id_course');
    }

    public function materials()
    {
        return $this->hasMany(EcourseMaterial::class, 'week_id', 'id')->orderBy('sort_order');
    }
}
