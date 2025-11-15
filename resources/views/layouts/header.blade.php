<header class="w-full bg-karate-black text-white p-6 sticky top-0 z-50 header-animate">
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex items-center">
            <div class="logo-container">
                <h1 class="text-2xl font-bold logo-text">KARATE <span class="text-karate-red">TMA</span></h1>
            </div>
        </div>
        
        <nav class="hidden md:flex items-center gap-6">
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Trang chủ</a>
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Về chúng tôi</a>
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Khóa học</a>
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Lịch tập</a>
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Sự kiện</a>
            <a href="#" class="nav-link hover:text-karate-red transition-all relative">Liên hệ</a>
            
            <!-- Dark Mode Toggle Button -->
            <div id="darkModeToggle" class="dark-mode-toggle ml-4">
                <div class="toggle-circle">
                    <span class="toggle-icon sun-icon">☀️</span>
                    <span class="toggle-icon moon-icon">🌙</span>
                </div>
            </div>
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary bg-karate-red px-4 py-2 rounded-sm font-medium">
                        Trang quản lý
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary border border-white hover:bg-white hover:text-black px-4 py-2 rounded-sm transition-all">
                        Đăng nhập
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary bg-karate-red px-4 py-2 rounded-sm font-medium">
                            Đăng ký
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
        
        <!-- Mobile menu and dark mode toggle -->
        <div class="md:hidden flex items-center gap-4">
            <!-- Dark Mode Toggle Button (Mobile) -->
            <div id="darkModeToggleMobile" class="dark-mode-toggle">
                <div class="toggle-circle">
                    <span class="toggle-icon sun-icon">☀️</span>
                    <span class="toggle-icon moon-icon">🌙</span>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <button id="mobileMenuBtn" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-karate-black text-white py-4 px-6 absolute top-full left-0 right-0 mobile-menu-animate">
        <nav class="flex flex-col space-y-4">
            <a href="#" class="hover:text-karate-red transition-all py-2">Trang chủ</a>
            <a href="#" class="hover:text-karate-red transition-all py-2">Về chúng tôi</a>
            <a href="#" class="hover:text-karate-red transition-all py-2">Khóa học</a>
            <a href="#" class="hover:text-karate-red transition-all py-2">Lịch tập</a>
            <a href="#" class="hover:text-karate-red transition-all py-2">Sự kiện</a>
            <a href="#" class="hover:text-karate-red transition-all py-2">Liên hệ</a>
            
            @if (Route::has('login'))
                <div class="flex flex-col space-y-2 pt-2 border-t border-gray-700">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-karate-red text-white px-4 py-2 rounded-sm text-center">
                            Trang quản lý
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="border border-white text-white px-4 py-2 rounded-sm text-center hover:bg-white hover:text-black transition-all">
                            Đăng nhập
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-karate-red text-white px-4 py-2 rounded-sm text-center">
                                Đăng ký
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
    </div>
</header>