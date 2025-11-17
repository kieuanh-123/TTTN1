<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
      return Socialite::driver('facebook')
        ->scopes(['email'])
        ->fields(['name', 'email', 'picture.width(200)'])
        ->redirect();
    }

    public function redirectToFacebookCallback(Request $request)
    {
       if ($request->has('error')) {
        return redirect('/login')
            ->with('error', 'Bạn đã hủy đăng nhập Facebook.');
    }

    try {
        $fb = Socialite::driver('facebook')->user();

        // Nếu không có email, sinh email giả (dạng facebook_id@yourapp.local)
        $email = $fb->getEmail()
            ?? $fb->getId() . '@facebook.local';

        // Lấy role cho student theo name
        $studentRole = \App\Models\Role::where('name', 'user')->first();
        $roleId = $studentRole?->id;

        // Tìm user theo email hoặc facebook_id
        $user = User::where('email', $email)
            ->orWhere('facebook_id', $fb->getId())
            ->first();

        if ($user) {
            // User đã tồn tại, cập nhật thông tin
            $user->update([
                'name' => $fb->getName(),
                'facebook_id' => $fb->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
                'role_id' => $user->role_id ?? $roleId, // Giữ role cũ nếu có, nếu không thì gán theo name 'user'
            ]);
        } else {
            // Tạo user mới
            $user = User::create([
                'name' => $fb->getName(),
                'email' => $email,
                'facebook_id' => $fb->getId(),
                'password' => bcrypt(Str::random(16)),
                'role_id' => $roleId, // Gán role student theo name
                'email_verified_at' => now(), // Tự động verify email khi đăng ký qua Facebook
            ]);
        }

        Auth::login($user);

        // Điều hướng theo role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
    catch (\Throwable $e) {
        \Log::error('Facebook login error: ' . $e->getMessage());
        return redirect('/login')
            ->with('error', 'Đăng nhập Facebook thất bại: ' . $e->getMessage());
    }
    }
}
