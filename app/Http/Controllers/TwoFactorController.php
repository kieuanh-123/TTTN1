<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\TwoFactorCode;
use App\Notifications\TwoFactorCodeNotification;

class TwoFactorController extends Controller
{
    // Hiển thị form nhập mã và gửi mã (nếu cần)
    public function index()
    {
        $user = Auth::user();
        // Tạo mã ngẫu nhiên 6 chữ số
        $code = rand(100000, 999999);
        // Lưu hoặc cập nhật mã cho user
        TwoFactorCode::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code]
        );
        // Gửi mã qua email
        $user->notify(new TwoFactorCodeNotification($code));
        // Hiển thị trang nhập mã
        return view('auth.two-factor');
    }

    // Xác minh mã người dùng nhập
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        $userId = Auth::id();
        // Tìm bản ghi mã hợp lệ (mã đúng và không quá 10 phút)
        $twoFactor = TwoFactorCode::where('user_id', $userId)
                      ->where('code', $request->code)
                      ->where('updated_at', '>=', now()->subMinutes(10))
                      ->first();
        if ($twoFactor) {
            // Đánh dấu đã xác thực 2FA (thêm vào session)
            Session::put('2fa_passed', true);
            // Xóa mã đã dùng
            $twoFactor->delete();
            // Chuyển hướng đến trang chính
            return redirect()->route('home');
        }
        // Nếu sai mã
        return back()->withErrors(['code' => 'Mã xác thực không hợp lệ.']);
    }

    // Gửi lại mã mới (nếu có nút "Gửi lại mã")
    public function resend()
    {
        $user = Auth::user();
        $code = rand(100000, 999999);
        TwoFactorCode::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code]
        );
        $user->notify(new TwoFactorCodeNotification($code));
        return back()->with('status', 'Đã gửi lại mã xác thực.');
    }
}

