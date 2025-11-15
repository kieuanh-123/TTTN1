<section>
    <p class="text-muted mb-4">
        Cập nhật thông tin cá nhân và địa chỉ email của bạn.
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"  style="background-color:rgb(232, 237, 241);">Email</label>
             <input type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    readonly
                    style="background-color: #e9ecef;">
           
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <p class="mb-0">
                        Email của bạn chưa được xác thực.
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            Nhấn vào đây để gửi lại email xác thực.
                        </button>
                    </p>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2">
                        Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-danger">Lưu thay đổi</button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success d-inline-block ms-3 mb-0 py-2">
                    Đã lưu thành công!
                </div>
            @endif
        </div>
    </form>
</section>