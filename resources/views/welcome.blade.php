<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Karate TMA') - Trung Tâm Đào Tạo Võ Thuật</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Karate TMATMA" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Về chúng tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('classes') ? 'active' : '' }}" href="{{ route('classes') }}">Lớp võ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('instructors') ? 'active' : '' }}" href="{{ route('instructors') }}">Đội ngũ giảng dạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('certificate') ? 'active' : '' }}" href="{{ route('certificate') }}">Cấp chứng chỉ</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Quản trị</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Hồ sơ</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Karate TMA</h5>
                    <p>Nơi đào tạo võ thuật chuyên nghiệp hàng đầu Việt Nam</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ 1: TTTM Sóng Thần, Số 1 Đại lộ Độc Lập, Tp.Dĩ An, Bình Dương</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ 2: 73 Đường số 9, khu phố 4, phường Bình Chiểu, Tp.Thủ Đức, TP.HCM</p>
                    <p><i class="fas fa-phone me-2"></i> 093.876.2783</p>
                    <p><i class="fas fa-envelope me-2"></i>info@dn5sao.edu.vn</p>
                </div>
                <div class="col-md-4">
                    <h5>Giờ học</h5>
                    <p>Thứ 2 - Thứ 6: 8:00 - 21:00</p>
                    <p>Thứ 7 - Chủ Nhật: 9:00 - 17:00</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Karate TMA. Đã đăng ký Bản quyền.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>