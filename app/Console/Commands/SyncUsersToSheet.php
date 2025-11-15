<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\GoogleSheetService;

class SyncUsersToSheet extends Command
{
    protected $signature   = 'users:sync-to-sheet';
    protected $description = 'Đồng bộ danh sách người dùng vào Google Sheet';

    public function handle(GoogleSheetService $sheetService): void
    {
        $this->info('⏳ Đang lấy danh sách người dùng...');
        $users = User::all(['id', 'name', 'email', 'created_at']);

        // Chuẩn bị header + data
        $rows = [
            ['ID', 'Họ Tên', 'Email', 'Ngày đăng ký'],
        ];
        foreach ($users as $u) {
            $rows[] = [
                $u->id,
                $u->name,
                $u->email,
                $u->created_at->toDateTimeString(),
            ];
        }

        // Ghi lên Sheet
        $sheetService->writeAll($rows);

        $this->info('✅ Đã đồng bộ ' . count($rows) - 1 . ' người dùng lên Google Sheet.');
    }
}
