<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Đã Được Xác Nhận</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: #fff; margin: 0;">✅ Thanh Toán Đã Được Xác Nhận</h1>
    </div>
    
    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px;">
        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>
        
        <p>Chúng tôi xác nhận rằng thanh toán của bạn đã được xử lý thành công!</p>
        
        <div style="background: #fff; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #11998e;">
            <h3 style="margin-top: 0; color: #11998e;">Thông Tin Thanh Toán</h3>
            <p><strong>Mã thanh toán:</strong> {{ $payment->payment_code }}</p>
            <p><strong>Mã đơn hàng:</strong> {{ $payment->order->order_code }}</p>
            <p><strong>Lớp học:</strong> {{ $payment->order->karateClass->name ?? 'N/A' }}</p>
            <p><strong>Số tiền:</strong> {{ number_format($payment->amount) }} đ</p>
            <p><strong>Phương thức:</strong> {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
            <p><strong>Ngày xác nhận:</strong> {{ $payment->paid_at ? $payment->paid_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}</p>
        </div>
        
        <p><strong>🎓 Chúc mừng!</strong> Bạn giờ đã có thể truy cập vào khóa học và bắt đầu học tập.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('student.dashboard') }}" style="background: #11998e; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Bắt Đầu Học Ngay
            </a>
        </div>
        
        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hoặc điện thoại.</p>
        
        <p>Trân trọng,<br>
        <strong>Đội Ngũ Karate TMA</strong></p>
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #999; text-align: center;">
            Email này được gửi tự động, vui lòng không trả lời email này.<br>
            Nếu bạn không phải là người nhận email này, vui lòng bỏ qua.
        </p>
    </div>
</body>
</html>

