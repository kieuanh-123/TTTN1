@extends('layouts.main')

@section('title', 'Lớp Học Của Tôi')

@section('content')
<div class="container py-5">
    <h1 class="h3 mb-4">Lớp Học Của Tôi</h1>

    <div class="row">
        @forelse($enrollments as $enrollment)
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title">{{ $enrollment->karateClass->name ?? 'N/A' }}</h5>
                            @if($enrollment->karateClass->instructor)
                            <p class="text-muted mb-0">
                                <i class="fas fa-user-tie"></i> {{ $enrollment->karateClass->instructor->name }}
                            </p>
                            @endif
                        </div>
                        <span class="badge bg-{{ $enrollment->status == 'active' ? 'success' : ($enrollment->status == 'approved' ? 'info' : ($enrollment->status == 'completed' ? 'primary' : 'danger')) }}">
                            @if($enrollment->status == 'active')
                                Đang học
                            @elseif($enrollment->status == 'approved')
                                Đã phê duyệt
                            @elseif($enrollment->status == 'completed')
                                Hoàn thành
                            @else
                                {{ ucfirst($enrollment->status) }}
                            @endif
                        </span>
                    </div>
                    
                    <p class="card-text">{{ Str::limit($enrollment->karateClass->description ?? '', 150) }}</p>
                    
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> Bắt đầu: {{ $enrollment->start_date ? $enrollment->start_date->format('d/m/Y') : 'N/A' }}<br>
                            @if($enrollment->end_date)
                            <i class="fas fa-calendar-times"></i> Kết thúc: {{ $enrollment->end_date->format('d/m/Y') }}
                            @endif
                        </small>
                    </div>

                    <div class="d-flex gap-2">
                        @if(in_array($enrollment->status, ['approved', 'active']))
                            <a href="{{ route('student.classes.lessons', $enrollment->karateClass) }}" class="btn btn-primary">
                                <i class="fas fa-book"></i> Học Ngay
                            </a>
                        @endif
                        <a href="{{ route('student.progress') }}" class="btn btn-outline-info">
                            <i class="fas fa-chart-line"></i> Tiến Độ
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                <h5>Bạn chưa đăng ký lớp học nào</h5>
                <p>Hãy <a href="{{ route('classes') }}" class="alert-link">đăng ký lớp học mới</a> để bắt đầu học tập!</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

