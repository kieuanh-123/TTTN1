@extends('layouts.admin')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi Tiết Đơn Hàng: {{ $order->order_code }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đơn Hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Mã đơn hàng</th>
                            <td>{{ $order->order_code }}</td>
                        </tr>
                        <tr>
                            <th>Khách hàng</th>
                            <td>
                                <strong>{{ $order->user->name }}</strong><br>
                                <small>{{ $order->user->email }}</small><br>
                                <small>{{ $order->user->phone ?? 'N/A' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Lớp học</th>
                            <td>{{ $order->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền</th>
                            <td><strong class="text-danger">{{ number_format($order->total_amount) }} đ</strong></td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Chờ xử lý</span>
                                @elseif($order->status == 'approved')
                                    <span class="badge bg-info">Đã phê duyệt</span>
                                @elseif($order->status == 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @else
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($order->admin_note)
                        <tr>
                            <th>Ghi chú admin</th>
                            <td>{{ $order->admin_note }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if($order->payments->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lịch Sử Thanh Toán</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã thanh toán</th>
                                    <th>Phương thức</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->payments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_code }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ number_format($payment->amount) }} đ</td>
                                    <td>
                                        @if($payment->status == 'completed')
                                            <span class="badge bg-success">Hoàn thành</span>
                                        @elseif($payment->status == 'pending')
                                            <span class="badge bg-warning">Chờ xử lý</span>
                                        @else
                                            <span class="badge bg-danger">Thất bại</span>
                                        @endif
                                    </td>
                                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thao Tác</h6>
                </div>
                <div class="card-body">
                    @if($order->status == 'pending')
                        <form action="{{ route('admin.orders.approve', $order) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Ghi chú (tùy chọn)</label>
                                <textarea name="admin_note" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check"></i> Phê Duyệt Đơn Hàng
                            </button>
                        </form>

                        <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Lý do từ chối <span class="text-danger">*</span></label>
                                <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn từ chối đơn hàng này?')">
                                <i class="fas fa-times"></i> Từ Chối Đơn Hàng
                            </button>
                        </form>
                    @else
                        <p class="text-muted">Đơn hàng đã được xử lý.</p>
                    @endif
                </div>
            </div>

            @if($order->enrollment)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đăng Ký</h6>
                </div>
                <div class="card-body">
                    <p><strong>Trạng thái:</strong> 
                        <span class="badge bg-info">{{ $order->enrollment->status }}</span>
                    </p>
                    <p><strong>Ngày bắt đầu:</strong> {{ $order->enrollment->start_date ? $order->enrollment->start_date->format('d/m/Y') : 'N/A' }}</p>
                    <a href="{{ route('admin.enrollments.show', $order->enrollment) }}" class="btn btn-sm btn-primary w-100">
                        Xem chi tiết đăng ký
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

