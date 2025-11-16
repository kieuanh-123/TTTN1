@extends('layouts.admin')

@section('title', 'Quản Lý Đăng Ký')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Đăng Ký</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Đăng Ký</h6>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.enrollments.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã phê duyệt</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang học</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, email..." value="{{ request('search') }}">
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
                            <th>ID</th>
                            <th>Học viên</th>
                            <th>Lớp học</th>
                            <th>Trạng thái</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày đăng ký</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>
                                <strong>{{ $enrollment->user->name }}</strong><br>
                                <small class="text-muted">{{ $enrollment->user->email }}</small>
                            </td>
                            <td>{{ $enrollment->karateClass->name ?? 'N/A' }}</td>
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
                            <td>{{ $enrollment->start_date ? $enrollment->start_date->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $enrollment->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có đăng ký nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

