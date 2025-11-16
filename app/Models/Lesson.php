<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'title',
        'description',
        'lesson_order',
        'duration_minutes',
        'objectives',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relationships
    public function karateClass()
    {
        return $this->belongsTo(KarateClass::class, 'class_id');
    }

    public function contents()
    {
        return $this->hasMany(LessonContent::class)->orderBy('order');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }

    // Helper methods
    public function videos()
    {
        return $this->contents()->where('content_type', 'video');
    }

    public function pdfs()
    {
        return $this->contents()->where('content_type', 'pdf');
    }

    public function isAccessibleBy($userId, $classId)
    {
        // Kiểm tra xem user có enrollment active và đã thanh toán không
        $enrollment = Enrollment::where('user_id', $userId)
            ->where('class_id', $classId)
            ->where('status', 'active')
            ->first();

        if (!$enrollment) {
            return false;
        }

        // Kiểm tra order đã thanh toán chưa
        if ($enrollment->order) {
            return $enrollment->order->isPaid();
        }

        return false;
    }
}
