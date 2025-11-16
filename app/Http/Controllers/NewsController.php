<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news');
    }

    public function show($id)
    {
        return view('news-detail');
    }
}