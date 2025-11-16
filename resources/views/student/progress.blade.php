@extends('layouts.main')

@section('title', 'Tiến Độ Học Tập')

@section('content')
<div class="container py-5">
    <h1 class="h3 mb-4">Tiến Độ Học Tập</h1>

    @forelse($progressData as $data)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['class']->name }}</h6>
                <span class="badge bg-{{ $data['enrollment']->status == 'active' ? 'success' : 'info' }}">
                    {{ $data['enrollment']->status == 'active' ? 'Đang học' : 'Đã phê duyệt' }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Tiến độ bài học</h6>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $data['progressPercentage'] }}%">
                            {{ $data['completedLessons'] }}/{{ $data['totalLessons'] }} bài ({{ $data['progressPercentage'] }}%)
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ $data['completedLessons'] }}</h4>
                            <small class="text-muted">Bài đã hoàn thành</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-info">{{ $data['totalLessons'] - $data['completedLessons'] }}</h4>
                            <small class="text-muted">Bài còn lại</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-book-open fa-2x text-primary mb-2"></i>
                            <h5>{{ $data['totalLessons'] }}</h5>
                            <small class="text-muted">Tổng số bài học</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x text-info mb-2"></i>
                            <h5>{{ $data['totalTimeSpent'] }}</h5>
                            <small class="text-muted">Phút đã học</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                            <h5>{{ $data['attendanceCount'] }}</h5>
                            <small class="text-muted">Buổi có mặt</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('student.classes.lessons', $data['class']) }}" class="btn btn-primary">
                    <i class="fas fa-book"></i> Tiếp Tục Học
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        <h5>Chưa có dữ liệu tiến độ</h5>
        <p>Hãy bắt đầu học các lớp học của bạn để xem tiến độ!</p>
        <a href="{{ route('student.classes') }}" class="btn btn-primary">Xem Lớp Học</a>
    </div>
    @endforelse
</div>
@endsection

