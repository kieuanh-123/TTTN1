<?php
namespace App\Services;

use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetService
{
    protected string $sheetId;
    protected string $sheetName;

    public function __construct()
    {
        $this->sheetId   = config('services.google.sheet_id');
        $this->sheetName = config('services.google.sheet_name');
    }

    /**
     * Ghi đè toàn bộ dữ liệu (xóa sạch + ghi mới)
     */
    public function writeAll(array $rows): void
    {
        Sheets::spreadsheet($this->sheetId)
            ->sheet($this->sheetName)
            ->clear()
            ->append($rows);
    }

    /**
     * Thêm 1 dòng mới vào cuối sheet
     */
    public function appendRow(array $row): void
    {
        Sheets::spreadsheet($this->sheetId)
            ->sheet($this->sheetName)
            ->append([$row]);
    }
}
