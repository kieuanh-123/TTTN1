<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KarateClass;
use App\Models\Instructor;

class ClassController extends Controller
{
    public function index()
    {
        // $classes = KarateClass::with('instructor')->get();
        // return view('classes', compact('classes'));
        
        return view('classes');
    }
}