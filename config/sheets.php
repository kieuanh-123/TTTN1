<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default spreadsheet driver
    |--------------------------------------------------------------------------
    | Nếu bạn chỉ dùng service account, giữ nguyên 'service_account'.
    */
    'default' => env('SHEETS_DRIVER', 'service_account'),

    /*
    |--------------------------------------------------------------------------
    | Service Account Credentials
    |--------------------------------------------------------------------------
    | Đường dẫn tới JSON của Service Account
    */
    'service_account' => [
        'file' => env('GOOGLE_SHEETS_CREDENTIALS'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Spreadsheet ID và tên sheet mặc định
    |--------------------------------------------------------------------------
    */
    'spreadsheet' => [
        'id'   => env('GOOGLE_SHEET_ID'),
        'name' => env('GOOGLE_SHEET_NAME', 'Users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache (nếu cần)
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled' => false,
        // 'store'   => 'file',
        // 'expire'  => 3600,
    ],

];
