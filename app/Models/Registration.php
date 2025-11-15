<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_code',
        'email',
        'fullname',
        'phone',
        'dob',
        'gender',
        'address',
        'registration_type',
        'class_type',
        'preferred_time',
        'note',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the formatted gender.
     *
     * @return string
     */
    public function getFormattedGenderAttribute()
    {
        $genders = [
            'male' => 'Nam',
            'female' => 'Nữ',
            'other' => 'Khác',
        ];

        return $genders[$this->gender] ?? $this->gender;
    }

    /**
     * Get the formatted registration type.
     *
     * @return string
     */
    public function getFormattedRegistrationTypeAttribute()
    {
        $types = [
            'consultation' => 'Đăng ký tư vấn',
            'class' => 'Đăng ký lớp học',
            'both' => 'Đăng ký tư vấn và lớp học',
        ];

        return $types[$this->registration_type] ?? $this->registration_type;
    }

    /**
     * Get the formatted class type.
     *
     * @return string
     */
    public function getFormattedClassTypeAttribute()
    {
        $types = [
            'kids' => 'Karate Thiếu nhi (4-12 tuổi)',
            'teens' => 'Karate Thiếu niên (13-17 tuổi)',
            'adults' => 'Karate Người lớn (18+ tuổi)',
            'advanced' => 'Lớp nâng cao',
            'private' => 'Học riêng',
        ];

        return $types[$this->class_type] ?? $this->class_type;
    }

    /**
     * Get the formatted preferred time.
     *
     * @return string
     */
    public function getFormattedPreferredTimeAttribute()
    {
        $times = [
            'morning' => 'Buổi sáng (8:00 - 11:00)',
            'afternoon' => 'Buổi chiều (14:00 - 17:00)',
            'evening' => 'Buổi tối (18:00 - 21:00)',
            'weekend' => 'Cuối tuần',
        ];

        return $times[$this->preferred_time] ?? $this->preferred_time;
    }

    /**
     * Get the formatted status.
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'pending' => 'Đang chờ xử lý',
            'contacted' => 'Đã liên hệ',
            'registered' => 'Đã đăng ký',
            'cancelled' => 'Đã hủy',
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}
