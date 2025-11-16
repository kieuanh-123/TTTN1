<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Auth; // Import Auth
use Illuminate\Support\Str; // Import Str


class GoogleController extends Controller
{
    public function index()
    {
        // Your logic to handle Google Sheets data
        // For example, you can use the Google Sheets API to fetch data
        // and return it to a view or process it as needed.
        return Socialite::driver('google')->redirect();

    }

    public function callback(Request $request)
    {
        // Người dùng từ chối, không có code
        if ($request->has('error')) {
            return redirect('/login')->with('error', 'Bạn đã hủy đăng nhập Google.');
        }

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Lấy role_id cho student (role_id = 2)
            $studentRole = \App\Models\Role::where('name', 'user')->first();
            $roleId = $studentRole ? $studentRole->id : 2;

            // Tìm user theo email hoặc google_id
            $user = User::where('email', $googleUser->email)
                ->orWhere('google_id', $googleUser->id)
                ->first();

            if ($user) {
                // User đã tồn tại, cập nhật thông tin
                $user->update([
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'email_verified_at' => $user->email_verified_at ?? now(),
                    'role_id' => $user->role_id ?? $roleId, // Giữ role_id cũ nếu có, nếu không thì gán student
                ]);
            } else {
                // Tạo user mới
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)), // Tạo mật khẩu ngẫu nhiên
                    'role_id' => $roleId, // Gán role student
                    'email_verified_at' => now(), // Tự động verify email khi đăng ký qua Google
                ]);
            }

            Auth::login($user);

            // Điều hướng theo role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
            } else {
                return redirect()->route('student.dashboard')->with('success', 'Đăng nhập thành công!');
            }

        } catch (\Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Đăng nhập Google thất bại: ' . $e->getMessage());
        }
    }
}   
