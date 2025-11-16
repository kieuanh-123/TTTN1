<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Đã Được Phê Duyệt</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: #fff; margin: 0;">🎉 Đăng Ký Đã Được Phê Duyệt</h1>
    </div>
    
    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px;">
        <p>Xin chào <strong>{{ $enrollment->user->name }}</strong>,</p>
        
        <p>Chúng tôi rất vui thông báo rằng đăng ký của bạn cho lớp học đã được phê duyệt thành công!</p>
        
        <div style="background: #fff; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #f5576c;">
            <h3 style="margin-top: 0; color: #f5576c;">Thông Tin Đăng Ký</h3>
            <p><strong>Lớp học:</strong> {{ $enrollment->karateClass->name ?? 'N/A' }}</p>
            <p><strong>Ngày bắt đầu:</strong> {{ $enrollment->start_date ? $enrollment->start_date->format('d/m/Y') : 'N/A' }}</p>
            <p><strong>Trạng thái:</strong> Đã phê duyệt</p>
        </div>
        
        @if($enrollment->order)
        <p>Đơn hàng đã được tạo. Vui lòng thanh toán để có thể bắt đầu học tập.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('payments.show', ['order' => $enrollment->order->id]) }}" style="background: #f5576c; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Thanh Toán Ngay
            </a>
        </div>
        @else
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('student.dashboard') }}" style="background: #f5576c; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Xem Dashboard
            </a>
        </div>
        @endif
        
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

