<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        
        // Log để debug
        \Log::info('User login', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role_id' => $user->role_id,
            'role_name' => $user->role->name ?? null,
            'isAdmin()' => $user->isAdmin(),
        ]);
        
        // Điều hướng trực tiếp theo role - KHÔNG dùng intended() để tránh redirect về URL cũ
        if ($user->isAdmin()) {
            \Log::info('Redirecting admin to admin.dashboard');
            return redirect()->route('admin.dashboard');
        } else {
            // Student cần verify email trước khi vào dashboard
            if (!$user->hasVerifiedEmail()) {
                \Log::info('Student email not verified, redirecting to verification notice');
                return redirect()->route('verification.notice');
            }
            \Log::info('Redirecting student to student.dashboard');
            return redirect()->route('student.dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
