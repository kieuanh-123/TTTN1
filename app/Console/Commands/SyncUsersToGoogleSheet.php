<?php 
namespace App\Console\Commands; 
use Illuminate\Console\Command; 
use Google_Client; 
use Google_Service_Sheets; 
use Google_Service_Sheets_ValueRange; 
use App\Models\User; 
class SyncUsersToGoogleSheet extends Command 
{ 
    protected $signature = 'users:sync-sheet'; 
    protected $description = 'Đồng bộ toàn bộ danh sách User lên Google Sheet'; 
    public function handle() 
    { 
        $this->info('Đang đồng bộ người dùng lên Google Sheet...'); 
        $client = new Google_Client(); 
        $client->setAuthConfig(storage_path('app/google/google-sheets-credentials.json')); 
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]); 
        $service = new Google_Service_Sheets($client); 
        $spreadsheetId = env('GOOGLE_SHEET_ID'); // ví dụ: '12wTx3eOlu2KVcOjrKMYTfYhTPjYVHW1N1T5ZlmFjStY' 
        $range = 'sheet1'; // Sheet tên 'Users', bắt đầu từ A1 
        $users = User::all(['name', 'email', 'created_at']); 
        $values = []; $values[] = ['Họ tên', 'Email', 'Ngày đăng ký']; 
        foreach ($users as $user) 
        { 
            $values[] = [$user->name,
             $user->email,
              $user->created_at->format('Y-m-d H:i:s')]; 
            } 
            $body = new Google_Service_Sheets_ValueRange([ 'values' => $values ]); 
            $params = ['valueInputOption' => 'RAW']; 
            try { $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params); 
                $this->info('Đồng bộ thành công!'); 
            } 
            catch (\Exception $e) { 
                $this->error('Lỗi khi đồng bộ: ' . $e->getMessage()); 
            } 
        return 0; 
    } 
} 