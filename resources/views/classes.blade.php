@extends('layouts.main')

@section('title', 'Lớp Võ')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Các Lớp Võ</h1>
        <p class="lead mb-5">Khám phá các lớp võ đa dạng tại Karate Dojo, phù hợp với mọi lứa tuổi và trình độ.</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card class-card">
                    <img src="{{ asset('images/class-1.jpg') }}" class="card-img-top class-image" alt="Karate cho Người Mới">
                    <div class="card-body">
                        <h5 class="card-title">Karate cho Người Mới</h5>
                        <p class="card-text">Khóa học cơ bản dành cho người mới bắt đầu, giúp nắm vững các kỹ thuật căn bản.</p>
                        <p><strong>Lịch học:</strong> Thứ 2, 4, 6 (18:00 - 19:30)</p>
                        <p><strong>Giảng viên:</strong> Nguyễn Văn A</p>
                        <p><strong>Học phí:</strong> 800.000đ/tháng</p>
                        <a href="#" class="btn btn-danger">Đăng Ký Ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card class-card">
                    <img src="{{ asset('images/class-2.jpg') }}" class="card-img-top class-image" alt="Karate Nâng Cao">
                    <div class="card-body">
                        <h5 class="card-title">Karate Nâng Cao</h5>
                        <p class="card-text">Dành cho học viên đã có kinh nghiệm, tập trung vào các kỹ thuật và chiến thuật phức tạp.</p>
                        <p><strong>Lịch học:</strong> Thứ 3, 5, 7 (19:30 - 21:00)</p>
                        <p><strong>Giảng viên:</strong> Trần Thị B</p>
                        <p><strong>Học phí:</strong> 1.200.000đ/tháng</p>
                        <a href="#" class="btn btn-danger">Đăng Ký Ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card class-card">
                    <img src="{{ asset('images/class-3.jpg') }}" class="card-img-top class-image" alt="Karate cho Trẻ Em">
                    <div class="card-body">
                        <h5 class="card-title">Karate cho Trẻ Em</h5>
                        <p class="card-text">Khóa học đặc biệt thiết kế cho trẻ em, giúp phát triển kỹ năng vận động và tự tin.</p>
                        <p><strong>Lịch học:</strong> Thứ 2, 4, 6 (16:00 - 17:30)</p>
                        <p><strong>Giảng viên:</strong> Lê Văn C</p>
                        <p><strong>Học phí:</strong> 700.000đ/tháng</p>
                        <a href="#" class="btn btn-danger">Đăng Ký Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection