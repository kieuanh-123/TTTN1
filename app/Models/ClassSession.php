<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    use HasFactory;

    protected $table = 'class_sessions';

    protected $fillable = [
        'class_id',
        'title',
        'description',
        'session_date',
        'start_time',
        'end_time',
        'location',
        'instructor_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'session_date' => 'datetime',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // Relationships
    public function karateClass()
    {
        return $this->belongsTo(KarateClass::class, 'class_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'scheduled' => 'Đã lên lịch',
            'completed' => 'Đã hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function attendanceCount()
    {
        return $this->attendances()->where('status', 'present')->count();
    }

    public function absentCount()
    {
        return $this->attendances()->where('status', 'absent')->count();
    }
}
