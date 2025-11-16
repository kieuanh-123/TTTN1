# 📖 HƯỚNG DẪN SỬ DỤNG HỆ THỐNG QUẢN LÝ KARATE TMA

Hướng dẫn chi tiết các thao tác trên web theo từng vai trò: **Admin**, **Huấn luyện viên (HLV)**, và **Học viên**.

---

## 📋 MỤC LỤC

1. [Thông tin Test và Tài khoản](#thông-tin-test-và-tài-khoản)
2. [Hướng dẫn cho Admin](#1-hướng-dẫn-cho-admin)
3. [Hướng dẫn cho Huấn luyện viên (HLV)](#2-hướng-dẫn-cho-huấn-luyện-viên-hlv)
4. [Hướng dẫn cho Học viên](#3-hướng-dẫn-cho-học-viên)
5. [Các tính năng chung](#4-các-tính-năng-chung)

---

## 🔐 THÔNG TIN TEST VÀ TÀI KHOẢN

### Tạo Tài khoản Admin

**Cách 1: Sử dụng Database Seeder (Khuyến nghị)**

1. Chạy lệnh seed để tạo tài khoản admin mặc định:
```bash
php artisan db:seed --class=AdminUserSeeder
```

Hoặc chạy tất cả seeders:
```bash
php artisan db:seed
```

**Thông tin đăng nhập Admin mặc định:**
- **Email:** `admin@tma.com`
- **Password:** `admin123`
- **Role:** Admin (role_id = 1)

**Lưu ý:** Sau khi seed, bạn nên đổi mật khẩu ngay lập tức!

**Cách 2: Tạo Admin qua Admin Panel**

1. Đăng nhập bằng tài khoản admin hiện có
2. Vào **Admin** → **Users** → **Thêm mới**
3. Điền thông tin:
   - Tên: Tên admin
   - Email: Email admin
   - Password: Mật khẩu (tối thiểu 8 ký tự)
   - Role: Chọn **Admin** (role_id = 1)
4. Click **Lưu**

**Cách 3: Tạo Admin qua Database trực tiếp**

Chạy SQL hoặc sử dụng tinker:
```bash
php artisan tinker
```

```php
$adminRole = \App\Models\Role::where('name', 'admin')->first();
\App\Models\User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => \Illuminate\Support\Facades\Hash::make('your_password'),
    'role_id' => $adminRole->id,
    'email_verified_at' => now(),
]);
```

### Tạo Tài khoản Học viên (Student)

**Cách 1: Đăng ký qua Website (Khuyến nghị)**

1. Truy cập: `/register` hoặc `/login` → Click **Đăng ký**
2. Điền thông tin:
   - Tên đầy đủ
   - Email (chưa được sử dụng)
   - Password (tối thiểu 8 ký tự)
   - Xác nhận Password
3. Click **Đăng ký**
4. Kiểm tra email và click link xác thực email
5. Sau khi xác thực, tài khoản sẽ có role **User** (role_id = 2) hoặc null (mặc định là user)

**Cách 2: Admin tạo tài khoản học viên**

1. Admin đăng nhập
2. Vào **Admin** → **Users** → **Thêm mới**
3. Điền thông tin:
   - Tên: Tên học viên
   - Email: Email học viên
   - Password: Mật khẩu
   - Role: Chọn **User** (role_id = 2)
4. Click **Lưu**

**Cách 3: Đăng nhập bằng Google/Facebook**

1. Truy cập trang đăng nhập
2. Click **Đăng nhập bằng Google** hoặc **Đăng nhập bằng Facebook**
3. Chọn tài khoản và cho phép truy cập
4. Tài khoản sẽ được tạo tự động với role **User**

### Vai trò trong Hệ thống

Hệ thống có 2 vai trò chính:

1. **Admin (role_id = 1)**
   - Quyền truy cập: `/admin/*`
   - Có thể quản lý tất cả tính năng trong hệ thống
   - Xem và chỉnh sửa tất cả dữ liệu

2. **User/Student (role_id = 2 hoặc null)**
   - Quyền truy cập: `/student/*`, `/profile`, `/payments/*`
   - Chỉ xem và quản lý dữ liệu của chính mình
   - Đăng ký khóa học, thanh toán, học bài

**Lưu ý:** Huấn luyện viên (Instructor) là một model riêng, không phải là role của User. Instructor được quản lý trong bảng `instructors` và được gán vào các khóa học.

### Tổng hợp Tính năng theo Vai trò

#### **Admin (role_id = 1)**

**Quản lý:**
- ✅ Quản lý Users (tạo, sửa, xóa, phân quyền)
- ✅ Quản lý Classes (khóa học)
- ✅ Quản lý Instructors (huấn luyện viên)
- ✅ Quản lý News (tin tức/blog)
- ✅ Quản lý Banners
- ✅ Quản lý Orders (đơn hàng) - phê duyệt/từ chối
- ✅ Quản lý Payments (thanh toán) - xác nhận thanh toán
- ✅ Quản lý Enrollments (đăng ký) - phê duyệt/hủy
- ✅ Quản lý Lessons (bài học) - tạo, xuất bản
- ✅ Quản lý Class Sessions (buổi học)
- ✅ Quản lý Attendance (điểm danh) - điểm danh thủ công/hàng loạt
- ✅ Quản lý Testimonials (đánh giá) - phê duyệt/từ chối

**Routes:**
- `/admin` - Dashboard
- `/admin/users` - Quản lý người dùng
- `/admin/classes` - Quản lý khóa học
- `/admin/instructors` - Quản lý HLV
- `/admin/news` - Quản lý tin tức
- `/admin/banners` - Quản lý banner
- `/admin/orders` - Quản lý đơn hàng
- `/admin/payments` - Quản lý thanh toán
- `/admin/enrollments` - Quản lý đăng ký
- `/admin/lessons` - Quản lý bài học
- `/admin/sessions` - Quản lý buổi học
- `/admin/attendances` - Quản lý điểm danh
- `/admin/testimonials` - Quản lý đánh giá

#### **User/Student (role_id = 2 hoặc null)**

**Tính năng:**
- ✅ Đăng ký tài khoản
- ✅ Đăng nhập (thường, Google, Facebook)
- ✅ Xác thực email
- ✅ Two-Factor Authentication (2FA)
- ✅ Quản lý Profile
- ✅ Xem Dashboard học viên
- ✅ Xem danh sách khóa học đã đăng ký
- ✅ Xem và học bài học
- ✅ Đánh dấu hoàn thành bài học
- ✅ Xem tiến độ học tập
- ✅ Đăng ký khóa học mới
- ✅ Thanh toán đơn hàng
- ✅ Upload chứng từ thanh toán
- ✅ Để lại đánh giá (testimonials)
- ✅ Xem lịch học
- ✅ Xem điểm danh

**Routes:**
- `/student/dashboard` - Dashboard học viên
- `/student/classes` - Danh sách khóa học
- `/student/classes/{class}/lessons` - Danh sách bài học
- `/student/lessons/{lesson}` - Chi tiết bài học
- `/student/lessons/{lesson}/complete` - Hoàn thành bài học
- `/student/progress` - Tiến độ học tập
- `/payments/orders/{order}` - Xem đơn hàng
- `/payments/orders/{order}/pay` - Thanh toán
- `/payments/upload-proof/{payment}` - Upload chứng từ
- `/testimonials` (POST) - Gửi đánh giá
- `/profile` - Quản lý hồ sơ

### Thiết lập Ban đầu

**Bước 1: Chạy Migration và Seeder**

```bash
php artisan migrate
php artisan db:seed
```

**Bước 2: Đăng nhập Admin**

- Email: `admin@tma.com`
- Password: `admin123`
- URL: `/login` → `/admin`

**Bước 3: Tạo dữ liệu mẫu (tùy chọn)**

1. Tạo Instructor: Admin → Instructors → Thêm mới
2. Tạo Class: Admin → Classes → Thêm mới (gán Instructor)
3. Tạo Lesson: Admin → Lessons → Thêm mới (gán Class)
4. Tạo News: Admin → News → Thêm mới

**Bước 4: Tạo tài khoản học viên test**

- Đăng ký qua `/register` hoặc Admin tạo qua `/admin/users`

---

## 1. HƯỚNG DẪN CHO ADMIN

### 1.1. Đăng nhập vào hệ thống

1. Truy cập trang web: `http://your-domain.com/login`
2. Nhập **Email** và **Mật khẩu** của tài khoản admin
3. Nếu bật 2FA, nhập mã xác thực 6 số được gửi qua email
4. Click **Đăng nhập**
5. Sau khi đăng nhập thành công, truy cập **Admin Dashboard** tại: `http://your-domain.com/admin`

### 1.2. Quản lý Người dùng (Users)

**Xem danh sách người dùng:**
- Vào menu **Admin** → **Users** hoặc truy cập: `/admin/users`
- Xem danh sách tất cả người dùng trong hệ thống

**Thêm người dùng mới:**
1. Click nút **Thêm mới** hoặc **Create New User**
2. Điền thông tin:
   - Tên đầy đủ
   - Email
   - Mật khẩu
   - Vai trò (Role): Admin hoặc User
3. Click **Lưu** hoặc **Save**

**Chỉnh sửa người dùng:**
1. Tìm người dùng cần chỉnh sửa trong danh sách
2. Click **Sửa** hoặc **Edit**
3. Cập nhật thông tin cần thiết
4. Click **Cập nhật** hoặc **Update**

**Xóa người dùng:**
1. Tìm người dùng cần xóa
2. Click **Xóa** hoặc **Delete**
3. Xác nhận xóa

### 1.3. Quản lý Khóa học (Classes)

**Xem danh sách khóa học:**
- Vào menu **Admin** → **Classes** hoặc truy cập: `/admin/classes`

**Thêm khóa học mới:**
1. Click **Thêm mới** hoặc **Create New Class**
2. Điền thông tin:
   - **Tên khóa học** (Name)
   - **Mô tả** (Description)
   - **Giá** (Price)
   - **Cấp độ** (Level): Beginner, Intermediate, Advanced
   - **Huấn luyện viên** (Instructor): Chọn HLV từ danh sách
   - **Lịch học** (Schedule): Thời gian và ngày học
   - **Số giờ học** (Hours)
   - **Đánh dấu nổi bật** (Featured): Check nếu muốn hiển thị nổi bật
   - **Ảnh khóa học** (Image): Upload ảnh đại diện
3. Click **Lưu**

**Chỉnh sửa khóa học:**
1. Tìm khóa học trong danh sách
2. Click **Sửa**
3. Cập nhật thông tin
4. Click **Cập nhật**

**Xóa khóa học:**
1. Tìm khóa học cần xóa
2. Click **Xóa**
3. Xác nhận xóa

### 1.4. Quản lý Huấn luyện viên (Instructors)

**Xem danh sách HLV:**
- Vào menu **Admin** → **Instructors** hoặc truy cập: `/admin/instructors`

**Thêm HLV mới:**
1. Click **Thêm mới**
2. Điền thông tin:
   - **Tên** (Name)
   - **Tiêu đề** (Title): Ví dụ: "HLV Karate Đai Đen 5 Đẳng"
   - **Tiểu sử** (Bio): Mô tả về HLV
   - **Email**
   - **Ảnh đại diện** (Image)
   - **Facebook** (Link Facebook)
   - **Instagram** (Link Instagram)
   - **LinkedIn** (Link LinkedIn)
   - **Đánh dấu nổi bật** (Featured)
3. Click **Lưu**

**Chỉnh sửa HLV:**
1. Tìm HLV trong danh sách
2. Click **Sửa**
3. Cập nhật thông tin
4. Click **Cập nhật**

**Xóa HLV:**
1. Tìm HLV cần xóa
2. Click **Xóa**
3. Xác nhận xóa

### 1.5. Quản lý Tin tức (News)

**Xem danh sách tin tức:**
- Vào menu **Admin** → **News** hoặc truy cập: `/admin/news`

**Thêm tin tức mới:**
1. Click **Thêm mới**
2. Điền thông tin:
   - **Tiêu đề** (Title)
   - **Nội dung** (Content): Sử dụng editor để soạn thảo
   - **Ảnh đại diện** (Image)
   - **Trạng thái** (Status): Draft (Bản nháp) hoặc Published (Đã xuất bản)
   - **Slug**: Tự động tạo từ tiêu đề (có thể chỉnh sửa)
3. Click **Lưu**

**Chỉnh sửa tin tức:**
1. Tìm bài viết trong danh sách
2. Click **Sửa**
3. Cập nhật nội dung
4. Click **Cập nhật**

**Xuất bản/Hủy xuất bản:**
- Thay đổi trạng thái từ Draft sang Published hoặc ngược lại

**Xóa tin tức:**
1. Tìm bài viết cần xóa
2. Click **Xóa**
3. Xác nhận xóa

### 1.6. Quản lý Banner

**Xem danh sách banner:**
- Vào menu **Admin** → **Banners** hoặc truy cập: `/admin/banners`

**Thêm banner mới:**
1. Click **Thêm mới**
2. Điền thông tin:
   - **Tiêu đề** (Title)
   - **Mô tả** (Description)
   - **Ảnh banner** (Image)
   - **Link** (URL): Link khi click vào banner
   - **Vị trí hiển thị** (Position)
   - **Thứ tự** (Order)
   - **Trạng thái** (Status): Active hoặc Inactive
3. Click **Lưu**

**Chỉnh sửa/Xóa banner:**
- Tương tự như các mục khác

### 1.7. Quản lý Đơn hàng (Orders)

**Xem danh sách đơn hàng:**
- Vào menu **Admin** → **Orders** hoặc truy cập: `/admin/orders`
- Xem danh sách tất cả đơn hàng với trạng thái: Pending, Approved, Rejected, Completed

**Phê duyệt đơn hàng:**
1. Tìm đơn hàng có trạng thái **Pending**
2. Click **Xem chi tiết**
3. Kiểm tra thông tin đơn hàng
4. Click **Phê duyệt** (Approve)
5. Hệ thống sẽ tự động tạo Enrollment cho học viên

**Từ chối đơn hàng:**
1. Tìm đơn hàng cần từ chối
2. Click **Từ chối** (Reject)
3. Nhập lý do từ chối (nếu có)
4. Xác nhận

### 1.8. Quản lý Thanh toán (Payments)

**Xem danh sách thanh toán:**
- Vào menu **Admin** → **Payments** hoặc truy cập: `/admin/payments`
- Xem danh sách thanh toán với trạng thái: Pending, Paid, Confirmed, Failed

**Xác nhận thanh toán:**
1. Tìm thanh toán có trạng thái **Pending** hoặc **Paid**
2. Kiểm tra thông tin:
   - Số tiền
   - Phương thức thanh toán
   - Ảnh chứng từ (nếu thanh toán qua ngân hàng)
3. Click **Xác nhận thanh toán** (Confirm Payment)
4. Hệ thống sẽ cập nhật trạng thái thanh toán và enrollment

**Xem chi tiết thanh toán:**
- Click vào từng thanh toán để xem thông tin chi tiết

### 1.9. Quản lý Đăng ký (Enrollments)

**Xem danh sách đăng ký:**
- Vào menu **Admin** → **Enrollments** hoặc truy cập: `/admin/enrollments`
- Xem danh sách đăng ký với trạng thái: Pending, Approved, Active, Completed, Cancelled

**Phê duyệt đăng ký:**
1. Tìm đăng ký có trạng thái **Pending**
2. Click **Xem chi tiết**
3. Kiểm tra thông tin học viên và khóa học
4. Click **Phê duyệt** (Approve)
5. Hệ thống sẽ tự động tạo Order và gửi thông báo cho học viên

**Hủy đăng ký:**
1. Tìm đăng ký cần hủy
2. Click **Hủy** (Cancel)
3. Nhập lý do hủy
4. Xác nhận

### 1.10. Quản lý Bài học (Lessons)

**Xem danh sách bài học:**
- Vào menu **Admin** → **Lessons** hoặc truy cập: `/admin/lessons`

**Thêm bài học mới:**
1. Click **Thêm mới**
2. Điền thông tin:
   - **Tên bài học** (Title)
   - **Mô tả** (Description)
   - **Khóa học** (Class): Chọn khóa học
   - **Thứ tự** (Order): Thứ tự trong khóa học
   - **Trạng thái** (Status): Draft hoặc Published
3. Click **Lưu**

**Thêm nội dung bài học:**
1. Sau khi tạo bài học, vào **Chi tiết bài học**
2. Thêm nội dung:
   - **Video**: Link video hoặc upload video
   - **Tài liệu PDF**: Upload file PDF
   - **Bài tập** (Exercises): Thêm bài tập cho học viên
3. Click **Lưu**

**Xuất bản bài học:**
1. Tìm bài học có trạng thái Draft
2. Click **Xuất bản** (Publish)
3. Bài học sẽ hiển thị cho học viên

### 1.11. Quản lý Buổi học (Class Sessions)

**Xem danh sách buổi học:**
- Vào menu **Admin** → **Sessions** hoặc truy cập: `/admin/sessions`

**Tạo buổi học mới:**
1. Click **Thêm mới**
2. Điền thông tin:
   - **Khóa học** (Class): Chọn khóa học
   - **Huấn luyện viên** (Instructor): Chọn HLV
   - **Ngày giờ** (Date & Time)
   - **Địa điểm** (Location)
   - **Mô tả** (Description)
   - **Trạng thái** (Status): Scheduled, Completed, Cancelled
3. Click **Lưu**

**Chỉnh sửa buổi học:**
- Tương tự như các mục khác

### 1.12. Quản lý Điểm danh (Attendance)

**Xem danh sách điểm danh:**
- Vào menu **Admin** → **Attendances** hoặc truy cập: `/admin/attendances`

**Điểm danh thủ công:**
1. Tìm buổi học cần điểm danh
2. Click **Điểm danh**
3. Chọn học viên có mặt/vắng mặt
4. Click **Lưu**

**Điểm danh hàng loạt:**
1. Vào trang **Điểm danh hàng loạt** (Bulk Check)
2. Chọn buổi học
3. Chọn tất cả học viên có mặt
4. Click **Lưu điểm danh hàng loạt**

**Xem báo cáo điểm danh:**
- Xem thống kê số buổi có mặt/vắng mặt của từng học viên

### 1.13. Quản lý Đánh giá (Testimonials)

**Xem danh sách đánh giá:**
- Vào menu **Admin** → **Testimonials** hoặc truy cập: `/admin/testimonials`
- Xem danh sách đánh giá với trạng thái: Pending, Approved, Rejected

**Phê duyệt đánh giá:**
1. Tìm đánh giá có trạng thái **Pending**
2. Đọc nội dung đánh giá
3. Click **Phê duyệt** (Approve)
4. Đánh giá sẽ hiển thị trên website

**Từ chối đánh giá:**
1. Tìm đánh giá cần từ chối
2. Click **Từ chối** (Reject)
3. Nhập lý do (nếu cần)
4. Xác nhận

### 1.14. Dashboard Admin

**Xem tổng quan:**
- Truy cập: `/admin` hoặc `/admin/dashboard`
- Xem các thống kê:
  - Tổng số người dùng
  - Tổng số khóa học
  - Tổng số đơn hàng
  - Doanh thu (nếu có)
  - Số học viên mới
  - Đăng ký đang chờ phê duyệt

---

## 2. HƯỚNG DẪN CHO HUẤN LUYỆN VIÊN (HLV)

### 2.1. Đăng nhập vào hệ thống

1. Truy cập: `http://your-domain.com/login`
2. Nhập **Email** và **Mật khẩu** của tài khoản HLV
3. Nếu bật 2FA, nhập mã xác thực
4. Click **Đăng nhập**

**Lưu ý:** HLV có thể được tạo tài khoản bởi Admin hoặc đăng ký như học viên và được Admin nâng cấp quyền.

### 2.2. Xem Dashboard HLV

1. Sau khi đăng nhập, truy cập Dashboard HLV (nếu có route riêng)
2. Xem thông tin:
   - Danh sách lớp đang dạy
   - Lịch học sắp tới
   - Số học viên trong từng lớp
   - Thông báo mới

### 2.3. Xem danh sách lớp đang dạy

1. Vào menu **Lớp của tôi** hoặc **My Classes**
2. Xem danh sách các khóa học được gán cho HLV
3. Click vào từng lớp để xem chi tiết:
   - Thông tin khóa học
   - Danh sách học viên
   - Lịch học
   - Tiến độ học tập của học viên

### 2.4. Quản lý Buổi học (Class Sessions)

**Xem lịch học:**
1. Vào **Lịch học** hoặc **Schedule**
2. Xem các buổi học sắp tới và đã qua

**Tạo buổi học mới (nếu có quyền):**
1. Click **Thêm buổi học**
2. Điền thông tin:
   - Khóa học
   - Ngày giờ
   - Địa điểm
   - Nội dung buổi học
3. Click **Lưu**

**Chỉnh sửa buổi học:**
- Chỉnh sửa thông tin buổi học (nếu có quyền)

### 2.5. Điểm danh học viên

**Điểm danh cho buổi học:**
1. Vào **Điểm danh** hoặc **Attendance**
2. Chọn buổi học cần điểm danh
3. Xem danh sách học viên đăng ký lớp
4. Đánh dấu học viên:
   - ✅ **Có mặt** (Present)
   - ❌ **Vắng mặt** (Absent)
5. Click **Lưu điểm danh**

**Xem lịch sử điểm danh:**
- Xem lịch sử điểm danh của các buổi học trước

### 2.6. Xem tiến độ học viên

1. Vào **Tiến độ học viên** hoặc **Student Progress**
2. Chọn lớp học
3. Xem danh sách học viên và tiến độ:
   - Số bài học đã hoàn thành
   - Phần trăm hoàn thành khóa học
   - Thời gian học tập
   - Điểm danh (số buổi có mặt/vắng)

### 2.7. Quản lý Bài học (nếu có quyền)

**Xem danh sách bài học:**
1. Vào **Bài học** hoặc **Lessons**
2. Xem các bài học trong lớp được gán

**Thêm/Chỉnh sửa bài học:**
- Nếu được Admin cấp quyền, HLV có thể thêm hoặc chỉnh sửa bài học cho lớp của mình

### 2.8. Cập nhật thông tin cá nhân

1. Vào **Hồ sơ** hoặc **Profile**
2. Cập nhật thông tin:
   - Tên
   - Tiêu đề
   - Tiểu sử
   - Ảnh đại diện
   - Liên kết mạng xã hội
3. Click **Lưu**

---

## 3. HƯỚNG DẪN CHO HỌC VIÊN

### 3.1. Đăng ký tài khoản

**Cách 1: Đăng ký thông thường**
1. Truy cập: `http://your-domain.com/register`
2. Điền thông tin:
   - Tên đầy đủ
   - Email
   - Mật khẩu
   - Xác nhận mật khẩu
3. Click **Đăng ký**
4. Kiểm tra email và click link xác thực email

**Cách 2: Đăng nhập bằng Google**
1. Truy cập trang đăng nhập
2. Click **Đăng nhập bằng Google**
3. Chọn tài khoản Google
4. Cho phép truy cập
5. Tài khoản sẽ được tạo tự động

**Cách 3: Đăng nhập bằng Facebook**
1. Truy cập trang đăng nhập
2. Click **Đăng nhập bằng Facebook**
3. Đăng nhập Facebook và cho phép truy cập
4. Tài khoản sẽ được tạo tự động

### 3.2. Đăng nhập vào hệ thống

1. Truy cập: `http://your-domain.com/login`
2. Nhập **Email** và **Mật khẩu**
3. Nếu bật 2FA:
   - Kiểm tra email để lấy mã xác thực 6 số
   - Nhập mã vào ô **Mã xác thực**
4. Click **Đăng nhập**

### 3.3. Xem Dashboard học viên

1. Sau khi đăng nhập, truy cập: `/student/dashboard`
2. Xem thông tin:
   - Khóa học đang tham gia
   - Tiến độ học tập
   - Lịch học sắp tới
   - Thông báo mới

### 3.4. Đăng ký khóa học

**Cách 1: Đăng ký trực tiếp trên website**
1. Truy cập trang **Khóa học**: `/classes`
2. Xem danh sách khóa học
3. Click vào khóa học muốn đăng ký
4. Xem thông tin chi tiết:
   - Mô tả khóa học
   - Giá
   - Lịch học
   - Huấn luyện viên
5. Click **Đăng ký ngay**
6. Điền thông tin bổ sung (nếu có)
7. Click **Xác nhận đăng ký**
8. Chờ Admin phê duyệt

**Cách 2: Đăng ký qua form tư vấn**
1. Truy cập: `/dang-ky`
2. Chọn loại đăng ký: **Tư vấn**, **Đăng ký lớp**, hoặc **Cả hai**
3. Điền thông tin:
   - Email (sẽ nhận mã xác thực)
   - Họ tên
   - Số điện thoại
   - Ngày sinh (tùy chọn)
   - Giới tính (tùy chọn)
   - Địa chỉ (tùy chọn)
   - Loại lớp quan tâm
   - Thời gian mong muốn
   - Ghi chú
4. **Xác thực email:**
   - Click **Gửi mã xác thực**
   - Kiểm tra email và nhập mã 6 số
   - Click **Xác nhận mã**
5. Đồng ý với điều khoản
6. Click **Gửi đăng ký**
7. Nhận mã đăng ký (ví dụ: REG-XXXXXXXX)
8. Chờ Admin liên hệ và phê duyệt

### 3.5. Xem danh sách khóa học đã đăng ký

1. Vào **Dashboard học viên** → **Khóa học của tôi** hoặc truy cập: `/student/classes`
2. Xem danh sách:
   - Khóa học đang chờ phê duyệt (Pending)
   - Khóa học đã được phê duyệt (Approved)
   - Khóa học đang học (Active)
   - Khóa học đã hoàn thành (Completed)

### 3.6. Thanh toán

**Xem đơn hàng cần thanh toán:**
1. Sau khi đăng ký được phê duyệt, hệ thống sẽ tạo đơn hàng
2. Vào **Thanh toán** hoặc truy cập: `/payments/orders/{order_id}`
3. Xem thông tin đơn hàng:
   - Số tiền cần thanh toán
   - Khóa học
   - Thời hạn thanh toán

**Thanh toán:**
1. Chọn phương thức thanh toán:
   - **Chuyển khoản ngân hàng**
   - **Thẻ tín dụng/Ghi nợ**
   - **Tiền mặt** (cần Admin xác nhận)
2. Nếu chọn **Chuyển khoản:**
   - Xem thông tin tài khoản ngân hàng
   - Thực hiện chuyển khoản
   - Upload ảnh chứng từ chuyển khoản
   - Click **Xác nhận đã thanh toán**
3. Nếu chọn **Thẻ:**
   - Điền thông tin thẻ
   - Xác nhận thanh toán
4. Chờ Admin xác nhận thanh toán

**Xem lịch sử thanh toán:**
- Vào **Lịch sử thanh toán** để xem tất cả giao dịch

### 3.7. Học bài học

**Xem danh sách bài học:**
1. Vào **Khóa học của tôi**
2. Click vào khóa học muốn học
3. Xem danh sách bài học trong khóa học

**Xem bài học:**
1. Click vào bài học muốn học
2. Xem nội dung:
   - Video bài học
   - Tài liệu PDF (nếu có)
   - Mô tả bài học
3. Đọc và xem kỹ nội dung

**Hoàn thành bài học:**
1. Sau khi xem xong bài học
2. Click **Đánh dấu đã hoàn thành** hoặc **Complete Lesson**
3. Hệ thống sẽ cập nhật tiến độ học tập

**Làm bài tập:**
1. Nếu bài học có bài tập, xem yêu cầu
2. Làm bài tập theo hướng dẫn
3. Nộp bài tập (nếu có chức năng nộp bài)

### 3.8. Xem tiến độ học tập

1. Vào **Tiến độ** hoặc truy cập: `/student/progress`
2. Xem thông tin:
   - Số bài học đã hoàn thành / Tổng số bài học
   - Phần trăm hoàn thành khóa học
   - Thời gian học tập
   - Biểu đồ tiến độ (nếu có)

### 3.9. Xem lịch học

1. Vào **Lịch học** trong Dashboard
2. Xem:
   - Các buổi học sắp tới
   - Lịch sử buổi học đã tham gia
   - Địa điểm và thời gian

### 3.10. Xem điểm danh

1. Vào **Điểm danh** hoặc **Attendance**
2. Xem lịch sử điểm danh:
   - Các buổi học đã tham gia
   - Số buổi có mặt
   - Số buổi vắng mặt
   - Tỷ lệ tham gia

### 3.11. Để lại đánh giá (Testimonials)

1. Sau khi hoàn thành khóa học (hoặc trong quá trình học)
2. Vào **Đánh giá** hoặc tìm nút **Để lại đánh giá**
3. Điền thông tin:
   - **Đánh giá** (Rating): Chọn số sao (1-5)
   - **Nội dung đánh giá**: Viết cảm nhận về khóa học
   - **Tên** (có thể hiển thị hoặc ẩn danh)
4. Click **Gửi đánh giá**
5. Chờ Admin phê duyệt để hiển thị trên website

### 3.12. Xem chứng chỉ (nếu có)

1. Sau khi hoàn thành khóa học
2. Vào **Chứng chỉ** hoặc truy cập: `/certificate`
3. Xem và tải xuống chứng chỉ hoàn thành (nếu được cấp)

### 3.13. Cập nhật thông tin cá nhân

1. Vào **Hồ sơ** hoặc **Profile** hoặc truy cập: `/profile`
2. Xem và cập nhật:
   - Tên
   - Email
   - Số điện thoại
   - Địa chỉ
   - Ảnh đại diện
3. Click **Lưu** hoặc **Update Profile**

**Đổi mật khẩu:**
1. Trong trang **Hồ sơ**, tìm phần **Đổi mật khẩu**
2. Nhập:
   - Mật khẩu hiện tại
   - Mật khẩu mới
   - Xác nhận mật khẩu mới
3. Click **Đổi mật khẩu**

### 3.14. Xem tin tức/Blog

1. Truy cập: `/news`
2. Xem danh sách tin tức
3. Click vào bài viết để xem chi tiết
4. Đọc nội dung và xem ảnh

### 3.15. Quên mật khẩu

1. Truy cập: `/forgot-password`
2. Nhập **Email** đã đăng ký
3. Click **Gửi link đặt lại mật khẩu**
4. Kiểm tra email và click link đặt lại mật khẩu
5. Nhập mật khẩu mới
6. Xác nhận mật khẩu mới
7. Click **Đặt lại mật khẩu**

---

## 4. CÁC TÍNH NĂNG CHUNG

### 4.1. Xem trang chủ

- Truy cập: `/` hoặc `/home`
- Xem:
  - Banner quảng cáo
  - Khóa học nổi bật
  - Huấn luyện viên
  - Đánh giá từ học viên
  - Tin tức mới nhất

### 4.2. Xem trang giới thiệu

- Truy cập: `/about`
- Xem thông tin về trung tâm, lịch sử, sứ mệnh

### 4.3. Xem danh sách khóa học (công khai)

- Truy cập: `/classes`
- Xem tất cả khóa học
- Lọc theo cấp độ, giá, HLV
- Click vào khóa học để xem chi tiết

### 4.4. Xem danh sách huấn luyện viên (công khai)

- Truy cập: `/instructors`
- Xem danh sách HLV
- Click vào HLV để xem thông tin chi tiết

### 4.5. Đăng xuất

1. Click vào **Tên người dùng** hoặc **Avatar** ở góc trên
2. Click **Đăng xuất** hoặc **Logout**
3. Xác nhận đăng xuất (nếu có)

---

## 📝 LƯU Ý QUAN TRỌNG

1. **Bảo mật tài khoản:**
   - Không chia sẻ mật khẩu với người khác
   - Bật 2FA để tăng cường bảo mật
   - Đổi mật khẩu định kỳ

2. **Thanh toán:**
   - Luôn kiểm tra thông tin đơn hàng trước khi thanh toán
   - Lưu ảnh chứng từ thanh toán
   - Liên hệ Admin nếu có vấn đề về thanh toán

3. **Học tập:**
   - Hoàn thành bài học theo thứ tự
   - Làm bài tập đầy đủ
   - Tham gia đầy đủ các buổi học

4. **Liên hệ hỗ trợ:**
   - Nếu gặp vấn đề, liên hệ Admin qua email hoặc số điện thoại
   - Kiểm tra email thường xuyên để nhận thông báo

---

## 🔄 QUY TRÌNH TỔNG QUAN

### Quy trình đăng ký và học tập:

1. **Học viên đăng ký** → Form đăng ký hoặc đăng ký trực tiếp
2. **Admin phê duyệt đăng ký** → Tạo Enrollment
3. **Hệ thống tạo đơn hàng** → Gửi thông báo cho học viên
4. **Học viên thanh toán** → Upload chứng từ (nếu cần)
5. **Admin xác nhận thanh toán** → Kích hoạt Enrollment
6. **Học viên bắt đầu học** → Xem bài học, làm bài tập
7. **HLV điểm danh** → Theo dõi tham gia buổi học
8. **Học viên hoàn thành khóa học** → Nhận chứng chỉ (nếu có)
9. **Học viên để lại đánh giá** → Admin phê duyệt và hiển thị

---

**Chúc bạn sử dụng hệ thống hiệu quả!** 🥋

