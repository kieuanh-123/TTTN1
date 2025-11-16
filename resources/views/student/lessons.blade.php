@extends('layouts.main')

@section('title', 'Bài Học - ' . $class->name)

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">{{ $class->name }}</h1>
            <p class="text-muted mb-0">{{ $class->description }}</p>
        </div>
        <a href="{{ route('student.classes') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Bài Học</h6>
                </div>
                <div class="card-body">
                    @forelse($lessons as $lesson)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-secondary me-2">Bài {{ $lesson->lesson_order }}</span>
                                        <h5 class="mb-0">{{ $lesson->title }}</h5>
                                    </div>
                                    @if($lesson->description)
                                    <p class="text-muted mb-2">{{ $lesson->description }}</p>
                                    @endif
                                    <div class="d-flex gap-3 text-muted small">
                                        @if($lesson->duration_minutes)
                                        <span><i class="fas fa-clock"></i> {{ $lesson->duration_minutes }} phút</span>
                                        @endif
                                        <span><i class="fas fa-video"></i> {{ $lesson->contents->where('content_type', 'video')->count() }} video</span>
                                        <span><i class="fas fa-file-pdf"></i> {{ $lesson->contents->where('content_type', 'pdf')->count() }} PDF</span>
                                    </div>
                                    @if(isset($progress[$lesson->id]))
                                    <div class="mt-2">
                                        @if($progress[$lesson->id]->status == 'completed')
                                            <span class="badge bg-success"><i class="fas fa-check"></i> Đã hoàn thành</span>
                                        @else
                                            <span class="badge bg-info">Đang học</span>
                                            <div class="progress mt-2" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $progress[$lesson->id]->progress_percentage }}%"></div>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('student.lessons.show', $lesson) }}" class="btn btn-primary">
                                        <i class="fas fa-play"></i> Học Ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">
                        <p class="mb-0">Chưa có bài học nào cho lớp này.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

