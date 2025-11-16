@extends('layouts.admin')

@section('title', 'Chi Tiết Đánh Giá')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi Tiết Đánh Giá</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Học viên</th>
                            <td>
                                <strong>{{ $testimonial->name }}</strong><br>
                                @if($testimonial->user)
                                    <small>{{ $testimonial->user->email }}</small>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Lớp học</th>
                            <td>{{ $testimonial->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Đánh giá sao</th>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }} fs-4"></i>
                                @endfor
                                <strong class="ms-2">{{ $testimonial->rating }}/5</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Nội dung đánh giá</th>
                            <td>{{ $testimonial->content }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($testimonial->status == 'pending')
                                    <span class="badge bg-warning">Chờ phê duyệt</span>
                                @elseif($testimonial->status == 'approved')
                                    <span class="badge bg-success">Đã phê duyệt</span>
                                @else
                                    <span class="badge bg-danger">Đã từ chối</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $testimonial->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($testimonial->admin_note)
                        <tr>
                            <th>Ghi chú admin</th>
                            <td>{{ $testimonial->admin_note }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($testimonial->status == 'pending')
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success">
                    <h6 class="m-0 font-weight-bold text-white">Phê Duyệt Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ghi chú (tùy chọn)</label>
                            <textarea name="admin_note" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check"></i> Phê Duyệt
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Từ Chối Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Lý do từ chối <span class="text-danger">*</span></label>
                            <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn từ chối đánh giá này?')">
                            <i class="fas fa-times"></i> Từ Chối
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
                    <p class="text-muted">Đánh giá đã được xử lý.</p>
                </div>
            </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Xóa Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?')">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

