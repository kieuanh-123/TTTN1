@extends('layouts.admin')

@section('title', 'Chi Tiết Đăng Ký')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi Tiết Đăng Ký #{{ $enrollment->id }}</h1>
        <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đăng Ký</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Học viên</th>
                            <td>
                                <strong>{{ $enrollment->user->name }}</strong><br>
                                <small>{{ $enrollment->user->email }}</small><br>
                                <small>{{ $enrollment->user->phone ?? 'N/A' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Lớp học</th>
                            <td>{{ $enrollment->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Giảng viên</th>
                            <td>{{ $enrollment->karateClass->instructor->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($enrollment->status == 'pending')
                                    <span class="badge bg-warning">Chờ phê duyệt</span>
                                @elseif($enrollment->status == 'approved')
                                    <span class="badge bg-info">Đã phê duyệt</span>
                                @elseif($enrollment->status == 'active')
                                    <span class="badge bg-success">Đang học</span>
                                @elseif($enrollment->status == 'completed')
                                    <span class="badge bg-primary">Hoàn thành</span>
                                @else
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td>{{ $enrollment->start_date ? $enrollment->start_date->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ngày kết thúc</th>
                            <td>{{ $enrollment->end_date ? $enrollment->end_date->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ngày đăng ký</th>
                            <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($enrollment->notes)
                        <tr>
                            <th>Ghi chú</th>
                            <td>{{ $enrollment->notes }}</td>
                        </tr>
                        @endif
                        @if($enrollment->order)
                        <tr>
                            <th>Đơn hàng</th>
                            <td>
                                <a href="{{ route('admin.orders.show', $enrollment->order) }}">
                                    {{ $enrollment->order->order_code }}
                                </a>
                                - 
                                <span class="badge bg-{{ $enrollment->order->status == 'paid' ? 'success' : 'warning' }}">
                                    {{ $enrollment->order->status }}
                                </span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($enrollment->status == 'pending')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Phê Duyệt Đăng Ký</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.enrollments.approve', $enrollment) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ghi chú (tùy chọn)</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $enrollment->notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check"></i> Phê Duyệt
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Hủy Đăng Ký</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.enrollments.cancel', $enrollment) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Lý do hủy <span class="text-danger">*</span></label>
                            <textarea name="notes" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn hủy đăng ký này?')">
                            <i class="fas fa-times"></i> Hủy Đăng Ký
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Đăng ký đã được xử lý.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

