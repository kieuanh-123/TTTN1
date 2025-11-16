<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\StudentProgress;
use App\Models\ClassSession;
use App\Models\Attendance;

class DashboardController extends Controller
{
    /**
     * Display student dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get active enrollments
        $enrollments = Enrollment::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'active'])
            ->with(['karateClass', 'order'])
            ->get();
        
        // Get pending orders
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('karateClass')
            ->get();
        
        // Get upcoming sessions
        $upcomingSessions = ClassSession::whereHas('karateClass.enrollments', function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->whereIn('status', ['approved', 'active']);
            })
            ->where('session_date', '>=', now())
            ->where('status', 'scheduled')
            ->with(['karateClass', 'instructor'])
            ->orderBy('session_date')
            ->limit(5)
            ->get();
        
        // Statistics
        $totalClasses = $enrollments->count();
        $completedClasses = Enrollment::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $totalLessonsCompleted = StudentProgress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        
        return view('student.dashboard', compact(
            'enrollments',
            'pendingOrders',
            'upcomingSessions',
            'totalClasses',
            'completedClasses',
            'totalLessonsCompleted'
        ));
    }
    
    /**
     * Display student's classes
     */
    public function classes()
    {
        $user = Auth::user();
        
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['karateClass.instructor', 'order'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('student.classes', compact('enrollments'));
    }
    
    /**
     * Display student progress
     */
    public function progress()
    {
        $user = Auth::user();
        
        $enrollments = Enrollment::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'active', 'completed'])
            ->with(['karateClass', 'order'])
            ->get();
        
        $progressData = [];
        
        foreach ($enrollments as $enrollment) {
            $class = $enrollment->karateClass;
            $totalLessons = $class->publishedLessons()->count();
            $completedLessons = StudentProgress::where('user_id', $user->id)
                ->where('class_id', $class->id)
                ->where('status', 'completed')
                ->count();
            
            $progressPercentage = $totalLessons > 0 
                ? round(($completedLessons / $totalLessons) * 100) 
                : 0;
            
            $totalTimeSpent = StudentProgress::where('user_id', $user->id)
                ->where('class_id', $class->id)
                ->sum('time_spent_minutes');
            
            $attendanceCount = Attendance::where('user_id', $user->id)
                ->where('class_id', $class->id)
                ->where('status', 'present')
                ->count();
            
            $progressData[] = [
                'enrollment' => $enrollment,
                'class' => $class,
                'totalLessons' => $totalLessons,
                'completedLessons' => $completedLessons,
                'progressPercentage' => $progressPercentage,
                'totalTimeSpent' => $totalTimeSpent,
                'attendanceCount' => $attendanceCount,
            ];
        }
        
        return view('student.progress', compact('progressData'));
    }
}
