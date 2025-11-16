@extends('layouts.admin')

@section('title', 'Quản Lý Bài Học')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Bài Học</h1>
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Thêm Bài Học Mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Bài Học</h6>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.lessons.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
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
                        <select name="is_published" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="1" {{ request('is_published') == '1' ? 'selected' : '' }}>Đã xuất bản</option>
                            <option value="0" {{ request('is_published') == '0' ? 'selected' : '' }}>Chưa xuất bản</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tiêu đề</th>
                            <th>Lớp học</th>
                            <th>Thời lượng</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->lesson_order }}</td>
                            <td><strong>{{ $lesson->title }}</strong></td>
                            <td>{{ $lesson->karateClass->name ?? 'N/A' }}</td>
                            <td>{{ $lesson->duration_minutes ?? 'N/A' }} phút</td>
                            <td>
                                <small>
                                    {{ $lesson->contents->count() }} video/PDF
                                </small>
                            </td>
                            <td>
                                @if($lesson->is_published)
                                    <span class="badge bg-success">Đã xuất bản</span>
                                @else
                                    <span class="badge bg-warning">Nháp</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.lessons.show', $lesson) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lessons.publish', $lesson) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-{{ $lesson->is_published ? 'warning' : 'success' }}">
                                        <i class="fas fa-{{ $lesson->is_published ? 'eye-slash' : 'eye' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài học này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có bài học nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $lessons->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

