@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Banner')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh Sửa Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Banner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Phụ đề</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}">
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh hiện tại</label>
                    <div>
                        <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Cập nhật hình ảnh mới</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    <small class="form-text text-muted">Kích thước khuyến nghị: 1920x600 pixel. Để trống nếu không muốn thay đổi.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Liên kết</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $banner->link) }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status', $banner->status) == 'active' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="inactive" {{ old('status', $banner->status) == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Thứ tự <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $banner->order) }}" required>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật Banner</button>
            </form>
        </div>
    </div>
</div>
@endsection