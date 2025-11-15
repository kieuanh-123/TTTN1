<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Models\KarateClass;
use App\Models\Instructor;

class DashboardController extends Controller
{
    public function index()
    {
        // Các thống kê cơ bản cho dashboard
        // $totalUsers = User::count();
        // $totalNews = News::count();
        // $totalClasses = KarateClass::count();
        // $totalInstructors = Instructor::count();
        
        // return view('admin.dashboard', compact('totalUsers', 'totalNews', 'totalClasses', 'totalInstructors'));
        
        return view('admin.dashboard');
    }
}