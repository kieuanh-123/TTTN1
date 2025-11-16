<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Enrollment;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        $query = Payment::with(['user', 'order.karateClass']);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('payment_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        $payments = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'order.karateClass', 'confirmedBy']);
        
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Confirm a payment
     */
    public function confirm(Request $request, Payment $payment)
    {
        if ($payment->status === 'completed') {
            return redirect()->back()
                ->with('error', 'Thanh toán này đã được xác nhận rồi.');
        }
        
        $payment->update([
            'status' => 'completed',
            'confirmed_by' => Auth::id(),
            'paid_at' => now(),
        ]);
        
        // Update order status
        $order = $payment->order;
        $totalPaid = $order->totalPaid();
        
        if ($totalPaid >= $order->total_amount) {
            $order->update(['status' => 'paid']);
            
            // Activate enrollment
            $enrollment = Enrollment::where('order_id', $order->id)->first();
            if ($enrollment) {
                $enrollment->update(['status' => 'active']);
            }
        }
        
        return redirect()->back()
            ->with('success', 'Thanh toán đã được xác nhận. Enrollment đã được kích hoạt.');
    }
}
