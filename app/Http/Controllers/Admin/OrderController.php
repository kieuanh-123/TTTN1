<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Enrollment;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'karateClass', 'payments']);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'karateClass', 'payments', 'enrollment']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Approve an order
     */
    public function approve(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Chỉ có thể phê duyệt đơn hàng đang chờ.');
        }
        
        $order->update([
            'status' => 'approved',
            'admin_note' => $request->admin_note ?? null,
        ]);
        
        // Create enrollment if not exists
        if (!$order->enrollment) {
            Enrollment::create([
                'user_id' => $order->user_id,
                'class_id' => $order->class_id,
                'order_id' => $order->id,
                'status' => 'approved',
                'start_date' => now(),
            ]);
        }
        
        return redirect()->back()
            ->with('success', 'Đơn hàng đã được phê duyệt và enrollment đã được tạo.');
    }

    /**
     * Reject an order
     */
    public function reject(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Chỉ có thể từ chối đơn hàng đang chờ.');
        }
        
        $request->validate([
            'admin_note' => 'required|string|min:10',
        ]);
        
        $order->update([
            'status' => 'cancelled',
            'admin_note' => $request->admin_note,
        ]);
        
        return redirect()->back()
            ->with('success', 'Đơn hàng đã bị từ chối.');
    }
}
