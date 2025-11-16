<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'class_id',
        'status',
        'notes',
        'checked_in_at',
        'checked_by',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    // Relationships
    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function karateClass()
    {
        return $this->belongsTo(KarateClass::class, 'class_id');
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'present' => 'Có mặt',
            'absent' => 'Vắng mặt',
            'late' => 'Đi muộn',
            'excused' => 'Có phép',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isPresent()
    {
        return $this->status === 'present' || $this->status === 'late';
    }
}
