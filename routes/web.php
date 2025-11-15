<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorAdminController;
use App\Http\Controllers\ClassAdminController;
use App\Http\Controllers\NewsAdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Thêm các route còn thiếu
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/classes', [ClassController::class, 'index'])->name('classes');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Xóa route trùng lặp này
// Route::get('/admin', function () {
//     return view('admin.dashboard'); 
// });

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // User management
    Route::resource('users', UserController::class);
    
    // Banner management
    Route::resource('banners', BannerController::class);
    
    // News management
    Route::resource('news', NewsAdminController::class);
    
    // Classes management
    Route::resource('classes', ClassAdminController::class);
    
    // Instructors management
    Route::resource('instructors', InstructorAdminController::class);
});


Route::get('/add-user-to-sheet', function () {
    $client = new \Google_Client();
    $client->setAuthConfig(storage_path('app/google/google-sheets-credentials.json'));
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

    $service = new \Google_Service_Sheets($client);

    $spreadsheetId = env('GOOGLE_SHEET_ID'); // Sheet ID
    $range = 'Sheet1!A1'; // Sheet name và ô bắt đầu ghi
    $values = [
        ["Kiều Anh Thiên", "thien@example.com", now()->toDateTimeString()]
    ];
    $body = new \Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

    return 'Dữ liệu đã ghi thành công. Số ô ghi: ' . $result->getUpdates()->getUpdatedCells();
});


use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleSheetsController;

Route::get('redirect-google', [GoogleController::class, 'index'])->name('redirect-google');
Route::get('callback-google', [GoogleController::class, 'callback'])->name('callback-google'); 

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth-facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'redirectToFacebookCallback']);

//dang ky nhan tu van or lop hoc

use App\Http\Controllers\RegistrationController;
Route::post('/register', [RegistrationController::class, 'submit'])->name('registration.submit');


// Route cho trang đăng ký
Route::get('/dang-ky', [RegistrationController::class, 'showForm'])->name('registration.form');
Route::post('/dang-ky/gui-ma-xac-thuc', [RegistrationController::class, 'sendVerificationCode'])->name('registration.send-code');
Route::post('/dang-ky/xac-thuc-ma', [RegistrationController::class, 'verifyCode'])->name('registration.verify-code');
Route::post('/dang-ky', [RegistrationController::class, 'submit'])->name('registration.submit');
Route::get('/dang-ky/cam-on', [RegistrationController::class, 'thankYou'])->name('registration.thank-you');

use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\TwoFactorCodeController;
Route::get('2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');
