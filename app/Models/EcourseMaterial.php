<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseMaterial extends Model
{
    protected $table = 'ecourse_materials';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function week()
    {
        return $this->belongsTo(EcourseWeek::class, 'week_id', 'id');
    }

    public function ecourse()
    {
        return $this->hasOneThrough(
            Ecourse::class,
            EcourseWeek::class,
            'id',
            'id_course',
            'week_id',
            'ecourse_id'
        );
    }

    public function progresses()
    {
        return $this->hasMany(EcourseMaterialProgress::class, 'material_id', 'id');
    }

    public function getProgressForUser($userId)
    {
        return $this->progresses()->where('user_id', $userId)->first();
    }
}
