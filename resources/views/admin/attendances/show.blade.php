@extends('layouts.admin')

@section('title', 'Điểm Danh Buổi Học')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Điểm Danh: {{ $session->title }}</h1>
        <a href="{{ route('admin.sessions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Buổi Học</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Lớp học:</strong> {{ $session->karateClass->name ?? 'N/A' }}</p>
                    <p><strong>Ngày học:</strong> {{ $session->session_date->format('d/m/Y') }}</p>
                    <p><strong>Giờ học:</strong> {{ $session->start_time }} - {{ $session->end_time }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Địa điểm:</strong> {{ $session->location ?? 'N/A' }}</p>
                    <p><strong>Giảng viên:</strong> {{ $session->instructor->name ?? 'N/A' }}</p>
                    <p><strong>Trạng thái:</strong> 
                        @if($session->status == 'scheduled')
                            <span class="badge bg-info">Đã lên lịch</span>
                        @elseif($session->status == 'completed')
                            <span class="badge bg-success">Hoàn thành</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Điểm Danh Học Viên</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attendances.bulk', $session) }}" method="POST">
                @csrf
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Học viên</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrolledStudents as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <input type="hidden" name="attendances[{{ $loop->index }}][user_id]" value="{{ $student->id }}">
                                    <select name="attendances[{{ $loop->index }}][status]" class="form-select">
                                        <option value="present" {{ isset($attendances[$student->id]) && $attendances[$student->id]->status == 'present' ? 'selected' : '' }}>Có mặt</option>
                                        <option value="absent" {{ isset($attendances[$student->id]) && $attendances[$student->id]->status == 'absent' ? 'selected' : '' }}>Vắng mặt</option>
                                        <option value="late" {{ isset($attendances[$student->id]) && $attendances[$student->id]->status == 'late' ? 'selected' : '' }}>Muộn</option>
                                        <option value="excused" {{ isset($attendances[$student->id]) && $attendances[$student->id]->status == 'excused' ? 'selected' : '' }}>Có phép</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="attendances[{{ $loop->index }}][notes]" class="form-control" value="{{ isset($attendances[$student->id]) ? $attendances[$student->id]->notes : '' }}" placeholder="Ghi chú (tùy chọn)">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Lưu Điểm Danh
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

