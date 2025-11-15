<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông báo đăng ký mới - Karate TMA</title>
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
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table th {
            text-align: left;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            width: 40%;
        }
        .info-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .badge-primary {
            background-color: #007bff;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Karate TMA</h1>
        </div>
        <div class="content">
            <h2>Thông báo đăng ký mới</h2>
            
            <p>Xin chào Quản trị viên,</p>
            
            <p>Có một đăng ký mới từ website. Dưới đây là thông tin chi tiết:</p>
            
            <table class="info-table">
                <tr>
                    <th>Mã đăng ký</th>
                    <td>{{ $registration->registration_code }}</td>
                </tr>
                <tr>
                    <th>Thời gian đăng ký</th>
                    <td>{{ $registration->created_at->format('H:i:s d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Loại đăng ký</th>
                    <td>
                        @if($registration->registration_type == 'consultation')
                            <span class="badge badge-primary">Tư vấn</span>
                        @elseif($registration->registration_type == 'class')
                            <span class="badge badge-success">Lớp học</span>
                        @else
                            <span class="badge badge-warning">Tư vấn & Lớp học</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Họ và tên</th>
                    <td>{{ $registration->fullname }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $registration->email }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{ $registration->phone }}</td>
                </tr>
                @if($registration->dob)
                <tr>
                    <th>Ngày sinh</th>
                    <td>{{ $registration->dob->format('d/m/Y') }}</td>
                </tr>
                @endif
                @if($registration->gender)
                <tr>
                    <th>Giới tính</th>
                    <td>{{ $registration->formatted_gender }}</td>
                </tr>
                @endif
                @if($registration->address)
                <tr>
                    <th>Địa chỉ</th>
                    <td>{{ $registration->address }}</td>
                </tr>
                @endif
                @if($registration->class_type)
                <tr>
                    <th>Loại lớp học</th>
                    <td>{{ $registration->formatted_class_type }}</td>
                </tr>
                @endif
                @if($registration->preferred_time)
                <tr>
                    <th>Thời gian học</th>
                    <td>{{ $registration->formatted_preferred_time }}</td>
                </tr>
                @endif
                @if($registration->note)
                <tr>
                    <th>Ghi chú</th>
                    <td>{{ $registration->note }}</td>
                </tr>
                @endif
            </table>
            
            <p>Vui lòng liên hệ với học viên tiềm năng này càng sớm càng tốt.</p>
            
            <p>Trân trọng,<br>Hệ thống Karate TMA</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Karate TMA. Đã đăng ký Bản quyền.</p>
            <p>Địa chỉ: TTTM Sóng Thần, Số 1 Đại lộ Độc Lập, Tp.Dĩ An, Bình Dương</p>
        </div>
    </div>
</body>
</html>
