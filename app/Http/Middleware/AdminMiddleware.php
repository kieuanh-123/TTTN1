<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra user đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để truy cập trang này.');
        }

        $user = Auth::user();

        // Debug logging
        \Log::info('AdminMiddleware check', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role_id' => $user->role_id,
            'role_id_type' => gettype($user->role_id),
            'isAdmin()' => $user->isAdmin(),
        ]);

        // Kiểm tra role_id có tồn tại và là admin (role_id = 1)
        // Sử dụng strict comparison để đảm bảo chính xác
        if (!$user->role_id || (int)$user->role_id !== 1) {
            \Log::warning('Admin access denied', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role_id' => $user->role_id,
            ]);
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}