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

        $user = User::updateOrCreate(
            ['facebook_id' => $fb->getId()],
            [
                'name'     => $fb->getName(),
                'email'    => $email,
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
    catch (\Throwable $e) {
        return redirect('/login')
            ->with('error', 'Đăng nhập Facebook thất bại: ' . $e->getMessage());
    }
    }
}
