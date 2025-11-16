<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Đã Được Phê Duyệt</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: #fff; margin: 0;">🎉 Đơn Hàng Đã Được Phê Duyệt</h1>
    </div>
    
    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px;">
        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>
        
        <p>Chúng tôi rất vui thông báo rằng đơn hàng của bạn đã được phê duyệt thành công!</p>
        
        <div style="background: #fff; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #667eea;">
            <h3 style="margin-top: 0; color: #667eea;">Thông Tin Đơn Hàng</h3>
            <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
            <p><strong>Lớp học:</strong> {{ $order->karateClass->name ?? 'N/A' }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }} đ</p>
            <p><strong>Ngày phê duyệt:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        </div>
        
        <p>Vui lòng thanh toán đơn hàng để có thể bắt đầu học tập. Bạn có thể thanh toán bằng các phương thức sau:</p>
        
        <ul>
            <li>Chuyển khoản ngân hàng</li>
            <li>Thẻ tín dụng/Ghi nợ (qua cổng thanh toán)</li>
            <li>Tiền mặt (tại văn phòng)</li>
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('payments.show', ['order' => $order->id]) }}" style="background: #667eea; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Thanh Toán Ngay
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

