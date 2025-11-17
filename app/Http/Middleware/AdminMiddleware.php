<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
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
            'role_name' => $user->role->name ?? null,
            'isAdmin()' => $user->isAdmin(),
        ]);

        // Kiểm tra quyền admin dựa vào isAdmin() thay vì role_id cứng
        if (!$user->isAdmin()) {
            \Log::warning('Admin access denied', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'role_name' => $user->role->name ?? null,
            ]);

            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
