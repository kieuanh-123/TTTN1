@extends('layouts.main')

@section('title', 'Đăng Ký Thành Công')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden text-center">
                <div class="card-header bg-success text-white p-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-check-circle fa-3x me-3"></i>
                        <div>
                            <h3 class="mb-0 fw-bold">Đăng Ký Thành Công!</h3>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <div class="mb-4">
                        <div class="success-animation">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h4 class="fw-bold mb-3">Cảm ơn bạn đã đăng ký!</h4>
                    
                    <p class="mb-4">Chúng tôi đã nhận được thông tin đăng ký của bạn. Đội ngũ tư vấn viên sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
                    
                    <div class="registration-code mb-4">
                        <p class="text-muted mb-1">Mã đăng ký của bạn</p>
                        <h5 class="fw-bold p-3 bg-light rounded">{{ session('registration_code') }}</h5>
                        <p class="small text-muted">Vui lòng lưu lại mã này để tra cứu thông tin đăng ký sau này</p>
                    </div>
                    
                    <div class="next-steps mb-4">
                        <h5 class="fw-bold mb-3">Các bước tiếp theo</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3">
                                            <i class="fas fa-phone-alt fa-2x text-primary"></i>
                                        </div>
                                        <h6 class="fw-bold">Nhận cuộc gọi</h6>
                                        <p class="small mb-0">Tư vấn viên sẽ liên hệ với bạn trong vòng 24 giờ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-flex mb-3">
                                            <i class="fas fa-calendar-check fa-2x text-success"></i>
                                        </div>
                                        <h6 class="fw-bold">Lịch học thử</h6>
                                        <p class="small mb-0">Đặt lịch tham gia buổi học thử miễn phí</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-flex mb-3">
                                            <i class="fas fa-file-signature fa-2x text-warning"></i>
                                        </div>
                                        <h6 class="fw-bold">Hoàn tất đăng ký</h6>
                                        <p class="small mb-0">Hoàn thiện hồ sơ và bắt đầu khóa học</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i> Quay lại trang chủ
                        </a>
                        <a href="{{ route('classes') }}" class="btn btn-primary">
                            <i class="fas fa-book-open me-2"></i> Xem lớp học
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Checkmark animation */
.success-animation {
    margin: 20px auto;
    width: 80px;
    height: 80px;
}

.checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #28a745;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #28a745;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #28a745;
    fill: none;
    animation: stroke .6s cubic-bezier(0.650, 0.000, 0.450, 1.000) forwards;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke .3s cubic-bezier(0.650, 0.000, 0.450, 1.000) .8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #28a74533;
    }
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.registration-code h5 {
    letter-spacing: 2px;
    font-family: monospace;
}
</style>
@endsection
