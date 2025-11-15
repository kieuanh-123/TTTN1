<!-- resources/views/auth/verify-email.blade.php -->
<x-guest-layout>
    <div class="mb-4">
        {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết chúng tôi vừa gửi cho bạn qua email không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi cho bạn một email khác.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp khi đăng ký.') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn btn-primary">
                {{ __('Gửi lại email xác minh') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn-link">
                {{ __('Đăng xuất') }}
            </button>
        </form>
    </div>
</x-guest-layout>