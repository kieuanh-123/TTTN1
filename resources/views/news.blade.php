@extends('layouts.main')

@section('title', 'Tin Tức')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Tin Tức</h1>
        <p class="lead mb-5">Cập nhật những tin tức mới nhất về Karate TMA và các sự kiện võ thuật.</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card news-card">
                    <img src="{{ asset('images/news-1.jpg') }}" class="card-img-top news-image" alt="Tin tức 1">
                    <div class="card-body">
                        <p class="news-date">15/05/2023</p>
                        <h5 class="card-title">Giải Vô Địch Karate Toàn Quốc 2023</h5>
                        <p class="card-text">Học viên của chúng tôi đã giành được 5 huy chương vàng tại Giải Vô Địch Karate Toàn Quốc.</p>
                        <a href="{{ route('news.show', 1) }}" class="btn btn-outline-danger">Đọc thêm</a>
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
                        <a href="{{ route('news.show', 2) }}" class="btn btn-outline-danger">Đọc thêm</a>
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
                        <a href="{{ route('news.show', 3) }}" class="btn btn-outline-danger">Đọc thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection