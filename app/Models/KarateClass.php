<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \App\Models\Instructor|null $instructor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass query()
 * @mixin \Eloquent
 */
class KarateClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
        'image',
        'schedule',
        'instructor_id',
        'level',
        'price',
        'featured',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    // New relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'class_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'class_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'class_id')->orderBy('lesson_order');
    }

    public function publishedLessons()
    {
        return $this->hasMany(Lesson::class, 'class_id')
            ->where('is_published', true)
            ->orderBy('lesson_order');
    }

    public function sessions()
    {
        return $this->hasMany(ClassSession::class, 'class_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'class_id');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class, 'class_id')
            ->where('status', 'approved');
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class, 'class_id');
    }
}