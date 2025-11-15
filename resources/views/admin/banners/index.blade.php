@extends('layouts.admin')

@section('title', 'Quản Lý Banner')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Banner</h1>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Thêm Banner Mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Banner</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Phụ đề</th>
                            <th>Trạng thái</th>
                            <th>Thứ tự</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" width="100">
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->subtitle }}</td>
                            <td>
                                <span class="badge {{ $banner->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $banner->status == 'active' ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>{{ $banner->order }}</td>
                            <td>
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa banner này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu banner</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection