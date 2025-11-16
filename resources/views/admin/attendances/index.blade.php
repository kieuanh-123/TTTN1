@extends('layouts.admin')

@section('title', 'Điểm Danh')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản Lý Điểm Danh</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.attendances.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <select name="session_id" class="form-select">
                            <option value="">Tất cả buổi học</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" {{ request('session_id') == $session->id ? 'selected' : '' }}>
                                    {{ $session->title }} - {{ $session->session_date->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Có mặt</option>
                            <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Vắng mặt</option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Muộn</option>
                            <option value="excused" {{ request('status') == 'excused' ? 'selected' : '' }}>Có phép</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Học viên</th>
                            <th>Buổi học</th>
                            <th>Lớp học</th>
                            <th>Trạng thái</th>
                            <th>Thời gian điểm danh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->user->name }}</td>
                            <td>
                                @if($attendance->session)
                                    <a href="{{ route('admin.sessions.show', $attendance->session) }}">
                                        {{ $attendance->session->title }}
                                    </a>
                                    <br>
                                    <small class="text-muted">{{ $attendance->session->session_date->format('d/m/Y') }}</small>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $attendance->karateClass->name ?? 'N/A' }}</td>
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
                            <td>
                                @if($attendance->session)
                                    <a href="{{ route('admin.attendances.show-session', $attendance->session) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu điểm danh</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

