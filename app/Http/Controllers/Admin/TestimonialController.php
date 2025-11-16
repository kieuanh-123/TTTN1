<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials
     */
    public function index(Request $request)
    {
        $query = Testimonial::with(['user', 'karateClass']);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by class
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhereHas('karateClass', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $testimonials = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Display the specified testimonial
     */
    public function show(Testimonial $testimonial)
    {
        $testimonial->load(['user', 'karateClass']);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Approve a testimonial
     */
    public function approve(Request $request, Testimonial $testimonial)
    {
        if ($testimonial->status === 'approved') {
            return redirect()->back()
                ->with('error', 'Đánh giá này đã được phê duyệt rồi.');
        }
        
        $testimonial->update([
            'status' => 'approved',
            'admin_note' => $request->admin_note ?? null,
        ]);
        
        return redirect()->back()
            ->with('success', 'Đánh giá đã được phê duyệt và sẽ hiển thị trên website.');
    }

    /**
     * Reject a testimonial
     */
    public function reject(Request $request, Testimonial $testimonial)
    {
        if ($testimonial->status === 'rejected') {
            return redirect()->back()
                ->with('error', 'Đánh giá này đã bị từ chối rồi.');
        }
        
        $request->validate([
            'admin_note' => 'required|string|min:10',
        ]);
        
        $testimonial->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
        ]);
        
        return redirect()->back()
            ->with('success', 'Đánh giá đã bị từ chối.');
    }

    /**
     * Remove the specified testimonial
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Đánh giá đã được xóa.');
    }
}
