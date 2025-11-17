<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'google_id',
        'facebook_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * QUAN TRỌNG: Quan hệ role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Kiểm tra user có phải admin không dựa trên role name (CHUẨN)
     */
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function twoFactorCode()
    {
        return $this->hasOne(TwoFactorCode::class);
    }

    // New relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
