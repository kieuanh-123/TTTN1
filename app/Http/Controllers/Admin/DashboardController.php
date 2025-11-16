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
        // Trong thực tế, bạn sẽ lấy dữ liệu từ database
        // Hiện tại chúng ta sẽ return view không có dữ liệu

        return view('admin.dashboard');
    }
}