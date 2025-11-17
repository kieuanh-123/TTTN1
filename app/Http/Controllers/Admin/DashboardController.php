<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\KarateClass;
use App\Models\News;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalStudents' => User::whereHas('role', function ($q) {
                $q->where('name', 'user');
            })->count(),
            'totalNews' => News::count(),
            'totalClasses' => KarateClass::count(),
            'totalInstructors' => Instructor::count(),
            'activeEnrollments' => Enrollment::whereIn('status', ['approved', 'active'])->count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'pendingPayments' => Payment::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['user', 'karateClass'])
            ->latest()
            ->take(5)
            ->get();

        $recentNews = News::latest()->take(3)->get();

        $classesWithSessions = KarateClass::withCount('sessions')
            ->orderByDesc('sessions_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'recentNews' => $recentNews,
            'classesWithSessions' => $classesWithSessions,
        ]);
    }
}