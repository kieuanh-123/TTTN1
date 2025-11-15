@extends('layouts.main')

@section('title', 'Trang chủ')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section hero-bg">
            <div class="container">
            <div class="row">
                <div class="col-md-8 hero-content">
                    <h1 class="hero-title">Khám Phá Tinh Hoa Võ Thuật</h1>
                    <p class="hero-subtitle">Rèn luyện thể chất - Nâng cao tinh thần - Phát triển bản thân</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('classes') }}" class="btn btn-danger btn-lg">Xem Lớp Học</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Đăng Ký Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Tại Sao Chọn Chúng Tôi</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3>Huấn Luyện Viên Chuyên Nghiệp</h3>
                        <p>Đội ngũ giảng dạy của chúng tôi có nhiều năm kinh nghiệm và được chứng nhận quốc tế.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <h3>Cơ Sở Vật Chất Hiện Đại</h3>
                        <p>Không gian tập luyện rộng rãi, thoáng mát và được trang bị đầy đủ thiết bị hiện đại.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>Chứng Chỉ Quốc Tế</h3>
                        <p>Học viên được cấp chứng chỉ được công nhận trên toàn thế giới sau khi hoàn thành khóa học.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">Các Lớp Võ Phổ Biến</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card class-card">
                        <img src="{{ asset('images/class-1.jpg') }}" class="card-img-top class-image" alt="Karate cho Người Mới">
                        <div class="card-body">
                            <h5 class="card-title">Karate cho Người Mới</h5>
                            <p class="card-text">Khóa học cơ bản dành cho người mới bắt đầu, giúp nắm vững các kỹ thuật căn bản.</p>
                            <a href="{{ route('classes') }}" class="btn btn-outline-danger">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card class-card">
                        <img src="{{ asset('images/class-2.jpg') }}" class="card-img-top class-image" alt="Karate Nâng Cao">
                        <div class="card-body">
                            <h5 class="card-title">Karate Nâng Cao</h5>
                            <p class="card-text">Dành cho học viên đã có kinh nghiệm, tập trung vào các kỹ thuật và chiến thuật phức tạp.</p>
                            <a href="{{ route('classes') }}" class="btn btn-outline-danger">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card class-card">
                        <img src="{{ asset('images/class-3.jpg') }}" class="card-img-top class-image" alt="Karate cho Trẻ Em">
                        <div class="card-body">
                            <h5 class="card-title">Karate cho Trẻ Em</h5>
                            <p class="card-text">Khóa học đặc biệt thiết kế cho trẻ em, giúp phát triển kỹ năng vận động và tự tin.</p>
                            <a href="{{ route('classes') }}" class="btn btn-outline-danger">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('classes') }}" class="btn btn-danger">Xem Tất Cả Lớp Học</a>
            </div>
        </div>
    </section>

    <!-- Instructors Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Đội Ngũ Giảng Dạy</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card instructor-card">
                        <img src="{{ asset('images/hlv-npny.png') }}" class="card-img-top instructor-image" alt="Nguyễn Pham Ngọc Yến">
                        <div class="card-body">
                            <h5 class="card-title">Nguyễn Pham Ngọc Yến</h5>
                            <p class="text-danger">Võ sư nhất đẳng quốc gia</p>
                            <p class="card-text">Với nhiều năm kinh nghiệm giảng dạy võ thuật, từng đạt nhiều giải thưởng quốc gia.</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card instructor-card">
                        <img src="{{ asset('images/hlv-dms.png') }}" class="card-img-top instructor-image" alt="Đàm Minh Sang">
                        <div class="card-body">
                            <h5 class="card-title">Đàm Minh Sang</h5>
                            <p class="text-danger">Võ sư nhị đẳng quốc gia</p>
                            <p class="card-text">Chuyên gia về kỹ thuật chiến đấu, từng huấn luyện nhiều vận động viên đạt giải thưởng.</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card instructor-card">
                        <img src="{{ asset('images/hlv-ctp.png') }}" class="card-img-top instructor-image" alt="Chu Thị Phương">
                        <div class="card-body">
                            <h5 class="card-title">Chu Thị Phương</h5>
                            <p class="text-danger">Võ sư nhị đẳng quốc gia</p>
                            <p class="card-text">Chuyên gia về huấn luyện trẻ em, có phương pháp giảng dạy dễ hiểu và hiệu quả.</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('instructors') }}" class="btn btn-danger">Xem Tất Cả Giảng Viên</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">Học Viên Nói Gì Về Chúng Tôi</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/testimonial-1.jpg') }}" alt="Học viên 1" class="testimonial-image">
                            <div>
                                <h5 class="mb-0">Phạm Văn D</h5>
                                <p class="text-muted">Học viên 2 năm</p>
                            </div>
                        </div>
                        <p>"Tôi đã tham gia lớp Karate được 2 năm và thấy sức khỏe cải thiện rõ rệt. Các võ sư rất nhiệt tình và chuyên nghiệp."</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/testimonial-2.jpg') }}" alt="Học viên 2" class="testimonial-image">
                            <div>
                                <h5 class="mb-0">Nguyễn Thị E</h5>
                                <p class="text-muted">Phụ huynh học viên</p>
                            </div>
                        </div>
                        <p>"Con tôi trở nên tự tin và kỷ luật hơn rất nhiều sau khi tham gia lớp Karate cho trẻ em. Đội ngũ giảng dạy rất tâm huyết."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">Sẵn Sàng Bắt Đầu Hành Trình Karate?</h2>
                    <p class="lead mb-0">Đăng ký ngay hôm nay để nhận ưu đãi đặc biệt cho học viên mới!</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">Đăng Ký Ngay</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Tin Tức Mới Nhất</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="{{ asset('images/news-1.jpg') }}" class="card-img-top news-image" alt="Tin tức 1">
                        <div class="card-body">
                            <p class="news-date">15/05/2023</p>
                            <h5 class="card-title">Giải Vô Địch Karate Toàn Quốc 2023</h5>
                            <p class="card-text">Học viên của chúng tôi đã giành được 5 huy chương vàng tại Giải Vô Địch Karate Toàn Quốc.</p>
                            <a href="#" class="btn btn-outline-danger">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="{{ asset('images/news-2.jpg') }}" class="card-img-top news-image" alt="Tin tức 2">
                        <div class="card-body">
                            <p class="news-date">02/04/2023</p>
                            <h5 class="card-title">Khai Giảng Lớp Mới Dành Cho Trẻ Em</h5>
                            <p class="card-text">Chúng tôi vừa khai giảng thêm lớp Karate mới dành cho trẻ em từ 6-10 tuổi vào cuối tuần.</p>
                            <a href="#" class="btn btn-outline-danger">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="{{ asset('images/news-3.jpg') }}" class="card-img-top news-image" alt="Tin tức 3">
                        <div class="card-body">
                            <p class="news-date">18/03/2023</p>
                            <h5 class="card-title">Võ Sư Nhật Bản Thăm Dojo</h5>
                            <p class="card-text">Võ sư nổi tiếng đến từ Nhật Bản đã ghé thăm và dạy các lớp đặc biệt tại Dojo của chúng tôi.</p>
                            <a href="#" class="btn btn-outline-danger">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('news') }}" class="btn btn-danger">Xem Tất Cả Tin Tức</a>
            </div>
        </div>
    </section>
@endsection