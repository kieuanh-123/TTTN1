<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\KarateClass;
use App\Models\Instructor;

class ClassSessionController extends Controller
{
    /**
     * Display a listing of class sessions
     */
    public function index(Request $request)
    {
        $query = ClassSession::with(['karateClass', 'instructor']);
        
        // Filter by class
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->has('date_from')) {
            $query->where('session_date', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->where('session_date', '<=', $request->date_to);
        }
        
        $sessions = $query->orderBy('session_date', 'desc')->paginate(20);
        $classes = KarateClass::all();
        
        return view('admin.sessions.index', compact('sessions', 'classes'));
    }

    /**
     * Show the form for creating a new session
     */
    public function create()
    {
        $classes = KarateClass::all();
        $instructors = Instructor::all();
        return view('admin.sessions.create', compact('classes', 'instructors'));
    }

    /**
     * Store a newly created session
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'instructor_id' => 'nullable|exists:instructors,id',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        $session = ClassSession::create($request->all());
        
        return redirect()->route('admin.sessions.show', $session)
            ->with('success', 'Buổi học đã được tạo thành công.');
    }

    /**
     * Display the specified session
     */
    public function show(ClassSession $session)
    {
        $session->load(['karateClass', 'instructor', 'attendances.user']);
        return view('admin.sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified session
     */
    public function edit(ClassSession $session)
    {
        $classes = KarateClass::all();
        $instructors = Instructor::all();
        return view('admin.sessions.edit', compact('session', 'classes', 'instructors'));
    }

    /**
     * Update the specified session
     */
    public function update(Request $request, ClassSession $session)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'instructor_id' => 'nullable|exists:instructors,id',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        $session->update($request->all());
        
        return redirect()->route('admin.sessions.show', $session)
            ->with('success', 'Buổi học đã được cập nhật.');
    }

    /**
     * Remove the specified session
     */
    public function destroy(ClassSession $session)
    {
        $session->delete();
        
        return redirect()->route('admin.sessions.index')
            ->with('success', 'Buổi học đã được xóa.');
    }
}
