<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <x-auth-session-status class="alert alert-success" :status="session('status')" />

    {{-- Hiện thông báo thành công (session('status')) --}}
    <x-auth-session-status class="alert alert-success" :status="session('status')" />

    {{-- Hiện thông báo lỗi custom (session('error')) --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Ghi nhớ đăng nhập') }}
                </label>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (Route::has('password.request'))
                <a class="btn-link" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                {{ __('Đăng nhập') }}
            </button>
        </div>
        
        <div class="auth-divider">
            <span>Hoặc đăng nhập với</span>
        </div>
        
        <div class="social-login">
            <a href="{{route('auth-facebook')}}" class="social-btn facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{route('redirect-google')}}" class="social-btn google">
                <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-btn twitter">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
        
        <div class="text-center">
            <p>Chưa có tài khoản? <a href="{{ route('register') }}" class="btn-link">Đăng ký ngay</a></p>
        </div>
    </form>

    
</x-guest-layout>