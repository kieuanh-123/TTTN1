<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'name',
        'email',
        'content',
        'rating',
        'status',
        'avatar',
        'admin_note',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function karateClass()
    {
        return $this->belongsTo(KarateClass::class, 'class_id');
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'pending' => 'Đang chờ duyệt',
            'approved' => 'Đã duyệt',
            'rejected' => 'Đã từ chối',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }
}
