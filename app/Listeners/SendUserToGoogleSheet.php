<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\GoogleSheetService;

class SendUserToGoogleSheet implements ShouldQueue
{
    public function handle(Registered $event)
    {
        Log::info('SendUserToGoogleSheet handle called');

       try {
        $user = $event->user;

        // Gửi dữ liệu lên Google Sheet
        app(\App\Services\GoogleSheetService::class)->appendRow([
            $user->name,
            $user->email,
            now()->toDateTimeString(),
        ]);
        } catch (\Throwable $e) {
        // Ghi log lỗi
        Log::error('Google Sheet Error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
    }
    }
}
