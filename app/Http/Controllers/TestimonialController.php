<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Enrollment;

class TestimonialController extends Controller
{
    /**
     * Store a new testimonial
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('class_id', $request->class_id)
            ->whereIn('status', ['active', 'completed'])
            ->first();
        
        if (!$enrollment) {
            return redirect()->back()
                ->with('error', 'Bạn chỉ có thể đánh giá các khóa học đã tham gia.');
        }
        
        $existingTestimonial = Testimonial::where('user_id', $user->id)
            ->where('class_id', $request->class_id)
            ->first();
        
        if ($existingTestimonial) {
            return redirect()->back()
                ->with('error', 'Bạn đã gửi đánh giá cho khóa học này rồi.');
        }
        
        $testimonial = Testimonial::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);
        
        return redirect()->back()
            ->with('success', 'Cảm ơn bạn đã đánh giá! Đánh giá của bạn đang chờ admin duyệt.');
    }
}
