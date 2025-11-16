<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;

    protected $table = 'student_progress';

    protected $fillable = [
        'user_id',
        'class_id',
        'lesson_id',
        'status',
        'progress_percentage',
        'time_spent_minutes',
        'started_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'progress_percentage' => 'integer',
        'time_spent_minutes' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'not_started' => 'Chưa bắt đầu',
            'in_progress' => 'Đang học',
            'completed' => 'Hoàn thành',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'progress_percentage' => 100,
            'completed_at' => now(),
        ]);
    }
}
