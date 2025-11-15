@extends('layouts.main')

@section('title', 'Cấp Chứng Chỉ')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Cấp Chứng Chỉ</h1>
        <p class="lead mb-5">Thông tin về hệ thống cấp chứng chỉ và đai đẳng tại Karate Dojo.</p>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Hệ Thống Đai Đẳng</h2>
                        <p>Tại Karate Dojo, chúng tôi tuân theo hệ thống đai đẳng chuẩn quốc tế của Liên đoàn Karate Thế giới (WKF). Hệ thống bao gồm các cấp đai từ thấp đến cao như sau:</p>
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Cấp đai</th>
                                        <th>Màu đai</th>
                                        <th>Thời gian tối thiểu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>10 Kyu</td>
                                        <td>Trắng</td>
                                        <td>Bắt đầu</td>
                                    </tr>
                                    <tr>
                                        <td>9 Kyu</td>
                                        <td>Trắng-Vàng</td>
                                        <td>3 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>8 Kyu</td>
                                        <td>Vàng</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>7 Kyu</td>
                                        <td>Vàng-Cam</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>6 Kyu</td>
                                        <td>Cam</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>5 Kyu</td>
                                        <td>Cam-Xanh</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>4 Kyu</td>
                                        <td>Xanh</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>3 Kyu</td>
                                        <td>Xanh-Nâu</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>2 Kyu</td>
                                        <td>Nâu</td>
                                        <td>6 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>1 Kyu</td>
                                        <td>Nâu-Đen</td>
                                        <td>1 năm</td>
                                    </tr>
                                    <tr>
                                        <td>1 Dan</td>
                                        <td>Đen</td>
                                        <td>2 năm từ 1 Kyu</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <p class="mt-3">Các cấp đai cao hơn (2 Dan trở lên) sẽ được đánh giá và cấp bởi Liên đoàn Karate Việt Nam và Liên đoàn Karate Thế giới.</p>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Quy Trình Lên Đai</h2>
                        <p>Để được lên đai, học viên cần đáp ứng các yêu cầu sau:</p>
                        
                        <ol>
                            <li>Hoàn thành thời gian tập luyện tối thiểu theo quy định</li>
                            <li>Tham gia đầy đủ các buổi học và có tinh thần tập luyện tốt</li>
                            <li>Nắm vững các kỹ thuật cơ bản (Kihon) của cấp đai hiện tại</li>
                            <li>Thực hiện thành thạo các bài quyền (Kata) theo yêu cầu</li>
                            <li>Đạt yêu cầu trong phần thi đấu tự do (Kumite)</li>
                            <li>Thể hiện tinh thần võ đạo và kỷ luật tốt</li>
                        </ol>
                        
                        <p>Kỳ thi lên đai được tổ chức 3 tháng/lần tại Karate Dojo. Học viên cần đăng ký trước ít nhất 2 tuần để được hướng dẫn ôn tập.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Chứng Chỉ Quốc Tế</h2>
                        <p>Karate Dojo là đơn vị được Liên đoàn Karate Thế giới (WKF) công nhận và cấp phép đào tạo. Các chứng chỉ và đai đẳng được cấp tại Karate Dojo đều được công nhận trên toàn thế giới.</p>
                        
                        <p>Đối với các học viên đạt đai đen (1 Dan trở lên), chúng tôi cấp chứng chỉ quốc tế có giá trị toàn cầu, giúp học viên có thể tham gia giảng dạy hoặc thi đấu tại các quốc gia khác.</p>
                        
                        <p>Ngoài ra, chúng tôi còn cấp các chứng chỉ huấn luyện viên cho những học viên có nguyện vọng trở thành giảng viên Karate chuyên nghiệp.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h3 class="h5 mb-0">Lịch Thi Lên Đai</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Đợt 1:</strong> 15/03/2025</p>
                        <p><strong>Đợt 2:</strong> 15/06/2025</p>
                        <p><strong>Đợt 3:</strong> 15/09/2025</p>
                        <p><strong>Đợt 4:</strong> 15/12/2025</p>
                        <p class="mb-0 text-muted">Lịch có thể thay đổi, vui lòng liên hệ văn phòng để biết thông tin chính xác nhất.</p>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h3 class="h5 mb-0">Phí Thi Lên Đai</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Đai trắng đến đai xanh:</strong> 300.000đ</p>
                        <p><strong>Đai xanh đến đai nâu:</strong> 500.000đ</p>
                        <p><strong>Đai nâu đến đai đen:</strong> 1.000.000đ</p>
                        <p><strong>Đai đen cấp cao hơn:</strong> Liên hệ văn phòng</p>
                        <p class="mb-0 text-muted">Phí bao gồm chứng chỉ và đai mới.</p>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h3 class="h5 mb-0">Đăng Ký Thi Lên Đai</h3>
                    </div>
                    <div class="card-body">
                        <p>Để đăng ký thi lên đai, vui lòng liên hệ văn phòng hoặc điền form dưới đây:</p>
                        <a href="#" class="btn btn-danger w-100">Đăng Ký Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection