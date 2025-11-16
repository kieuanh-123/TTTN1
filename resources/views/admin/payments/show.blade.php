@extends('layouts.admin')

@section('title', 'Chi Tiết Thanh Toán')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi Tiết Thanh Toán: {{ $payment->payment_code }}</h1>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Thanh Toán</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Mã thanh toán</th>
                            <td>{{ $payment->payment_code }}</td>
                        </tr>
                        <tr>
                            <th>Khách hàng</th>
                            <td>
                                <strong>{{ $payment->user->name }}</strong><br>
                                <small>{{ $payment->user->email }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Đơn hàng</th>
                            <td>
                                <a href="{{ route('admin.orders.show', $payment->order) }}">
                                    {{ $payment->order->order_code }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Lớp học</th>
                            <td>{{ $payment->order->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Số tiền</th>
                            <td><strong class="text-danger fs-5">{{ number_format($payment->amount) }} đ</strong></td>
                        </tr>
                        <tr>
                            <th>Phương thức thanh toán</th>
                            <td>
                                @if($payment->payment_method == 'bank_transfer')
                                    <span class="badge bg-info">Chuyển khoản ngân hàng</span>
                                @elseif($payment->payment_method == 'cash')
                                    <span class="badge bg-secondary">Tiền mặt</span>
                                @else
                                    <span class="badge bg-primary">Thẻ tín dụng/Ghi nợ</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($payment->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @elseif($payment->status == 'pending')
                                    <span class="badge bg-warning">Chờ xử lý</span>
                                @else
                                    <span class="badge bg-danger">Thất bại</span>
                                @endif
                            </td>
                        </tr>
                        @if($payment->payment_proof)
                        <tr>
                            <th>Chứng từ thanh toán</th>
                            <td>
                                <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-image"></i> Xem ảnh chứng từ
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($payment->paid_at)
                        <tr>
                            <th>Ngày thanh toán</th>
                            <td>{{ $payment->paid_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($payment->notes)
                        <tr>
                            <th>Ghi chú</th>
                            <td>{{ $payment->notes }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($payment->status != 'completed')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Xác Nhận Thanh Toán</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.confirm', $payment) }}" method="POST">
                        @csrf
                        <p class="text-muted">Xác nhận thanh toán này đã được thực hiện thành công.</p>
                        <button type="submit" class="btn btn-success w-100" onclick="return confirm('Bạn có chắc muốn xác nhận thanh toán này?')">
                            <i class="fas fa-check"></i> Xác Nhận Thanh Toán
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
                    <p class="text-success"><i class="fas fa-check-circle"></i> Thanh toán đã được xác nhận.</p>
                    @if($payment->confirmedBy)
                    <p><strong>Xác nhận bởi:</strong> {{ $payment->confirmedBy->name }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

