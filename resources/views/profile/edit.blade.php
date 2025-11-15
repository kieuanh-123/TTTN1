@extends('layouts.main')

@section('title', 'Hồ Sơ Cá Nhân')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('images/placeholder-user.jpg') }}" alt="{{ Auth::user()->name }}" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    
                    @if(Auth::user()->isAdmin())
                        <span class="badge bg-danger mb-3">Quản trị viên</span>
                    @else
                        <span class="badge bg-primary mb-3">Học viên</span>
                    @endif
                    
                    @if(Auth::user()->isAdmin())
                        <div class="mt-3">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-tachometer-alt me-1"></i> Quản trị
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="list-group shadow-sm">
                <a href="#profile-info" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                    <i class="fas fa-user me-2"></i> Thông tin cá nhân
                </a>
                <a href="#change-password" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-key me-2"></i> Đổi mật khẩu
                </a>
                <a href="#delete-account" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-trash-alt me-2"></i> Xóa tài khoản
                </a>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="profile-info">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Thông Tin Cá Nhân</h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="change-password">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Đổi Mật Khẩu</h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="delete-account">
                    <div class="card shadow-sm border-danger">
                        <div class="card-header bg-white text-danger">
                            <h5 class="card-title mb-0">Xóa Tài Khoản</h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection