<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">{{ __('Họ và tên') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Xác nhận mật khẩu') }}</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="btn-link" href="{{ route('login') }}">
                {{ __('Đã có tài khoản?') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Đăng ký') }}
            </button>
        </div>
        
        <div class="auth-divider">
            <span>Hoặc đăng ký với</span>
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
    </form>
</x-guest-layout>