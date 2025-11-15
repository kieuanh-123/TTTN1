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

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)), // Tạo mật khẩu ngẫu nhiên
            ]);

            Auth::login($user);

            return redirect('/home')->with('success', 'Đăng nhập thành công!');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập Google thất bại: ' . $e->getMessage());
        }
    }
}   
