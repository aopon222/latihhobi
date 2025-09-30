<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'date_of_birth',
        'gender',
        // 'avatar' removed - profile photo feature disabled
        'bio',
        'occupation',
        'school',
        'grade',
        'parent_name',
        'parent_phone',
        'parent_email',
        'emergency_contact_name',
        'emergency_contact_phone',
        'special_needs',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'special_needs' => 'array',
    ];

    /**
     * Get the user that owns the profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}