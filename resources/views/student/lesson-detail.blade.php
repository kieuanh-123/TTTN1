@extends('layouts.main')

@section('title', $lesson->title)

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.classes') }}">Lớp Học</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('student.classes.lessons', $class) }}">{{ $class->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $lesson->title }}</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0">{{ $lesson->title }}</h1>
            @if($lesson->description)
            <p class="text-muted">{{ $lesson->description }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <!-- Lesson Content -->
            @forelse($lesson->contents as $content)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ $content->title ?? 'Nội dung ' . $loop->iteration }}
                        <span class="badge bg-{{ $content->content_type == 'video' ? 'danger' : 'primary' }} ms-2">
                            {{ $content->formatted_content_type }}
                        </span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($content->content_type == 'video')
                        @if($content->file_path)
                            <video width="100%" controls class="mb-3">
                                <source src="{{ Storage::url($content->file_path) }}" type="video/mp4">
                                Trình duyệt của bạn không hỗ trợ video.
                            </video>
                        @elseif($content->content)
                            <!-- If content is a URL (YouTube, Vimeo, etc.) -->
                            <div class="ratio ratio-16x9 mb-3">
                                {!! $content->content !!}
                            </div>
                        @endif
                    @elseif($content->content_type == 'pdf')
                        @if($content->file_path)
                            <iframe src="{{ Storage::url($content->file_path) }}" width="100%" height="600px" class="mb-3"></iframe>
                            <a href="{{ Storage::url($content->file_path) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-download"></i> Tải PDF
                            </a>
                        @endif
                    @else
                        <div class="content-text">
                            {!! $content->content !!}
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <p class="mb-0">Chưa có nội dung cho bài học này.</p>
            </div>
            @endforelse

            <!-- Exercises -->
            @if($lesson->exercises->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bài Tập</h6>
                </div>
                <div class="card-body">
                    @foreach($lesson->exercises as $exercise)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $exercise->title }}</h6>
                        <p>{{ $exercise->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Navigation -->
            <div class="d-flex justify-content-between mt-4">
                @if($previousLesson)
                <a href="{{ route('student.lessons.show', $previousLesson) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Bài Trước
                </a>
                @else
                <span></span>
                @endif

                <form action="{{ route('student.lessons.complete', $lesson) }}" method="POST" class="d-inline">
                    @csrf
                    @if($progress->status != 'completed')
                        <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc đã hoàn thành bài học này?')">
                            <i class="fas fa-check"></i> Đánh Dấu Hoàn Thành
                        </button>
                    @else
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-check-circle"></i> Đã Hoàn Thành
                        </span>
                    @endif
                </form>

                @if($nextLesson)
                <a href="{{ route('student.lessons.show', $nextLesson) }}" class="btn btn-primary">
                    Bài Tiếp <i class="fas fa-arrow-right"></i>
                </a>
                @else
                <span></span>
                @endif
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tiến Độ</h6>
                </div>
                <div class="card-body">
                    @if($progress->status == 'completed')
                        <div class="text-center mb-3">
                            <i class="fas fa-check-circle fa-3x text-success"></i>
                            <p class="mt-2 mb-0"><strong>Đã hoàn thành</strong></p>
                            @if($progress->completed_at)
                            <small class="text-muted">{{ $progress->completed_at->format('d/m/Y H:i') }}</small>
                            @endif
                        </div>
                    @else
                        <div class="mb-3">
                            <small class="text-muted">Tiến độ học tập</small>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $progress->progress_percentage }}%">
                                    {{ $progress->progress_percentage }}%
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($progress->time_spent_minutes)
                    <p class="mb-0">
                        <small><i class="fas fa-clock"></i> Thời gian: {{ $progress->time_spent_minutes }} phút</small>
                    </p>
                    @endif

                    <hr>

                    <a href="{{ route('student.classes.lessons', $class) }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-list"></i> Danh Sách Bài Học
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

