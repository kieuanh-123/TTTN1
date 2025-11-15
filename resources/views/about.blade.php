@extends('layouts.main')

@section('title', 'Về Chúng Tôi')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4">Công ty TNHH TM-DV Đệ Nhất 5 Sao</h1>
                <p class="lead">Chào mừng bạn đến với Công ty TNHH TM-DV Đệ Nhất 5 Sao - đơn vị hàng đầu trong lĩnh vực giáo dục và đào tạo tại Việt Nam.</p>
                
                <div class="mb-5">
                    <h2 class="h4">Lịch Sử Hình Thành Công Ty</h2>
                    <p>Công ty TNHH TM-DV Đệ Nhất 5 Sao được thành lập ngày 27/02/2023 với Giám đốc là ông Trần Văn Điền. Trước đó là 1 công ty là đại lý tư vấn du học nghề CHLB Đức cho viện khoa học và quản lý giáo dục.</p>
                    
                    <p>Sau 2 năm hoạt động, Công ty đã thành lập thêm các công ty con và các trung tâm và học viện trực thuộc:</p>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-language text-danger me-3"></i>
                            <strong>Trung tâm Anh ngữ Star</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-handshake text-danger me-3"></i>
                            <strong>Trung tâm hợp tác và đào tạo quốc tế</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-graduation-cap text-danger me-3"></i>
                            <strong>Trung tâm tư vấn du học Dn5Sao</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-chalkboard-teacher text-danger me-3"></i>
                            <strong>Trung tâm gia sư Tâm Trí Việt</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-fist-raised text-danger me-3"></i>
                            <strong>Trung tâm đào tạo võ thuật tài năng trẻ Dn5Sao Việt Nam</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-globe text-danger me-3"></i>
                            <strong>Công ty TNHH dịch thuật Việt Global</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-shield-alt text-danger me-3"></i>
                            <strong>Công ty TNHH An Ninh Bảo Vệ Dn5Sao Việt Nam</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-university text-danger me-3"></i>
                            <strong>Học viện quản lý giáo dục Dn5Sao</strong>
                        </li>
                    </ul>
                    
                    <p>Ngày 11/01/2014, Ban Giám Đốc quyết định gộp các trung tâm và công ty trực thuộc vào công ty tổng: <strong>Công ty Cổ phần Giáo Dục Quốc Tế Dn5Sao</strong>. Hoạt động trên các lĩnh vực đào tạo và đăng ký bao gồm: Đào tạo, tư vấn du học và XKLD.</p>
                </div>
                
                <div class="mb-5">
                    <h2 class="h4">Hoạt Động Trong Lĩnh Vực Giáo Dục</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-fist-raised text-danger fa-2x me-3"></i>
                                        <h3 class="h5 mb-0">Võ Thuật Karatedo</h3>
                                    </div>
                                    <p class="mb-0">Công ty đã thành lập <strong>20 CLB Võ thuật Karatedo</strong> tập trung nhiều ở Tp Thủ Đức, với số lượng học sinh theo học trên <strong>200 học viên</strong>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-language text-danger fa-2x me-3"></i>
                                        <h3 class="h5 mb-0">Đào Tạo Anh Ngữ</h3>
                                    </div>
                                    <p class="mb-0">Tổ chức các dạng giảng dạy tiếng Anh giao tiếp, luyện IELTS, lớp tiếng Anh du học, XKLD.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <h2 class="h4">Tư Vấn Du Học & XKLD</h2>
                    <p>Công ty tập trung vào du học, đã đưa nhiều học viên sang <strong>Đức, Mỹ</strong>. Đặc biệt là chương trình thực tập sinh Mỹ-Châu Âu, đào tạo nghề và đưa lao động đi Đức.</p>
                    
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="fas fa-flag-usa text-primary fa-2x mb-2"></i>
                                <h5>Chương trình Mỹ</h5>
                                <p class="mb-0">Thực tập sinh & Du học</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="fas fa-flag text-warning fa-2x mb-2"></i>
                                <h5>Chương trình Đức</h5>
                                <p class="mb-0">Du học nghề & XKLD</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="fas fa-globe-europe text-success fa-2x mb-2"></i>
                                <h5>Châu Âu</h5>
                                <p class="mb-0">Thực tập sinh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3">Thông Tin Liên Hệ</h3>
                        <p><i class="fas fa-map-marker-alt me-2 text-danger"></i> TTTM Sóng Thần, Số 1 Đại lộ Độc Lập, Tp.Dĩ An, Bình Dương</p>
                        <p><i class="fas fa-map-marker-alt me-2 text-danger"></i> 73 Đường số 9, khu phố 4, phường Bình Chiểu, Tp.Thủ Đức, TP.HCM</p>
                        <p><i class="fas fa-phone me-2 text-danger"></i> 093.876.2783</p>
                        <p><i class="fas fa-envelope me-2 text-danger"></i> info@dn5sao.edu.vn</p>
                        <p><i class="fas fa-clock me-2 text-danger"></i> Thứ 2 - Thứ 6: 8:00 - 21:00</p>
                        <p class="mb-0"><i class="fas fa-clock me-2 text-danger"></i> Thứ 7 - Chủ Nhật: 9:00 - 17:00</p>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-3">Thành Tựu Nổi Bật</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-building text-primary me-2"></i> 8+ Công ty con và trung tâm</li>
                            <li class="mb-2"><i class="fas fa-fist-raised text-danger me-2"></i> 20+ CLB Võ thuật Karatedo</li>
                            <li class="mb-2"><i class="fas fa-user-graduate me-2"></i> 200+ Học viên võ thuật</li>
                            <li class="mb-2"><i class="fas fa-globe me-2"></i> Đưa học viên du học Đức, Mỹ</li>
                            <li><i class="fas fa-star me-2"></i> Đơn vị giáo dục uy tín 5 sao</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="mb-4">Đội Ngũ Lãnh Đạo</h2>
            </div>
            <div class="col-md-4">
                <div class="card instructor-card">
                    <img src="{{ asset('images/instructor-1.jpg') }}" class="card-img-top instructor-image" alt="Trần Văn Điền">
                    <div class="card-body text-center">
                        <h5 class="card-title">Trần Văn Điền</h5>
                        <p class="text-danger">Giám Đốc Công Ty</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card instructor-card">
                    <img src="{{ asset('images/instructor-2.jpg') }}" class="card-img-top instructor-image" alt="Giám Đốc Đào Tạo">
                    <div class="card-body text-center">
                        <h5 class="card-title">Giám Đốc Đào Tạo</h5>
                        <p class="text-danger">Trưởng Phòng Đào Tạo Quốc Tế</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card instructor-card">
                    <img src="{{ asset('images/instructor-3.jpg') }}" class="card-img-top instructor-image" alt="Giám Đốc Điều Hành">
                    <div class="card-body text-center">
                        <h5 class="card-title">Giám Đốc Điều Hành</h5>
                        <p class="text-danger">Trưởng Phòng Tư Vấn Du Học</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">Sẵn Sàng Tham Gia Cùng Chúng Tôi?</h2>
                    <p class="lead mb-0">Đăng ký ngay hôm nay để trải nghiệm lớp học miễn phí!</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">Đăng Ký Ngay</a>
                </div>
            </div>
        </div>
    </section>
@endsection