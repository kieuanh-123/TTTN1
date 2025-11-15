@extends('layouts.main')

@section('title', 'Chi Tiết Tin Tức')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-3">Giải Vô Địch Karate Toàn Quốc 2023</h1>
                <p class="text-muted">Đăng ngày: 15/05/2023 | Tác giả: Admin</p>
                
                <img src="{{ asset('images/news-1.jpg') }}" alt="Giải Vô Địch Karate Toàn Quốc 2023" class="img-fluid rounded mb-4">
                
                <div class="news-content">
                    <p>Học viên của Karate Dojo đã tham gia Giải Vô Địch Karate Toàn Quốc 2023 được tổ chức tại Hà Nội vào ngày 10-12/05/2023 và đã đạt được thành tích xuất sắc với 5 huy chương vàng, 3 huy chương bạc và 2 huy chương đồng.</p>
                    
                    <p>Đây là kết quả của quá trình luyện tập chăm chỉ và sự hướng dẫn tận tình của các võ sư tại Karate Dojo. Các học viên đã thể hiện tinh thần võ đạo cao và kỹ thuật xuất sắc trong suốt giải đấu.</p>
                    
                    <h2 class="h4 mt-4">Các Huy Chương Vàng</h2>
                    <ul>
                        <li>Nguyễn Văn X - Hạng cân 60kg nam</li>
                        <li>Trần Thị Y - Hạng cân 55kg nữ</li>
                        <li>Lê Văn Z - Kata cá nhân nam</li>
                        <li>Đội Kata đồng đội nam</li>
                        <li>Đội Kumite đồng đội nữ</li>
                    </ul>
                    
                    <h2 class="h4 mt-4">Phát Biểu Của Võ Sư</h2>
                    <p>"Chúng tôi rất tự hào về thành tích của các học viên. Đây là kết quả của sự nỗ lực không ngừng và tinh thần võ đạo cao. Chúng tôi sẽ tiếp tục phát huy và chuẩn bị cho các giải đấu quốc tế sắp tới." - Võ sư Nguyễn Văn A, Giám đốc Karate Dojo chia sẻ.</p>
                    
                    <h2 class="h4 mt-4">Sự Kiện Sắp Tới</h2>
                    <p>Sau thành công tại Giải Vô Địch Karate Toàn Quốc, Karate Dojo sẽ tổ chức buổi giao lưu và chia sẻ kinh nghiệm với các học viên vào ngày 25/05/2023. Đây là cơ hội để các học viên khác học hỏi từ những người đã đạt giải.</p>
                    
                    <p>Ngoài ra, chúng tôi cũng đang chuẩn bị cho Giải Vô Địch Karate Đông Nam Á sẽ diễn ra vào tháng 8 năm nay tại Singapore.</p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('news') }}" class="btn btn-outline-danger">Quay lại Tin Tức</a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h3 class="h5 mb-0">Tin Tức Liên Quan</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/news-2.jpg') }}" alt="Tin tức" class="img-fluid rounded" style="width: 80px; height: 60px; object-fit: cover;">
                            <div class="ms-3">
                                <h4 class="h6 mb-1">Khai Giảng Lớp Mới Dành Cho Trẻ Em</h4>
                                <p class="small text-muted mb-0">02/04/2023</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/news-3.jpg') }}" alt="Tin tức" class="img-fluid rounded" style="width: 80px; height: 60px; object-fit: cover;">
                            <div class="ms-3">
                                <h4 class="h6 mb-1">Võ Sư Nhật Bản Thăm Dojo</h4>
                                <p class="small text-muted mb-0">18/03/2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h3 class="h5 mb-0">Đăng Ký Lớp Học</h3>
                    </div>
                    <div class="card-body">
                        <p>Đăng ký ngay để tham gia các lớp học Karate chất lượng cao tại Karate Dojo.</p>
                        <a href="{{ route('classes') }}" class="btn btn-danger w-100">Xem Lớp Học</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection