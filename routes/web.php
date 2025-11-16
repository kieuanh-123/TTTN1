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

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/classes', [ClassController::class, 'index'])->name('classes');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Redirect based on user role
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Student Dashboard
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/classes', [\App\Http\Controllers\Student\DashboardController::class, 'classes'])->name('classes');
        Route::get('/classes/{class}/lessons', [\App\Http\Controllers\Student\LessonController::class, 'index'])->name('classes.lessons');
        Route::get('/lessons/{lesson}', [\App\Http\Controllers\Student\LessonController::class, 'show'])->name('lessons.show');
        Route::post('/lessons/{lesson}/complete', [\App\Http\Controllers\Student\LessonController::class, 'complete'])->name('lessons.complete');
        Route::get('/progress', [\App\Http\Controllers\Student\DashboardController::class, 'progress'])->name('progress');
    });
    
    // Payment routes
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/orders/{order}', [\App\Http\Controllers\PaymentController::class, 'show'])->name('show');
        Route::post('/orders/{order}/pay', [\App\Http\Controllers\PaymentController::class, 'pay'])->name('pay');
        Route::get('/upload-proof/{payment}', [\App\Http\Controllers\PaymentController::class, 'showUploadForm'])->name('upload-proof');
        Route::post('/upload-proof/{payment}', [\App\Http\Controllers\PaymentController::class, 'uploadProof'])->name('upload-proof.post');
    });
    
    // Testimonials
    Route::post('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
});

require __DIR__.'/auth.php';

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
    
    // Orders management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::post('orders/{order}/approve', [\App\Http\Controllers\Admin\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('orders/{order}/reject', [\App\Http\Controllers\Admin\OrderController::class, 'reject'])->name('orders.reject');
    
    // Payments management
    Route::resource('payments', \App\Http\Controllers\Admin\PaymentController::class);
    Route::post('payments/{payment}/confirm', [\App\Http\Controllers\Admin\PaymentController::class, 'confirm'])->name('payments.confirm');
    
    // Enrollments management
    Route::resource('enrollments', \App\Http\Controllers\Admin\EnrollmentController::class);
    Route::post('enrollments/{enrollment}/approve', [\App\Http\Controllers\Admin\EnrollmentController::class, 'approve'])->name('enrollments.approve');
    Route::post('enrollments/{enrollment}/cancel', [\App\Http\Controllers\Admin\EnrollmentController::class, 'cancel'])->name('enrollments.cancel');
    
    // Lessons management
    Route::resource('lessons', \App\Http\Controllers\Admin\LessonController::class);
    Route::post('lessons/{lesson}/publish', [\App\Http\Controllers\Admin\LessonController::class, 'publish'])->name('lessons.publish');
    
    // Class Sessions management
    Route::resource('sessions', \App\Http\Controllers\Admin\ClassSessionController::class);
    
    // Attendance management
    Route::resource('attendances', \App\Http\Controllers\Admin\AttendanceController::class);
    Route::get('sessions/{session}/attendances', [\App\Http\Controllers\Admin\AttendanceController::class, 'show'])->name('attendances.show-session');
    Route::post('sessions/{session}/attendances/bulk', [\App\Http\Controllers\Admin\AttendanceController::class, 'bulkCheck'])->name('attendances.bulk');
    
    // Testimonials management
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    Route::post('testimonials/{testimonial}/approve', [\App\Http\Controllers\Admin\TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::post('testimonials/{testimonial}/reject', [\App\Http\Controllers\Admin\TestimonialController::class, 'reject'])->name('testimonials.reject');
});

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleSheetsController;

Route::get('redirect-google', [GoogleController::class, 'index'])->name('redirect-google');
Route::get('callback-google', [GoogleController::class, 'callback'])->name('callback-google'); 

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth-facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'redirectToFacebookCallback']);

use App\Http\Controllers\RegistrationController;

Route::get('/dang-ky', [RegistrationController::class, 'showForm'])->name('registration.form');
Route::post('/dang-ky/gui-ma-xac-thuc', [RegistrationController::class, 'sendVerificationCode'])->name('registration.send-code');
Route::post('/dang-ky/xac-thuc-ma', [RegistrationController::class, 'verifyCode'])->name('registration.verify-code');
Route::post('/dang-ky', [RegistrationController::class, 'submit'])->name('registration.submit');
Route::get('/dang-ky/cam-on', [RegistrationController::class, 'thankYou'])->name('registration.thank-you');

use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\TwoFactorCodeController;
Route::get('2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');
