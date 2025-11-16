<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Karate Dojo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px;">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Karate Dojo Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-white">
                        <i class="fas fa-tachometer-alt"></i> Bảng Điều Khiển
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-users"></i> Quản Lý Người Dùng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.banners.index') }}" class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-images"></i> Quản Lý Banner
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.classes.index') }}" class="nav-link {{ request()->routeIs('admin.classes.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-chalkboard-teacher"></i> Quản Lý Lớp Học
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.instructors.index') }}" class="nav-link {{ request()->routeIs('admin.instructors.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-user-tie"></i> Quản Lý Giảng Viên
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-shopping-cart"></i> Quản Lý Đơn Hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-money-bill-wave"></i> Quản Lý Thanh Toán
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.enrollments.index') }}" class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-user-check"></i> Quản Lý Đăng Ký
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.lessons.index') }}" class="nav-link {{ request()->routeIs('admin.lessons.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-book"></i> Quản Lý Bài Học
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sessions.index') }}" class="nav-link {{ request()->routeIs('admin.sessions.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-calendar-alt"></i> Quản Lý Buổi Học
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.attendances.index') }}" class="nav-link {{ request()->routeIs('admin.attendances.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-clipboard-check"></i> Điểm Danh
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }} text-white">
                        <i class="fas fa-star"></i> Đánh Giá
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Hồ sơ</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main content -->
        <div class="admin-content flex-grow-1">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Xem Trang Web
                        </a>
                    </li>
                </ul>
            </nav>

            @if(session('error'))
                <div class="container-fluid mt-3">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
            @endif

            @if(session('success'))
                <div class="container-fluid mt-3">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>