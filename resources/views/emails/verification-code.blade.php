<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mã xác thực đăng ký - Karate TMA</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #D10A10;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 5px 5px;
            border: 1px solid #eee;
            border-top: none;
        }
        .verification-code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            margin: 20px 0;
            color: #D10A10;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .note {
            background-color: #fff9e6;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Karate TMA</h1>
        </div>
        <div class="content">
            <h2>Xác thực địa chỉ email</h2>
            
            <p>Xin chào,</p>
            
            <p>Cảm ơn bạn đã đăng ký tại Karate TMA. Để hoàn tất quá trình đăng ký, vui lòng sử dụng mã xác thực dưới đây:</p>
            
            <div class="verification-code">{{ $code }}</div>
            
            <div class="note">
                <strong>Lưu ý:</strong> Mã xác thực này sẽ hết hạn sau 10 phút. Vui lòng không chia sẻ mã này với người khác.
            </div>
            
            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
            
            <p>Trân trọng,<br>Đội ngũ Karate TMA</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Karate TMA. Đã đăng ký Bản quyền.</p>
            <p>Địa chỉ: TTTM Sóng Thần, Số 1 Đại lộ Độc Lập, Tp.Dĩ An, Bình Dương</p>
        </div>
    </div>
</body>
</html>
