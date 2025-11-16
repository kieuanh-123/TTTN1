<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\KarateClass;
use App\Models\LessonContent;
use App\Models\Exercise;

class LessonController extends Controller
{
    /**
     * Display a listing of lessons
     */
    public function index(Request $request)
    {
        $query = Lesson::with(['karateClass']);
        
        // Filter by class
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        
        // Filter by published status
        if ($request->has('is_published')) {
            $query->where('is_published', $request->is_published);
        }
        
        $lessons = $query->orderBy('lesson_order')->paginate(20);
        $classes = KarateClass::all();
        
        return view('admin.lessons.index', compact('lessons', 'classes'));
    }

    /**
     * Show the form for creating a new lesson
     */
    public function create()
    {
        $classes = KarateClass::all();
        return view('admin.lessons.create', compact('classes'));
    }

    /**
     * Store a newly created lesson
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lesson_order' => 'required|integer|min:1',
            'duration_minutes' => 'nullable|integer|min:1',
            'objectives' => 'nullable|string',
            'is_published' => 'boolean',
        ]);
        
        $lesson = Lesson::create($request->all());
        
        return redirect()->route('admin.lessons.show', $lesson)
            ->with('success', 'Bài học đã được tạo thành công.');
    }

    /**
     * Display the specified lesson
     */
    public function show(Lesson $lesson)
    {
        $lesson->load(['karateClass', 'contents', 'exercises']);
        return view('admin.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson
     */
    public function edit(Lesson $lesson)
    {
        $classes = KarateClass::all();
        $lesson->load(['contents', 'exercises']);
        return view('admin.lessons.edit', compact('lesson', 'classes'));
    }

    /**
     * Update the specified lesson
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lesson_order' => 'required|integer|min:1',
            'duration_minutes' => 'nullable|integer|min:1',
            'objectives' => 'nullable|string',
            'is_published' => 'boolean',
        ]);
        
        $lesson->update($request->all());
        
        return redirect()->route('admin.lessons.show', $lesson)
            ->with('success', 'Bài học đã được cập nhật.');
    }

    /**
     * Remove the specified lesson
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        
        return redirect()->route('admin.lessons.index')
            ->with('success', 'Bài học đã được xóa.');
    }

    /**
     * Publish/Unpublish a lesson
     */
    public function publish(Request $request, Lesson $lesson)
    {
        $lesson->update([
            'is_published' => !$lesson->is_published,
        ]);
        
        $status = $lesson->is_published ? 'xuất bản' : 'ẩn';
        
        return redirect()->back()
            ->with('success', "Bài học đã được {$status}.");
    }
}
