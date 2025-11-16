<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Order;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments
     */
    public function index(Request $request)
    {
        $query = Enrollment::with(['user', 'karateClass', 'order']);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $enrollments = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Display the specified enrollment
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['user', 'karateClass.instructor', 'order.payments']);
        
        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Approve an enrollment
     */
    public function approve(Request $request, Enrollment $enrollment)
    {
        if ($enrollment->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Chỉ có thể phê duyệt enrollment đang chờ.');
        }
        
        $enrollment->update([
            'status' => 'approved',
            'start_date' => now(),
            'notes' => $request->notes ?? $enrollment->notes,
        ]);
        
        // Create order if not exists
        if (!$enrollment->order) {
            $class = $enrollment->karateClass;
            Order::create([
                'order_code' => 'ORD-' . strtoupper(\Illuminate\Support\Str::random(8)),
                'user_id' => $enrollment->user_id,
                'class_id' => $enrollment->class_id,
                'total_amount' => $class->price,
                'status' => 'pending',
                'payment_due_date' => now()->addDays(7),
            ]);
        }
        
        return redirect()->back()
            ->with('success', 'Enrollment đã được phê duyệt.');
    }

    /**
     * Cancel an enrollment
     */
    public function cancel(Request $request, Enrollment $enrollment)
    {
        if (in_array($enrollment->status, ['cancelled', 'completed'])) {
            return redirect()->back()
                ->with('error', 'Không thể hủy enrollment này.');
        }
        
        $request->validate([
            'notes' => 'required|string|min:10',
        ]);
        
        $enrollment->update([
            'status' => 'cancelled',
            'notes' => $request->notes,
        ]);
        
        // Cancel related order if exists
        if ($enrollment->order && $enrollment->order->status === 'pending') {
            $enrollment->order->update(['status' => 'cancelled']);
        }
        
        return redirect()->back()
            ->with('success', 'Enrollment đã bị hủy.');
    }
}
