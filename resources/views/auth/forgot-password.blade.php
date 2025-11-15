<!-- resources/views/auth/forgot-password.blade.php -->
<x-guest-layout>
    <div class="mb-4">
        {{ __('Quên mật khẩu? Không vấn đề. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn liên kết đặt lại mật khẩu để chọn mật khẩu mới.') }}
    </div>

    <x-auth-session-status class="alert alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn-link" href="{{ route('login') }}">
                {{ __('Quay lại đăng nhập') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Gửi liên kết đặt lại mật khẩu') }}
            </button>
        </div>
    </form>
</x-guest-layout>