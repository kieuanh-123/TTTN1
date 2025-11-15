<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use App\Mail\RegistrationNotification;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    /**
     * Hiển thị form đăng ký
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('registration-form');
    }

    /**
     * Gửi mã xác thực đến email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        // Tạo mã xác thực ngẫu nhiên 6 chữ số
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = $request->email;

        // Lưu mã xác thực vào database
        VerificationCode::updateOrCreate(
            ['email' => $email],
            [
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(10) // Mã hết hạn sau 10 phút
            ]
        );

        // Gửi email chứa mã xác thực
        try {
            Mail::to($email)->send(new VerificationCodeMail($code));

            return response()->json([
                'success' => true,
                'message' => 'Mã xác thực đã được gửi đến email của bạn'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi email xác thực. Vui lòng thử lại sau.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xác thực mã code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->email;
        $code = $request->verification_code;

        // Kiểm tra mã xác thực
        $verificationData = VerificationCode::where('email', $email)
            ->where('code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verificationData) {
            return response()->json([
                'success' => false,
                'message' => 'Mã xác thực không hợp lệ hoặc đã hết hạn'
            ], 422);
        }

        // Đánh dấu là đã xác thực
        $verificationData->update(['verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Xác thực email thành công'
        ]);
    }

    /**
     * Xử lý đăng ký
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'registration_type' => 'required|string|in:consultation,class,both',
            'class_type' => 'nullable|string|max:100',
            'preferred_time' => 'nullable|string|max:100',
            'note' => 'nullable|string|max:1000',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Kiểm tra xem email đã được xác thực chưa
        $verificationData = VerificationCode::where('email', $request->email)
            ->where('verified', true)
            ->first();

        if (!$verificationData) {
            return back()
                ->with('error', 'Email chưa được xác thực. Vui lòng xác thực email trước khi đăng ký.')
                ->withInput();
        }

        // Tạo mã đăng ký ngẫu nhiên
        $registrationCode = 'REG-' . strtoupper(Str::random(8));

        // Lưu thông tin đăng ký vào database
        $registration = Registration::create([
            'registration_code' => $registrationCode,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'registration_type' => $request->registration_type,
            'class_type' => $request->class_type,
            'preferred_time' => $request->preferred_time,
            'note' => $request->note,
            'status' => 'pending', // Trạng thái mặc định là đang chờ xử lý
        ]);

        // Gửi email thông báo cho quản trị viên
        try {
            $adminEmail = config('mail.admin_email', 'admin@karatetma.com');
            Mail::to($adminEmail)->send(new RegistrationNotification($registration));
        } catch (\Exception $e) {
            // Log lỗi nhưng vẫn tiếp tục xử lý
            \Log::error('Không thể gửi email thông báo: ' . $e->getMessage());
        }

        // Chuyển hướng đến trang cảm ơn với thông báo thành công
        return redirect()->route('registration.thank-you')
            ->with('registration_code', $registrationCode)
            ->with('success', 'Đăng ký thành công! Mã đăng ký của bạn là: ' . $registrationCode);
    }

    /**
     * Hiển thị trang cảm ơn sau khi đăng ký thành công
     *
     * @return \Illuminate\View\View
     */
    public function thankYou()
    {
        if (!session('registration_code')) {
            return redirect()->route('registration.form');
        }

        return view('registration-thank-you');
    }
}
