<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_code',
        'order_id',
        'user_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'bank_name',
        'account_number',
        'payment_proof',
        'notes',
        'paid_at',
        'confirmed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // Helper methods
    public function getFormattedPaymentMethodAttribute()
    {
        $methods = [
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'card' => 'Thẻ tín dụng/Ghi nợ',
            'cash' => 'Tiền mặt',
        ];

        return $methods[$this->payment_method] ?? $this->payment_method;
    }

    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'pending' => 'Đang chờ',
            'processing' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            'failed' => 'Thất bại',
            'refunded' => 'Đã hoàn tiền',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
