<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'order_id',
        'status',
        'start_date',
        'end_date',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function progress()
    {
        return $this->hasMany(StudentProgress::class, 'user_id', 'user_id')
            ->where('class_id', $this->class_id);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id')
            ->where('class_id', $this->class_id);
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'pending' => 'Đang chờ',
            'approved' => 'Đã phê duyệt',
            'active' => 'Đang học',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function progressPercentage()
    {
        $totalLessons = $this->karateClass->lessons()->where('is_published', true)->count();
        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = $this->progress()
            ->where('status', 'completed')
            ->count();

        return round(($completedLessons / $totalLessons) * 100);
    }
}
