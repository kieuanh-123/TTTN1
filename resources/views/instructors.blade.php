@extends('layouts.main')

@section('title', 'Đội Ngũ Giảng Dạy')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Đội Ngũ Giảng Dạy</h1>
        <p class="lead mb-5">Đội ngũ giảng dạy của chúng tôi gồm các võ sư có nhiều năm kinh nghiệm và được chứng nhận quốc tế.</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card instructor-card">
                    <img src="{{ asset('images/hlv-npny.png') }}" class="card-img-top instructor-image" alt="Nguyễn Phạm Ngọc Yến">
                    <div class="card-body">
                        <h5 class="card-title">Nguyễn Phạm Ngọc Yến</h5>
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
    </div>
@endsection