<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            // Đã verify rồi, redirect theo role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('verified', true);
            } else {
                return redirect()->route('student.dashboard')->with('verified', true);
            }
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Sau khi verify, redirect theo role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('verified', true);
        } else {
            return redirect()->route('student.dashboard')->with('verified', true);
        }
    }
}
