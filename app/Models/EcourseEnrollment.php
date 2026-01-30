<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseEnrollment extends Model
{
    protected $table = 'ecourse_enrollments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'id_course',
        'status',
        'is_locked',
        'enrolled_at',
        'completed_at'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ecourse()
    {
        return $this->belongsTo(Ecourse::class, 'id_course', 'id_course');
    }
}
