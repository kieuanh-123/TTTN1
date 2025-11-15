<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\KarateClass;
use App\Models\Instructor;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Trong thực tế, bạn sẽ lấy dữ liệu từ database
        // Hiện tại chúng ta sẽ return view không có dữ liệu
        return view('home');
    }
}