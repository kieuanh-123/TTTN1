@extends('layouts.admin')

@section('title', 'Chi Tiết Buổi Học')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $session->title }}</h1>
        <div>
            <a href="{{ route('admin.attendances.show-session', $session) }}" class="btn btn-success">
                <i class="fas fa-clipboard-check"></i> Điểm danh
            </a>
            <a href="{{ route('admin.sessions.edit', $session) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </a>
            <a href="{{ route('admin.sessions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Buổi Học</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Lớp học</th>
                            <td>{{ $session->karateClass->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ngày học</th>
                            <td>{{ $session->session_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Giờ học</th>
                            <td>{{ $session->start_time }} - {{ $session->end_time }}</td>
                        </tr>
                        <tr>
                            <th>Địa điểm</th>
                            <td>{{ $session->location ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Giảng viên</th>
                            <td>{{ $session->instructor->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if($session->status == 'scheduled')
                                    <span class="badge bg-info">Đã lên lịch</span>
                                @elseif($session->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                        </tr>
                        @if($session->description)
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $session->description }}</td>
                        </tr>
                        @endif
                        @if($session->notes)
                        <tr>
                            <th>Ghi chú</th>
                            <td>{{ $session->notes }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if($session->attendances->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Điểm Danh ({{ $session->attendances->count() }})</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Học viên</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian điểm danh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($session->attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>
                                        @if($attendance->status == 'present')
                                            <span class="badge bg-success">Có mặt</span>
                                        @elseif($attendance->status == 'absent')
                                            <span class="badge bg-danger">Vắng mặt</span>
                                        @elseif($attendance->status == 'late')
                                            <span class="badge bg-warning">Muộn</span>
                                        @else
                                            <span class="badge bg-info">Có phép</span>
                                        @endif
                                    </td>
                                    <td>{{ $attendance->checked_in_at ? $attendance->checked_in_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

