@extends('layouts.admin')

@section('title', 'Chi Tiết Bài Học')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $lesson->title }}</h1>
        <div>
            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </a>
            <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Bài Học</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Lớp học</th>
                            <td>{{ $lesson->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Thứ tự</th>
                            <td>{{ $lesson->lesson_order }}</td>
                        </tr>
                        <tr>
                            <th>Thời lượng</th>
                            <td>{{ $lesson->duration_minutes ?? 'N/A' }} phút</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $lesson->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Mục tiêu</th>
                            <td>{{ $lesson->objectives ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($lesson->is_published)
                                    <span class="badge bg-success">Đã xuất bản</span>
                                @else
                                    <span class="badge bg-warning">Nháp</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Nội Dung Bài Học</h6>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addContentModal">
                        <i class="fas fa-plus"></i> Thêm nội dung
                    </button>
                </div>
                <div class="card-body">
                    @forelse($lesson->contents as $content)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>{{ $content->title ?? 'Nội dung ' . $content->order }}</h5>
                                    <span class="badge bg-{{ $content->content_type == 'video' ? 'danger' : 'primary' }}">
                                        {{ $content->formatted_content_type }}
                                    </span>
                                    @if($content->file_name)
                                    <p class="mb-0 mt-2">
                                        <small>{{ $content->file_name }} ({{ $content->file_size_human }})</small>
                                    </p>
                                    @endif
                                </div>
                                <div>
                                    @if($content->content_type == 'video' || $content->content_type == 'pdf')
                                        <a href="{{ Storage::url($content->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-download"></i> Tải xuống
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Chưa có nội dung nào cho bài học này.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thao Tác</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.lessons.publish', $lesson) }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-{{ $lesson->is_published ? 'warning' : 'success' }} w-100">
                            <i class="fas fa-{{ $lesson->is_published ? 'eye-slash' : 'eye' }}"></i> 
                            {{ $lesson->is_published ? 'Ẩn bài học' : 'Xuất bản bài học' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc muốn xóa bài học này?')">
                            <i class="fas fa-trash"></i> Xóa bài học
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Content Modal -->
<div class="modal fade" id="addContentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Nội Dung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Loại nội dung</label>
                        <select name="content_type" class="form-select" required>
                            <option value="video">Video</option>
                            <option value="pdf">PDF</option>
                            <option value="text">Văn bản</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <input type="file" name="file" class="form-control" accept="video/*,application/pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

