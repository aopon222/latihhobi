<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'ttl',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'email',
        'password',
        'role',
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

        protected $casts = [
        'email_verified_at' => 'datetime',
        'ttl' => 'date',
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

    /**
     * Get user's e-course enrollments
     */
    public function ecourseEnrollments()
    {
        return $this->hasMany(\App\Models\EcourseEnrollment::class);
    }

    /**
     * Get user's event registrations
     */
    public function eventRegistrations()
    {
        return $this->hasMany(\App\Models\EventRegistration::class);
    }

    /**
     * Get user's cart items
     */
    public function cart()
    {
        return $this->hasOne(Cart::class, 'id_user');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'id_user');
    }

    /**
     * Get user's notifications
     */
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    /**
     * Get user's profile
     */
    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is a moderator
     */
    public function isModerator()
    {
        return $this->hasRole('moderator');
    }
}
