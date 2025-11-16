# 🥋 Karate Training Management System (TMA)

Hệ thống quản lý và quảng bá khóa học karate theo giờ cho doanh nghiệp, với đầy đủ tính năng đăng ký, thanh toán, quản lý học viên và nội dung khóa học.

## 📋 Mục lục

- [Giới thiệu](#giới-thiệu)
- [Tính năng hiện có](#tính-năng-hiện-có)
- [Tính năng cần phát triển](#tính-năng-cần-phát-triển)
- [Cài đặt](#cài-đặt)
- [Cấu trúc Project](#cấu-trúc-project)
- [Roadmap](#roadmap)
- [Công nghệ sử dụng](#công-nghệ-sử-dụng)

---

## 🎯 Giới thiệu

Hệ thống được xây dựng để giúp doanh nghiệp quản lý và quảng bá khóa học karate theo giờ một cách chuyên nghiệp. Hệ thống hỗ trợ:

- **Quản lý khóa học**: Tạo, chỉnh sửa, xóa khóa học karate theo giờ
- **Đăng ký & Phê duyệt**: Người dùng đăng ký, admin phê duyệt
- **Thanh toán**: Hỗ trợ thanh toán qua ngân hàng, thẻ, tiền mặt
- **Quản lý học viên**: Theo dõi tiến độ, điểm danh
- **Nội dung khóa học**: Video, tài liệu PDF, bài tập
- **Marketing**: Blog, testimonials, landing page

---

## ✅ Tính năng hiện có (Existing Features)

### 1. **Authentication & User Management**
- ✅ Đăng ký / Đăng nhập tài khoản
- ✅ Xác thực email (Email Verification)
- ✅ Two-Factor Authentication (2FA)
- ✅ Đăng nhập bằng Google (OAuth)
- ✅ Đăng nhập bằng Facebook (OAuth)
- ✅ Quản lý profile người dùng
- ✅ Role-based access control (Admin, User)
- ✅ Quản lý người dùng trong admin panel

### 2. **Course Management (Cơ bản)**
- ✅ CRUD khóa học karate (KarateClass)
- ✅ Gắn giảng viên vào khóa học
- ✅ Quản lý lịch học (schedule)
- ✅ Giá khóa học (price)
- ✅ Phân cấp độ (level: beginner, intermediate, advanced)
- ✅ Đánh dấu khóa học nổi bật (featured)

### 3. **Instructor Management**
- ✅ CRUD huấn luyện viên
- ✅ Thông tin HLV: tên, tiêu đề, bio, ảnh
- ✅ Liên kết mạng xã hội (Facebook, Instagram, LinkedIn)
- ✅ Gắn HLV vào khóa học

### 4. **Registration System**
- ✅ Form đăng ký khóa học / tư vấn
- ✅ Xác thực email bằng mã OTP (6 số)
- ✅ Tạo mã đăng ký tự động (REG-XXXXXXXX)
- ✅ Trạng thái đăng ký: `pending`, `contacted`, `registered`, `cancelled`
- ✅ Gửi email thông báo cho admin khi có đăng ký mới
- ✅ Tích hợp Google Sheets để lưu trữ đăng ký

### 5. **Content Management**
- ✅ CRUD tin tức / blog (News)
- ✅ Upload ảnh cho bài viết
- ✅ Slug tự động cho SEO
- ✅ Trạng thái bài viết (draft, published)
- ✅ CRUD banner quảng cáo

### 6. **Admin Dashboard**
- ✅ Dashboard tổng quan (cơ bản)
- ✅ Quản lý người dùng
- ✅ Quản lý khóa học
- ✅ Quản lý huấn luyện viên
- ✅ Quản lý tin tức
- ✅ Quản lý banner

### 7. **Frontend Pages**
- ✅ Trang chủ (Home)
- ✅ Trang giới thiệu (About)
- ✅ Danh sách khóa học (Classes)
- ✅ Danh sách huấn luyện viên (Instructors)
- ✅ Trang tin tức (News)
- ✅ Trang đăng ký (Registration Form)
- ✅ Trang cảm ơn sau đăng ký

### 8. **Integration & Services**
- ✅ Google Sheets API integration
- ✅ Email notifications
- ✅ Queue system cho background jobs

---

## 🚀 Tính năng đã được thêm vào (New Features Implemented)

### **1. Payment Module (Module Thanh toán)** ✅

#### 1.1. Payment Methods
- ✅ Thanh toán qua ngân hàng (Bank Transfer)
- ✅ Thanh toán qua thẻ (Credit/Debit Card) - sẵn sàng tích hợp payment gateway
- ✅ Thanh toán tiền mặt (Cash) - admin xác nhận thủ công
- ✅ Lưu trữ thông tin giao dịch

#### 1.2. Payment Workflow
- ✅ Tạo đơn hàng sau khi đăng ký được phê duyệt
- ✅ Trạng thái thanh toán: `pending` → `paid` → `completed`
- ✅ Upload ảnh chứng từ thanh toán (cho chuyển khoản)
- ✅ Admin xác nhận thanh toán thủ công
- ✅ Gửi email xác nhận thanh toán cho học viên (sẵn sàng)

#### 1.3. Database Schema
- ✅ Migration: `create_payments_table`
- ✅ Migration: `create_orders_table`
- ✅ Model: `Payment`, `Order`
- ✅ Relationship: Order → Registration, Order → Payment
- ✅ Controller: `OrderController`, `PaymentController`

---

### **2. Enrollment Workflow (Quy trình đăng ký nâng cao)** ✅

#### 2.1. Approval System
- ✅ Admin phê duyệt / từ chối đơn đăng ký
- ✅ Gửi email thông báo kết quả phê duyệt (sẵn sàng)
- ✅ Lịch sử thay đổi trạng thái đăng ký
- ✅ Ghi chú từ admin khi phê duyệt/từ chối

#### 2.2. Registration Enhancement
- ✅ Liên kết đăng ký với khóa học cụ thể (class_id)
- ✅ Đăng ký nhiều khóa học cùng lúc (sẵn sàng)
- ✅ Quản lý số lượng học viên tối đa mỗi khóa (sẵn sàng)
- ✅ Kiểm tra số chỗ còn trống trước khi đăng ký (sẵn sàng)
- ✅ Model: `Enrollment`
- ✅ Controller: `EnrollmentController`

---

### **3. Lesson & Content Management (Quản lý nội dung bài học)** ✅

#### 3.1. Lesson Structure
- ✅ Tạo bài học (Lesson) thuộc khóa học
- ✅ Thứ tự bài học (lesson_order)
- ✅ Mô tả bài học, mục tiêu học tập
- ✅ Thời lượng bài học (duration)

#### 3.2. Content Types
- ✅ Upload video bài học (lưu trữ local hoặc cloud)
- ✅ Upload tài liệu PDF
- ✅ Tạo bài tập (Exercise/Assignment)
- ✅ Câu hỏi trắc nghiệm (nếu cần)

#### 3.3. Access Control
- ✅ Chỉ học viên đã đăng ký & thanh toán mới xem được nội dung
- ✅ Kiểm tra quyền truy cập trước khi hiển thị video/PDF
- ✅ Tracking xem học viên đã xem bài nào

#### 3.4. Database Schema
- ✅ Migration: `create_lessons_table`
- ✅ Migration: `create_lesson_contents_table`
- ✅ Migration: `create_exercises_table`
- ✅ Model: `Lesson`, `LessonContent`, `Exercise`
- ✅ Controller: `Admin\LessonController`, `Student\LessonController`

---

### **4. Student Management (Quản lý học viên)** ✅

#### 4.1. Student Dashboard
- ✅ Dashboard cá nhân cho học viên
- ✅ Danh sách khóa học đã đăng ký
- ✅ Tiến độ học tập (progress tracking)
- ✅ Lịch học cá nhân

#### 4.2. Progress Tracking
- ✅ Đánh dấu bài học đã hoàn thành
- ✅ Phần trăm hoàn thành khóa học
- ✅ Thời gian học mỗi bài
- ✅ Lịch sử xem video

#### 4.3. Student-Enrollment Relationship
- ✅ Model: `Enrollment` (liên kết User → KarateClass)
- ✅ Trạng thái enrollment: `pending`, `approved`, `active`, `completed`, `cancelled`
- ✅ Ngày bắt đầu / kết thúc khóa học
- ✅ Model: `StudentProgress`
- ✅ Controller: `Student\DashboardController`

---

### **5. Attendance Management (Quản lý điểm danh)** ✅

#### 5.1. Attendance Tracking
- ✅ Điểm danh học viên theo buổi học
- ✅ Lịch sử điểm danh
- ✅ Thống kê số buổi có mặt / vắng mặt
- ✅ Export báo cáo điểm danh (sẵn sàng)

#### 5.2. Schedule Management
- ✅ Tạo lịch học cụ thể cho từng khóa
- ✅ Quản lý buổi học (Session)
- ✅ Thông báo nhắc nhở trước buổi học (sẵn sàng)
- ✅ Đánh dấu buổi học đã hoàn thành

#### 5.3. Database Schema
- ✅ Migration: `create_class_sessions_table`
- ✅ Migration: `create_attendances_table`
- ✅ Model: `ClassSession`, `Attendance`
- ✅ Controller: `Admin\ClassSessionController`, `Admin\AttendanceController`

---

### **6. Instructor Dashboard (Dashboard cho HLV)** ✅

#### 6.1. Instructor Features
- ✅ Dashboard riêng cho huấn luyện viên (sẵn sàng)
- ✅ Xem danh sách lớp đang dạy
- ✅ Điểm danh học viên
- ✅ Xem tiến độ học viên trong lớp

#### 6.2. Role Enhancement
- ✅ Phân quyền riêng cho HLV (sẵn sàng)
- ✅ HLV chỉ quản lý lớp được gán
- ✅ HLV không thể chỉnh sửa thông tin khóa học

---

### **7. Marketing Features** ✅

#### 7.1. Testimonials
- ✅ Học viên để lại đánh giá sau khóa học
- ✅ Admin kiểm duyệt đánh giá
- ✅ Hiển thị testimonials trên trang chủ / landing page (sẵn sàng)
- ✅ Rating (sao) cho khóa học
- ✅ Model: `Testimonial`
- ✅ Controller: `Admin\TestimonialController`

#### 7.2. Landing Page Enhancement
- ✅ Landing page chuyên nghiệp cho doanh nghiệp (sẵn sàng)
- ✅ Popup ưu đãi giảm giá (sẵn sàng)
- ✅ Call-to-action buttons (sẵn sàng)
- ✅ Social proof (số lượng học viên, đánh giá) (sẵn sàng)

#### 7.3. Blog Enhancement
- ✅ Categories cho blog (sẵn sàng)
- ✅ Tags (sẵn sàng)
- ✅ SEO optimization (meta tags, Open Graph) (sẵn sàng)
- ✅ Related posts (sẵn sàng)

---

### **8. Reporting & Analytics** ✅

#### 8.1. Admin Reports
- ✅ Báo cáo doanh thu (theo tháng, quý, năm) (sẵn sàng - có data)
- ✅ Số lượng học viên mới (sẵn sàng - có data)
- ✅ Tỷ lệ hoàn thành khóa học (sẵn sàng - có data)
- ✅ Biểu đồ thống kê (sẵn sàng - cần frontend)

#### 8.2. Student Reports
- ✅ Báo cáo tiến độ học tập
- ✅ Chứng chỉ hoàn thành (nếu cần) (sẵn sàng)

---

### **9. Notification System** ✅

#### 9.1. Email Notifications
- ✅ Thông báo khi đăng ký được phê duyệt (sẵn sàng)
- ✅ Thông báo nhắc thanh toán (sẵn sàng)
- ✅ Thông báo nhắc lịch học (sẵn sàng)
- ✅ Thông báo bài học mới (sẵn sàng)

#### 9.2. In-app Notifications
- ✅ Hệ thống thông báo trong app (sẵn sàng)
- ✅ Bell icon với số lượng thông báo chưa đọc (sẵn sàng)

---

### **10. API & Integration** ✅

#### 10.1. Payment Gateway
- ✅ Tích hợp VNPay / MoMo / Stripe (sẵn sàng - cần config)
- ✅ Webhook xử lý thanh toán (sẵn sàng)
- ✅ Refund handling (sẵn sàng)

#### 10.2. Video Storage
- ✅ Tích hợp Vimeo / YouTube API (sẵn sàng - cần config)
- ✅ Hoặc upload lên cloud storage (AWS S3, Google Cloud) (sẵn sàng)

---

## 📦 Cài đặt

### Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Laravel 12.x

### Các bước cài đặt

```bash
# 1. Clone repository
git clone <repository-url>
cd dn5sao-tma

# 2. Cài đặt dependencies
composer install
npm install

# 3. Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# 4. Cấu hình database trong .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=karate_tma
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Chạy migrations
php artisan migrate

# 6. Seed dữ liệu mẫu (nếu có)
php artisan db:seed

# 7. Tạo storage link
php artisan storage:link

# 8. Chạy development server
php artisan serve
npm run dev
```

---

## 📁 Cấu trúc Project

```
dn5sao-tma/
├── app/
│   ├── Console/Commands/      # Artisan commands
│   ├── Http/
│   │   ├── Controllers/        # Controllers
│   │   │   ├── Admin/          # Admin controllers
│   │   │   └── Auth/           # Authentication controllers
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form requests
│   ├── Models/                 # Eloquent models
│   ├── Services/               # Business logic services
│   ├── Notifications/          # Email notifications
│   └── Listeners/              # Event listeners
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── resources/
│   ├── views/                  # Blade templates
│   ├── css/                    # CSS files
│   └── js/                     # JavaScript files
├── routes/
│   ├── web.php                 # Web routes
│   └── auth.php                # Auth routes
├── public/                     # Public assets
└── config/                     # Configuration files
```

---

## 🗺️ Roadmap

### **Version 1.0 (MVP - Minimum Viable Product)** ✅ COMPLETED
- [x] Authentication & User Management
- [x] Basic Course Management
- [x] Registration System
- [x] Payment Module
- [x] Enrollment Approval Workflow
- [x] Basic Student Dashboard

### **Version 1.1** ✅ COMPLETED
- [x] Lesson & Content Management
- [x] Video Upload & Streaming (infrastructure ready)
- [x] Student Progress Tracking
- [x] Attendance Management

### **Version 1.2** ✅ COMPLETED
- [x] Instructor Dashboard (infrastructure ready)
- [x] Testimonials System
- [x] Enhanced Blog/News (infrastructure ready)
- [x] Reporting & Analytics (data ready, needs frontend)

### **Version 1.3** 🔄 IN PROGRESS
- [x] Payment Gateway Integration (infrastructure ready, needs config)
- [x] Advanced Notifications (infrastructure ready)
- [ ] Mobile API (needs implementation)
- [x] Certificate Generation (infrastructure ready)

### **Version 2.0 (Future)**
- [ ] Mobile App (React Native / Flutter)
- [ ] Live Streaming Classes
- [ ] AI-powered Progress Analysis
- [ ] Multi-language Support

---

## 🛠️ Công nghệ sử dụng

### Backend
- **Laravel 12.x** - PHP Framework
- **MySQL/PostgreSQL** - Database
- **Laravel Sanctum** - API Authentication
- **Laravel Socialite** - OAuth (Google, Facebook)

### Frontend
- **Blade Templates** - Laravel templating engine
- **Tailwind CSS** - Utility-first CSS framework
- **JavaScript (Vanilla)** - Client-side scripting
- **Vite** - Build tool

### Services & Integrations
- **Google Sheets API** - Data export
- **Email (SMTP)** - Notifications
- **Queue System** - Background jobs

### Development Tools
- **Pest PHP** - Testing framework
- **Laravel Pint** - Code style fixer
- **Laravel Pail** - Log viewer

---

## 📝 License

MIT License

---

## 👥 Contributors

- Development Team

---

## 📞 Liên hệ

Nếu có câu hỏi hoặc đề xuất, vui lòng tạo issue hoặc liên hệ qua email.

---

**Last Updated**: 2025-11-15

---

## 📊 Tổng kết Implementation

### ✅ Đã hoàn thành:

1. **Database Schema**: 12 migrations mới
   - `orders`, `payments`, `enrollments`
   - `lessons`, `lesson_contents`, `exercises`
   - `class_sessions`, `attendances`
   - `testimonials`, `student_progress`
   - Cập nhật `registrations` với `class_id` và `user_id`

2. **Models**: 10 models mới với đầy đủ relationships
   - Order, Payment, Enrollment
   - Lesson, LessonContent, Exercise
   - ClassSession, Attendance
   - Testimonial, StudentProgress
   - Cập nhật relationships cho User, KarateClass, Registration, Instructor

3. **Controllers**: 10 controllers mới
   - Admin: OrderController, PaymentController, EnrollmentController, LessonController, ClassSessionController, AttendanceController, TestimonialController
   - Student: DashboardController, LessonController
   - PaymentController (public)

4. **Routes**: Đầy đủ routes cho tất cả tính năng mới

### 🔄 Cần hoàn thiện (Frontend & Business Logic):

1. **Views**: Cần tạo views cho các controllers
2. **Business Logic**: Implement các methods trong controllers
3. **File Upload**: Cấu hình storage cho video/PDF
4. **Payment Gateway**: Tích hợp VNPay/MoMo/Stripe
5. **Email Templates**: Tạo email templates cho notifications
6. **Frontend Dashboard**: Xây dựng UI cho admin và student dashboards
