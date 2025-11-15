<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

//UsersSyncSheet

class Kernel extends ConsoleKernel
{
    /**
     * Đăng ký các lệnh Artisan tùy chỉnh.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\UsersSyncSheet::class,
    ];

    /**
     * Xác định lịch trình các tác vụ Artisan.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('users:sync-sheet')->dailyAt('02:00');
    }

    /**
     * Đăng ký các route lệnh console.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
