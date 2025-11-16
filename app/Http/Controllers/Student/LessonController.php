<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KarateClass;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\StudentProgress;

class LessonController extends Controller
{
    /**
     * Display lessons for a specific class
     */
    public function index(KarateClass $class)
    {
        $user = Auth::user();
        
        // Check if user is enrolled and has access
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('class_id', $class->id)
            ->whereIn('status', ['approved', 'active'])
            ->first();
        
        if (!$enrollment) {
            return redirect()->route('student.classes')
                ->with('error', 'Bạn chưa đăng ký khóa học này hoặc chưa được phê duyệt.');
        }
        
        // Check if order is paid
        if ($enrollment->order && !$enrollment->order->isPaid()) {
            return redirect()->route('student.classes')
                ->with('error', 'Vui lòng thanh toán để truy cập nội dung khóa học.');
        }
        
        $lessons = $class->publishedLessons()
            ->with(['contents', 'exercises'])
            ->get();
        
        // Get progress for each lesson
        $progress = StudentProgress::where('user_id', $user->id)
            ->where('class_id', $class->id)
            ->get()
            ->keyBy('lesson_id');
        
        return view('student.lessons', compact('class', 'lessons', 'progress', 'enrollment'));
    }
    
    /**
     * Display a specific lesson
     */
    public function show(Lesson $lesson)
    {
        $user = Auth::user();
        
        // Check if user has access to this lesson
        if (!$lesson->isAccessibleBy($user->id, $lesson->class_id)) {
            return redirect()->route('student.classes')
                ->with('error', 'Bạn không có quyền truy cập bài học này.');
        }
        
        $class = $lesson->karateClass;
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('class_id', $class->id)
            ->whereIn('status', ['approved', 'active'])
            ->first();
        
        // Get lesson contents
        $lesson->load(['contents' => function($query) {
            $query->orderBy('order');
        }, 'exercises']);
        
        // Get or create progress
        $progress = StudentProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'class_id' => $class->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'status' => 'in_progress',
                'progress_percentage' => 0,
                'started_at' => now(),
            ]
        );
        
        // Get previous and next lessons
        $allLessons = $class->publishedLessons()->get();
        $currentIndex = $allLessons->search(function($item) use ($lesson) {
            return $item->id === $lesson->id;
        });
        
        $previousLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1] : null;
        
        return view('student.lesson-detail', compact(
            'lesson',
            'class',
            'enrollment',
            'progress',
            'previousLesson',
            'nextLesson'
        ));
    }
    
    /**
     * Mark lesson as completed
     */
    public function complete(Lesson $lesson)
    {
        $user = Auth::user();
        
        // Check if user has access
        if (!$lesson->isAccessibleBy($user->id, $lesson->class_id)) {
            return redirect()->back()
                ->with('error', 'Bạn không có quyền truy cập bài học này.');
        }
        
        $class = $lesson->karateClass;
        
        // Update or create progress
        $progress = StudentProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'class_id' => $class->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'status' => 'completed',
                'progress_percentage' => 100,
                'completed_at' => now(),
            ]
        );
        
        // Update time spent if not set
        if (!$progress->time_spent_minutes && $progress->started_at) {
            $timeSpent = $progress->started_at->diffInMinutes(now());
            $progress->update(['time_spent_minutes' => $timeSpent]);
        }
        
        return redirect()->back()
            ->with('success', 'Bạn đã hoàn thành bài học này!');
    }
}
