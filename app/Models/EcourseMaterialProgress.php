<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcourseMaterialProgress extends Model
{
    protected $table = 'ecourse_material_progress';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(EcourseMaterial::class, 'material_id', 'id');
    }
}
