@extends('layouts.admin')

@section('title', 'Quản Lý Buổi Học')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Buổi Học</h1>
        <a href="{{ route('admin.sessions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tạo Buổi Học Mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.sessions.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="class_id" class="form-select">
                            <option value="">Tất cả lớp học</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Đã lên lịch</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="Từ ngày">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="Đến ngày">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Lớp học</th>
                            <th>Ngày học</th>
                            <th>Giờ học</th>
                            <th>Địa điểm</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $session)
                        <tr>
                            <td><strong>{{ $session->title }}</strong></td>
                            <td>{{ $session->karateClass->name ?? 'N/A' }}</td>
                            <td>{{ $session->session_date->format('d/m/Y') }}</td>
                            <td>{{ $session->start_time }} - {{ $session->end_time }}</td>
                            <td>{{ $session->location ?? 'N/A' }}</td>
                            <td>
                                @if($session->status == 'scheduled')
                                    <span class="badge bg-info">Đã lên lịch</span>
                                @elseif($session->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.sessions.show', $session) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.sessions.edit', $session) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.attendances.show-session', $session) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-clipboard-check"></i> Điểm danh
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có buổi học nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

