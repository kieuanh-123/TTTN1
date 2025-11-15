<!-- resources/views/auth/confirm-password.blade.php -->
<x-guest-layout>
    <div class="mb-4">
        {{ __('Đây là khu vực bảo mật của ứng dụng. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                {{ __('Xác nhận') }}
            </button>
        </div>
    </form>
</x-guest-layout>