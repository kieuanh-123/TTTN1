@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bảng Điều Khiển</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng Số Người Dùng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'totalUsers', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng Số Bài Viết</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'totalNews', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Số Lớp Học</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'totalClasses', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Số Giảng Viên</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'totalInstructors', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Tổng Số Học Viên</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'totalStudents', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ghi Danh Đang Hoạt Động</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'activeEnrollments', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Đơn Hàng Đang Chờ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'pendingOrders', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Thanh Toán Đang Duyệt</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(data_get($stats, 'pendingPayments', 0)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-donate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hoạt Động Gần Đây</h6>
                </div>
                <div class="card-body">
                    @if(isset($recentOrders) && $recentOrders->isNotEmpty())
                        <ul class="list-unstyled mb-0">
                            @foreach($recentOrders as $order)
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $order->order_code }}</strong>
                                            <div class="text-muted small">
                                                {{ optional($order->user)->name ?? 'Không rõ' }} •
                                                {{ optional($order->karateClass)->name ?? 'Chưa gán lớp' }}
                                            </div>
                                        </div>
                                        @php
                                            $badgeClass = match($order->status) {
                                                'pending' => 'badge bg-warning text-dark',
                                                'approved', 'paid', 'completed' => 'badge bg-success',
                                                'cancelled' => 'badge bg-danger',
                                                default => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $badgeClass }}">{{ $order->formatted_status }}</span>
                                    </div>
                                    <div class="text-muted small">
                                        {{ $order->created_at?->setTimezone(config('app.timezone'))->format('d/m/Y H:i') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Chưa có hoạt động nào gần đây.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tác Vụ Nhanh</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus-circle me-2"></i> Thêm Tin Mới
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-success btn-block">
                                <i class="fas fa-plus-circle me-2"></i> Thêm Lớp Học
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('admin.instructors.create') }}" class="btn btn-info btn-block">
                                <i class="fas fa-plus-circle me-2"></i> Thêm Giảng Viên
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-plus-circle me-2"></i> Thêm Banner
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tin Tức Mới Nhất</h6>
                </div>
                <div class="card-body">
                    @if(isset($recentNews) && $recentNews->isNotEmpty())
                        @foreach($recentNews as $news)
                            <div class="mb-3">
                                <a href="{{ route('admin.news.show', $news) }}" class="fw-bold">
                                    {{ $news->title }}
                                </a>
                                <div class="text-muted small">
                                    {{ $news->created_at?->format('d/m/Y') }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Chưa có tin tức nào.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lớp Có Nhiều Buổi Học</h6>
                </div>
                <div class="card-body">
                    @if(isset($classesWithSessions) && $classesWithSessions->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Lớp</th>
                                        <th>Giảng viên</th>
                                        <th class="text-end">Số buổi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classesWithSessions as $class)
                                        <tr>
                                            <td>{{ $class->name }}</td>
                                            <td>{{ optional($class->instructor)->name ?? 'Chưa phân công' }}</td>
                                            <td class="text-end">{{ $class->sessions_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Chưa có dữ liệu lớp học.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection