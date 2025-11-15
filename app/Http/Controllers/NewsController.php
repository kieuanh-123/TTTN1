<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        // $news = News::with('author')->latest()->paginate(9);
        // return view('news', compact('news'));
        
        return view('news');
    }

    public function show($id)
    {
        // $news = News::with('author')->findOrFail($id);
        // return view('news-detail', compact('news'));
        
        return view('news-detail');
    }
}