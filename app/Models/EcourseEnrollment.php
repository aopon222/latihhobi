<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseEnrollment extends Model
{
    protected $table = 'ecourse_enrollments';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
}
