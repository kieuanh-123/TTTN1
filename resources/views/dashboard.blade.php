@extends('layouts.main')

@section('title', 'Đăng Ký Tư Vấn & Lớp Học')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">Đăng Ký Tư Vấn & Lớp Học</h1>
                <p class="lead text-muted">Điền thông tin bên dưới để đăng ký tư vấn hoặc tham gia lớp học võ thuật tại Karate TMA</p>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-danger text-white p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-plus fa-2x me-3"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">Thông Tin Đăng Ký</h4>
                            <p class="mb-0 opacity-75">Vui lòng điền đầy đủ thông tin bên dưới</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="registrationForm" method="POST" action="{{ route('registration.submit') }}">
                        @csrf
                        
                        <!-- Step 1: Email Verification (Initially Visible) -->
                        <div id="step1" class="form-step">
                            <h5 class="border-bottom pb-2 mb-4">Bước 1: Xác Thực Email</h5>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Nhập địa chỉ email của bạn" value="{{ old('email') }}" required>
                                    <button type="button" id="sendVerificationBtn" class="btn btn-primary">Gửi mã</button>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Chúng tôi sẽ gửi mã xác thực đến email này</div>
                            </div>
                            
                            <div class="mb-4 verification-code-container d-none">
                                <label for="verification_code" class="form-label fw-medium">Mã Xác Thực <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-key"></i></span>
                                    <input type="text" class="form-control @error('verification_code') is-invalid @enderror" id="verification_code" name="verification_code" placeholder="Nhập mã xác thực" maxlength="6">
                                    <button type="button" id="verifyCodeBtn" class="btn btn-success">Xác thực</button>
                                </div>
                                @error('verification_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="form-text">Nhập mã 6 chữ số đã được gửi đến email của bạn</div>
                                    <div class="verification-timer text-danger d-none">
                                        <small>Gửi lại sau: <span id="timer">60</span>s</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" id="goToStep2Btn" class="btn btn-primary d-none">
                                    Tiếp tục <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 2: Personal Information (Initially Hidden) -->
                        <div id="step2" class="form-step d-none">
                            <h5 class="border-bottom pb-2 mb-4">Bước 2: Thông Tin Cá Nhân</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label fw-medium">Họ và tên <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" placeholder="Nhập họ và tên" value="{{ old('fullname') }}" required>
                                    </div>
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone') }}" required>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label fw-medium">Ngày sinh</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}">
                                    </div>
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label fw-medium">Giới tính</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-venus-mars"></i></span>
                                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                            <option value="" selected disabled>Chọn giới tính</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label fw-medium">Địa chỉ</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Nhập địa chỉ" value="{{ old('address') }}">
                                </div>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" id="backToStep1Btn" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                                </button>
                                <button type="button" id="goToStep3Btn" class="btn btn-primary">
                                    Tiếp tục <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 3: Class Information (Initially Hidden) -->
                        <div id="step3" class="form-step d-none">
                            <h5 class="border-bottom pb-2 mb-4">Bước 3: Thông Tin Lớp Học</h5>
                            
                            <div class="mb-3">
                                <label for="registration_type" class="form-label fw-medium">Loại đăng ký <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-clipboard-list"></i></span>
                                    <select class="form-select @error('registration_type') is-invalid @enderror" id="registration_type" name="registration_type" required>
                                        <option value="" selected disabled>Chọn loại đăng ký</option>
                                        <option value="consultation" {{ old('registration_type') == 'consultation' ? 'selected' : '' }}>Đăng ký tư vấn</option>
                                        <option value="class" {{ old('registration_type') == 'class' ? 'selected' : '' }}>Đăng ký lớp học</option>
                                        <option value="both" {{ old('registration_type') == 'both' ? 'selected' : '' }}>Cả hai</option>
                                    </select>
                                </div>
                                @error('registration_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 class-options d-none">
                                <label for="class_type" class="form-label fw-medium">Loại lớp học</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-fist-raised"></i></span>
                                    <select class="form-select @error('class_type') is-invalid @enderror" id="class_type" name="class_type">
                                        <option value="" selected disabled>Chọn loại lớp học</option>
                                        <option value="kids" {{ old('class_type') == 'kids' ? 'selected' : '' }}>Karate Thiếu nhi (4-12 tuổi)</option>
                                        <option value="teens" {{ old('class_type') == 'teens' ? 'selected' : '' }}>Karate Thiếu niên (13-17 tuổi)</option>
                                        <option value="adults" {{ old('class_type') == 'adults' ? 'selected' : '' }}>Karate Người lớn (18+ tuổi)</option>
                                        <option value="advanced" {{ old('class_type') == 'advanced' ? 'selected' : '' }}>Lớp nâng cao</option>
                                        <option value="private" {{ old('class_type') == 'private' ? 'selected' : '' }}>Học riêng</option>
                                    </select>
                                </div>
                                @error('class_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 class-options d-none">
                                <label for="preferred_time" class="form-label fw-medium">Thời gian học mong muốn</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-clock"></i></span>
                                    <select class="form-select @error('preferred_time') is-invalid @enderror" id="preferred_time" name="preferred_time">
                                        <option value="" selected disabled>Chọn thời gian học</option>
                                        <option value="morning" {{ old('preferred_time') == 'morning' ? 'selected' : '' }}>Buổi sáng (8:00 - 11:00)</option>
                                        <option value="afternoon" {{ old('preferred_time') == 'afternoon' ? 'selected' : '' }}>Buổi chiều (14:00 - 17:00)</option>
                                        <option value="evening" {{ old('preferred_time') == 'evening' ? 'selected' : '' }}>Buổi tối (18:00 - 21:00)</option>
                                        <option value="weekend" {{ old('preferred_time') == 'weekend' ? 'selected' : '' }}>Cuối tuần</option>
                                    </select>
                                </div>
                                @error('preferred_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="note" class="form-label fw-medium">Ghi chú</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-comment"></i></span>
                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Nhập thông tin bổ sung hoặc yêu cầu đặc biệt">{{ old('note') }}</textarea>
                                </div>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    Tôi đồng ý với <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">điều khoản và điều kiện</a> của Karate TMA
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" id="backToStep2Btn" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-paper-plane me-1"></i> Hoàn tất đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Information Cards -->
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3">
                                <i class="fas fa-headset fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Tư Vấn Miễn Phí</h5>
                            <p class="text-muted mb-0">Đội ngũ tư vấn viên chuyên nghiệp sẽ liên hệ với bạn trong vòng 24 giờ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-flex mb-3">
                                <i class="fas fa-calendar-check fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold">Học Thử Miễn Phí</h5>
                            <p class="text-muted mb-0">Đăng ký ngay để được tham gia buổi học thử miễn phí với các huấn luyện viên</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-flex mb-3">
                                <i class="fas fa-medal fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Chứng Chỉ Quốc Tế</h5>
                            <p class="text-muted mb-0">Học viên sẽ được cấp chứng chỉ quốc tế sau khi hoàn thành khóa học</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="termsModalLabel">Điều Khoản và Điều Kiện</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold">1. Đăng Ký và Thanh Toán</h6>
                <p>Học viên cần thanh toán học phí đầy đủ trước khi tham gia lớp học. Học phí đ�� thanh toán không được hoàn lại trừ trường hợp đặc biệt được xem xét bởi ban quản lý.</p>
                
                <h6 class="fw-bold">2. Quy Định Lớp Học</h6>
                <p>Học viên cần tuân thủ nội quy lớp học, tôn trọng huấn luyện viên và các học viên khác. Đi học đúng giờ và tham gia đầy đủ các buổi học.</p>
                
                <h6 class="fw-bold">3. Trang Phục và Thiết Bị</h6>
                <p>Học viên cần mặc trang phục phù hợp (võ phục) khi tham gia lớp học. Trung tâm có cung cấp võ phục với chi phí riêng.</p>
                
                <h6 class="fw-bold">4. Sức Khỏe và An Toàn</h6>
                <p>Học viên cần đảm bảo sức khỏe tốt khi tham gia lớp học. Trung tâm không chịu trách nhiệm về các chấn thương xảy ra trong quá trình tập luyện nếu học viên không tuân thủ hướng dẫn của huấn luyện viên.</p>
                
                <h6 class="fw-bold">5. Bảo Mật Thông Tin</h6>
                <p>Trung tâm cam kết bảo mật thông tin cá nhân của học viên và chỉ sử dụng cho mục đích liên quan đến hoạt động của trung tâm.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="acceptTermsBtn">Tôi đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const sendVerificationBtn = document.getElementById('sendVerificationBtn');
    const verifyCodeBtn = document.getElementById('verifyCodeBtn');
    const goToStep2Btn = document.getElementById('goToStep2Btn');
    const backToStep1Btn = document.getElementById('backToStep1Btn');
    const goToStep3Btn = document.getElementById('goToStep3Btn');
    const backToStep2Btn = document.getElementById('backToStep2Btn');
    const verificationCodeContainer = document.querySelector('.verification-code-container');
    const verificationTimer = document.querySelector('.verification-timer');
    const timerElement = document.getElementById('timer');
    const registrationType = document.getElementById('registration_type');
    const classOptions = document.querySelectorAll('.class-options');
    const acceptTermsBtn = document.getElementById('acceptTermsBtn');
    const termsCheckbox = document.getElementById('terms');
    
    // Timer variables
    let countdown;
    let secondsLeft = 60;
    
    // Send verification code
    sendVerificationBtn.addEventListener('click', function() {
        const email = document.getElementById('email').value;
        if (!email || !isValidEmail(email)) {
            alert('Vui lòng nhập địa chỉ email hợp lệ');
            return;
        }
        
        // Simulate sending verification code
        sendVerificationBtn.disabled = true;
        sendVerificationBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang gửi...';
        
        setTimeout(function() {
            verificationCodeContainer.classList.remove('d-none');
            verificationTimer.classList.remove('d-none');
            sendVerificationBtn.innerHTML = 'Gửi lại mã';
            startTimer();
            
            // Show success message
            alert('Mã xác thực đã được gửi đến email của bạn');
        }, 1500);
    });
    
    // Verify code
    verifyCodeBtn.addEventListener('click', function() {
        const code = document.getElementById('verification_code').value;
        if (!code || code.length !== 6) {
            alert('Vui lòng nhập mã xác thực 6 chữ số');
            return;
        }
        
        // Simulate verification
        verifyCodeBtn.disabled = true;
        verifyCodeBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xác thực...';
        
        setTimeout(function() {
            verifyCodeBtn.innerHTML = '<i class="fas fa-check"></i> Đã xác thực';
            verifyCodeBtn.classList.remove('btn-success');
            verifyCodeBtn.classList.add('btn-outline-success');
            document.getElementById('email').readOnly = true;
            document.getElementById('verification_code').readOnly = true;
            goToStep2Btn.classList.remove('d-none');
            
            // Show success message
            alert('Xác thực email thành công');
        }, 1500);
    });
    
    // Navigation between steps
    goToStep2Btn.addEventListener('click', function() {
        step1.classList.add('d-none');
        step2.classList.remove('d-none');
    });
    
    backToStep1Btn.addEventListener('click', function() {
        step2.classList.add('d-none');
        step1.classList.remove('d-none');
    });
    
    goToStep3Btn.addEventListener('click', function() {
        // Validate required fields in step 2
        const fullname = document.getElementById('fullname').value;
        const phone = document.getElementById('phone').value;
        
        if (!fullname) {
            alert('Vui lòng nhập họ và tên');
            return;
        }
        
        if (!phone) {
            alert('Vui lòng nhập số điện thoại');
            return;
        }
        
        step2.classList.add('d-none');
        step3.classList.remove('d-none');
    });
    
    backToStep2Btn.addEventListener('click', function() {
        step3.classList.add('d-none');
        step2.classList.remove('d-none');
    });
    
    // Show/hide class options based on registration type
    registrationType.addEventListener('change', function() {
        if (this.value === 'class' || this.value === 'both') {
            classOptions.forEach(option => option.classList.remove('d-none'));
        } else {
            classOptions.forEach(option => option.classList.add('d-none'));
        }
    });
    
    // Accept terms from modal
    acceptTermsBtn.addEventListener('click', function() {
        termsCheckbox.checked = true;
    });
    
    // Timer function
    function startTimer() {
        secondsLeft = 60;
        timerElement.textContent = secondsLeft;
        
        clearInterval(countdown);
        countdown = setInterval(function() {
            secondsLeft--;
            timerElement.textContent = secondsLeft;
            
            if (secondsLeft <= 0) {
                clearInterval(countdown);
                sendVerificationBtn.disabled = false;
            }
        }, 1000);
    }
    
    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
</script>

<style>
.form-step {
    transition: all 0.3s ease;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #D10A10;
    box-shadow: 0 0 0 0.25rem rgba(209, 10, 16, 0.25);
}

.form-check-input:checked {
    background-color: #D10A10;
    border-color: #D10A10;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.rounded-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
}

@media (max-width: 768px) {
    .rounded-circle {
        width: 50px;
        height: 50px;
    }
}
</style>
@endsection
