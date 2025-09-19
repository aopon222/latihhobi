<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_terakhir',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'login_terakhir' => 'datetime',
        ];
    }

    /**
     * Get user's enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(\App\Models\Enrollment::class, 'student_id');
    }

    /**
     * Get user's parent enrollments
     */
    public function parentEnrollments()
    {
        return $this->hasMany(\App\Models\Enrollment::class, 'parent_id');
    }

    /**
     * Get user's posts
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    /**
     * Get user's communities
     */
    public function communities()
    {
        return $this->hasMany(\App\Models\Community::class, 'moderator_id');
    }

    /**
     * Get user's community memberships
     */
    public function communityMemberships()
    {
        return $this->hasMany(\App\Models\CommunityMember::class);
    }
}
