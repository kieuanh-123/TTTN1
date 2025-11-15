<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function index()
    {
        // $instructors = Instructor::all();
        // return view('instructors', compact('instructors'));
        
        return view('instructors');
    }
}