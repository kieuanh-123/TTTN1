<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'registration_id',
        'class_id',
        'total_amount',
        'status',
        'admin_note',
        'payment_due_date',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_due_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function karateClass()
    {
        return $this->belongsTo(KarateClass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function enrollment()
    {
        return $this->hasOne(Enrollment::class);
    }

    // Helper methods
    public function getFormattedStatusAttribute()
    {
        $statuses = [
            'pending' => 'Đang chờ',
            'approved' => 'Đã phê duyệt',
            'paid' => 'Đã thanh toán',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function isPaid()
    {
        return $this->status === 'paid' || $this->status === 'completed';
    }

    public function totalPaid()
    {
        return $this->payments()->where('status', 'completed')->sum('amount');
    }
}
