@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Buổi Học')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chỉnh Sửa Buổi Học: {{ $session->title }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sessions.update', $session) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Lớp học <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                        <option value="">Chọn lớp học</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ ($session->class_id == $class->id || old('class_id') == $class->id) ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $session->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $session->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Ngày học <span class="text-danger">*</span></label>
                            <input type="date" name="session_date" class="form-control @error('session_date') is-invalid @enderror" value="{{ old('session_date', $session->session_date->format('Y-m-d')) }}" required>
                            @error('session_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Giờ bắt đầu <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $session->start_time) }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Giờ kết thúc <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $session->end_time) }}" required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Địa điểm</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $session->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giảng viên</label>
                            <select name="instructor_id" class="form-select @error('instructor_id') is-invalid @enderror">
                                <option value="">Chọn giảng viên</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ ($session->instructor_id == $instructor->id || old('instructor_id') == $instructor->id) ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="scheduled" {{ ($session->status == 'scheduled' || old('status') == 'scheduled') ? 'selected' : '' }}>Đã lên lịch</option>
                        <option value="completed" {{ ($session->status == 'completed' || old('status') == 'completed') ? 'selected' : '' }}>Đã hoàn thành</option>
                        <option value="cancelled" {{ ($session->status == 'cancelled' || old('status') == 'cancelled') ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $session->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập Nhật
                </button>
                <a href="{{ route('admin.sessions.show', $session) }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection

