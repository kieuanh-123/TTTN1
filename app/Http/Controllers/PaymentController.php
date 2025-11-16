<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display payment page for an order
     */
    public function show(Order $order)
    {
        $user = Auth::user();
        
        // Check if order belongs to user
        if ($order->user_id !== $user->id) {
            return redirect()->route('student.classes')
                ->with('error', 'Bạn không có quyền truy cập đơn hàng này.');
        }
        
        // Check if order is already paid
        if ($order->isPaid()) {
            return redirect()->route('student.classes')
                ->with('info', 'Đơn hàng này đã được thanh toán.');
        }
        
        $order->load('karateClass', 'payments');
        
        return view('payments.show', compact('order'));
    }
    
    /**
     * Process payment
     */
    public function pay(Request $request, Order $order)
    {
        $user = Auth::user();
        
        // Check if order belongs to user
        if ($order->user_id !== $user->id) {
            return redirect()->back()
                ->with('error', 'Bạn không có quyền truy cập đơn hàng này.');
        }
        
        // Check if order is already paid
        if ($order->isPaid()) {
            return redirect()->back()
                ->with('info', 'Đơn hàng này đã được thanh toán.');
        }
        
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,card,cash',
            'amount' => 'required|numeric|min:0|max:' . $order->total_amount,
        ]);
        
        // Create payment record
        $payment = Payment::create([
            'payment_code' => 'PAY-' . strtoupper(Str::random(8)),
            'order_id' => $order->id,
            'user_id' => $user->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->payment_method === 'cash' ? 'pending' : 'processing',
            'bank_name' => $request->bank_name ?? null,
            'account_number' => $request->account_number ?? null,
            'notes' => $request->notes ?? null,
        ]);
        
        // If cash payment, mark as pending for admin confirmation
        if ($request->payment_method === 'cash') {
            return redirect()->back()
                ->with('success', 'Thanh toán tiền mặt đã được ghi nhận. Vui lòng chờ admin xác nhận.');
        }
        
        // For bank transfer, redirect to upload proof
        if ($request->payment_method === 'bank_transfer') {
            return redirect()->route('payments.upload-proof', ['payment' => $payment])
                ->with('success', 'Vui lòng upload ảnh chứng từ chuyển khoản.');
        }
        
        // For card payment (future implementation with payment gateway)
        return redirect()->back()
            ->with('info', 'Tính năng thanh toán bằng thẻ đang được phát triển.');
    }
    
    /**
     * Show upload proof form
     */
    public function showUploadForm(Payment $payment)
    {
        $user = Auth::user();
        
        // Check if payment belongs to user
        if ($payment->user_id !== $user->id) {
            return redirect()->route('student.classes')
                ->with('error', 'Bạn không có quyền truy cập thanh toán này.');
        }
        
        return view('payments.upload-proof', compact('payment'));
    }
    
    /**
     * Upload payment proof
     */
    public function uploadProof(Request $request, Payment $payment)
    {
        $user = Auth::user();
        
        // Check if payment belongs to user
        if ($payment->user_id !== $user->id) {
            return redirect()->back()
                ->with('error', 'Bạn không có quyền truy cập thanh toán này.');
        }
        
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Upload image
        if ($request->hasFile('payment_proof')) {
            $imagePath = $request->file('payment_proof')->store('payment-proofs', 'public');
            $payment->update([
                'payment_proof' => $imagePath,
                'status' => 'pending', // Waiting for admin confirmation
            ]);
            
            return redirect()->route('payments.show', ['order' => $payment->order_id])
                ->with('success', 'Ảnh chứng từ đã được upload. Vui lòng chờ admin xác nhận.');
        }
        
        return redirect()->back()
            ->with('error', 'Có lỗi xảy ra khi upload ảnh.');
    }
}
