<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\ClassSession;
use App\Models\Enrollment;

class AttendanceController extends Controller
{
    /**
     * Display a listing of attendances
     */
    public function index(Request $request)
    {
        $query = Attendance::with(['user', 'session.karateClass', 'karateClass']);
        
        // Filter by session
        if ($request->has('session_id') && $request->session_id) {
            $query->where('session_id', $request->session_id);
        }
        
        // Filter by class
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->orderBy('checked_in_at', 'desc')->paginate(20);
        $sessions = ClassSession::with('karateClass')->orderBy('session_date', 'desc')->get();
        
        return view('admin.attendances.index', compact('attendances', 'sessions'));
    }

    /**
     * Display attendance for a specific session
     */
    public function show(ClassSession $session)
    {
        $session->load(['karateClass.enrollments.user', 'attendances.user']);
        
        // Get all enrolled students
        $enrolledStudents = $session->karateClass->enrollments()
            ->whereIn('status', ['approved', 'active'])
            ->with('user')
            ->get()
            ->pluck('user');
        
        // Get existing attendances
        $attendances = $session->attendances->keyBy('user_id');
        
        return view('admin.attendances.show', compact('session', 'enrolledStudents', 'attendances'));
    }

    /**
     * Bulk check attendance for a session
     */
    public function bulkCheck(Request $request, ClassSession $session)
    {
        $request->validate([
            'attendances' => 'required|array',
            'attendances.*.user_id' => 'required|exists:users,id',
            'attendances.*.status' => 'required|in:present,absent,late,excused',
        ]);
        
        foreach ($request->attendances as $attendanceData) {
            Attendance::updateOrCreate(
                [
                    'session_id' => $session->id,
                    'user_id' => $attendanceData['user_id'],
                    'class_id' => $session->class_id,
                ],
                [
                    'status' => $attendanceData['status'],
                    'checked_in_at' => now(),
                    'checked_by' => Auth::id(),
                    'notes' => $attendanceData['notes'] ?? null,
                ]
            );
        }
        
        return redirect()->route('admin.attendances.show', $session)
            ->with('success', 'Điểm danh đã được lưu thành công.');
    }
}
