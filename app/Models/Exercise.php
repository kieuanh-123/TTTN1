<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'question',
        'answer',
        'exercise_type',
        'points',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Helper methods
    public function getFormattedExerciseTypeAttribute()
    {
        $types = [
            'assignment' => 'Bài tập',
            'quiz' => 'Câu hỏi trắc nghiệm',
            'practice' => 'Thực hành',
        ];

        return $types[$this->exercise_type] ?? $this->exercise_type;
    }
}
