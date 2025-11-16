@extends('layouts.admin')

@section('title', 'Quản Lý Đánh Giá')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Đánh Giá</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.testimonials.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã phê duyệt</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, nội dung, lớp học..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Học viên</th>
                            <th>Lớp học</th>
                            <th>Đánh giá</th>
                            <th>Sao</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                        <tr>
                            <td>
                                <strong>{{ $testimonial->name }}</strong><br>
                                @if($testimonial->user)
                                    <small class="text-muted">{{ $testimonial->user->email }}</small>
                                @endif
                            </td>
                            <td>{{ $testimonial->karateClass->name ?? 'N/A' }}</td>
                            <td>
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($testimonial->content, 100) }}
                                </div>
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                ({{ $testimonial->rating }})
                            </td>
                            <td>
                                @if($testimonial->status == 'pending')
                                    <span class="badge bg-warning">Chờ phê duyệt</span>
                                @elseif($testimonial->status == 'approved')
                                    <span class="badge bg-success">Đã phê duyệt</span>
                                @else
                                    <span class="badge bg-danger">Đã từ chối</span>
                                @endif
                            </td>
                            <td>{{ $testimonial->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có đánh giá nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

