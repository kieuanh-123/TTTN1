@extends('layouts.main')

@section('title', 'Dashboard Học Viên')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard Học Viên</h1>
        <a href="{{ route('student.classes') }}" class="btn btn-primary">
            <i class="fas fa-book"></i> Xem Lớp Học
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Lớp Đang Học</h6>
                            <h2 class="mb-0">{{ $totalClasses }}</h2>
                        </div>
                        <i class="fas fa-chalkboard-teacher fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Lớp Đã Hoàn Thành</h6>
                            <h2 class="mb-0">{{ $completedClasses }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Bài Đã Hoàn Thành</h6>
                            <h2 class="mb-0">{{ $totalLessonsCompleted }}</h2>
                        </div>
                        <i class="fas fa-book-open fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Đơn Chờ Xử Lý</h6>
                            <h2 class="mb-0">{{ $pendingOrders->count() }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Active Enrollments -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lớp Học Đang Tham Gia</h6>
                </div>
                <div class="card-body">
                    @forelse($enrollments as $enrollment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title">{{ $enrollment->karateClass->name ?? 'N/A' }}</h5>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i> Bắt đầu: {{ $enrollment->start_date ? $enrollment->start_date->format('d/m/Y') : 'N/A' }}
                                        </small>
                                    </p>
                                    <span class="badge bg-{{ $enrollment->status == 'active' ? 'success' : 'info' }}">
                                        {{ $enrollment->status == 'active' ? 'Đang học' : 'Đã phê duyệt' }}
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('student.classes.lessons', $enrollment->karateClass) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-book"></i> Học Ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Bạn chưa có lớp học nào. <a href="{{ route('classes') }}">Đăng ký ngay</a></p>
                    @endforelse
                </div>
            </div>

            @if($upcomingSessions->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lịch Học Sắp Tới</h6>
                </div>
                <div class="card-body">
                    @foreach($upcomingSessions as $session)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">{{ $session->title }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> {{ $session->session_date->format('d/m/Y') }}
                                        <i class="fas fa-clock ms-2"></i> {{ $session->start_time }} - {{ $session->end_time }}
                                    </small>
                                    @if($session->location)
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $session->location }}
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Pending Orders -->
        <div class="col-md-4">
            @if($pendingOrders->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning">
                    <h6 class="m-0 font-weight-bold text-white">Đơn Hàng Chờ Xử Lý</h6>
                </div>
                <div class="card-body">
                    @foreach($pendingOrders as $order)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $order->karateClass->name ?? 'N/A' }}</h6>
                        <p class="mb-1">
                            <strong>Mã đơn:</strong> {{ $order->order_code }}<br>
                            <strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }} đ
                        </p>
                        <a href="{{ route('payments.show', ['order' => $order->id]) }}" class="btn btn-sm btn-primary w-100">
                            Thanh Toán
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('student.classes') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-book"></i> Lớp Học Của Tôi
                    </a>
                    <a href="{{ route('student.progress') }}" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-chart-line"></i> Tiến Độ Học Tập
                    </a>
                    <a href="{{ route('classes') }}" class="btn btn-outline-info w-100">
                        <i class="fas fa-plus-circle"></i> Đăng Ký Lớp Mới
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

