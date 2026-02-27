<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    protected $fillable = ['id_input', 'status', 'tanggal_proses', 'tanggal_selesai', 'feedback'];
    public $timestamps = true;

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_input', 'id_input');
    }
}
