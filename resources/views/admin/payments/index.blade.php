@extends('layouts.admin')

@section('title', 'Quản Lý Thanh Toán')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Thanh Toán</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Thanh Toán</h6>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.payments.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="payment_method" class="form-select">
                            <option value="">Tất cả phương thức</option>
                            <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản</option>
                            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Tiền mặt</option>
                            <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Thẻ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo mã thanh toán, tên, email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã thanh toán</th>
                            <th>Khách hàng</th>
                            <th>Đơn hàng</th>
                            <th>Lớp học</th>
                            <th>Số tiền</th>
                            <th>Phương thức</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_code }}</td>
                            <td>
                                <strong>{{ $payment->user->name }}</strong><br>
                                <small class="text-muted">{{ $payment->user->email }}</small>
                            </td>
                            <td>{{ $payment->order->order_code ?? 'N/A' }}</td>
                            <td>{{ $payment->order->karateClass->name ?? 'N/A' }}</td>
                            <td><strong>{{ number_format($payment->amount) }} đ</strong></td>
                            <td>
                                @if($payment->payment_method == 'bank_transfer')
                                    <span class="badge bg-info">Chuyển khoản</span>
                                @elseif($payment->payment_method == 'cash')
                                    <span class="badge bg-secondary">Tiền mặt</span>
                                @else
                                    <span class="badge bg-primary">Thẻ</span>
                                @endif
                            </td>
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
                            <td>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Không có thanh toán nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

