<section>
    <p class="text-muted mb-4">
        Đảm bảo tài khoản của bạn sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-danger">Cập nhật mật khẩu</button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success d-inline-block ms-3 mb-0 py-2">
                    Đã cập nhật mật khẩu!
                </div>
            @endif
        </div>
    </form>
</section>