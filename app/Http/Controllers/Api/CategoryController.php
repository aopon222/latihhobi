<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; // nama tabel
    protected $primaryKey = 'id_category'; // primary key
    public $timestamps = true; // jika ada created_at & updated_at
    
    protected $fillable = [
        'name',
        // tambahkan kolom lain sesuai tabel category Anda
    ];

    /**
     * Relasi ke tabel course_card
     */
    public function courses()
    {
        return $this->hasMany(Ecourse::class, 'id_category', 'id_category');
    }
}