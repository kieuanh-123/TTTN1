<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Karate TMA') }} - @yield('title', 'Đăng nhập')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        :root {
            --primary-color: #D10A10;
            --secondary-color: #212529;
            --accent-color: #F8F9FA;
            --text-color: #333333;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/karate-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .auth-card {
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .auth-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
        }
        
        .auth-header::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 15px solid var(--primary-color);
        }
        
        .auth-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.75rem;
        }
        
        .auth-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            color: var(--secondary-color);
        }
        
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(209, 10, 16, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #b00a0a;
            border-color: #b00a0a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(209, 10, 16, 0.3);
        }
        
        .btn-link {
            color: var(--primary-color);
            text-decoration: none !important;
            transition: all 0.3s;
        }
        
        .btn-link:hover {
            color: #b00a0a;
            text-decoration: none !important;
        }
        
        .auth-footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .auth-footer .copyright {
            margin-bottom: 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .home-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none !important;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(209, 10, 16, 0.2);
        }
        
        .home-link:hover {
            background-color: #b00a0a;
            color: white;
            text-decoration: none !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(209, 10, 16, 0.3);
        }
        
        .home-link i {
            font-size: 1rem;
        }
        
        .karate-icon {
            position: absolute;
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .karate-icon i {
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .invalid-feedback {
            color: var(--primary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .alert {
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }
        
        .auth-divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none !important;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none !important;
        }
        
        .social-btn.facebook {
            background-color: #3b5998;
        }
        
        .social-btn.google {
            background-color: #dd4b39;
        }
        
        .social-btn.twitter {
            background-color: #1da1f2;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .auth-card {
                margin: 0 1rem;
            }
            
            .auth-header h2 {
                font-size: 1.5rem;
            }
            
            .auth-body {
                padding: 1.5rem;
            }
            
            .home-link {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
        
        /* Karate belt decoration */
        .belt-decoration {
            position: absolute;
            height: 10px;
            width: 100%;
            background-color: #000;
            bottom: 0;
            z-index: -1;
        }
        
        .belt-decoration::before {
            content: '';
            position: absolute;
            height: 10px;
            width: 100%;
            background-color: var(--primary-color);
            bottom: 15px;
        }
        
        .belt-decoration::after {
            content: '';
            position: absolute;
            height: 10px;
            width: 100%;
            background-color: #000;
            bottom: 30px;
        }

        /* Remove all underlines from links */
        a {
            text-decoration: none !important;
        }

        a:hover {
            text-decoration: none !important;
        }

        /* Ensure text in auth footer has no underlines */
        .auth-footer a {
            text-decoration: none !important;
        }

        .auth-footer a:hover {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="karate-icon">
                <i class="fas fa-fist-raised"></i>
            </div>
            
            <div class="auth-header">
                <h2>{{ config('app.name', 'Karate TMA') }}</h2>
                <p>Trung Tâm Đào Tạo Võ Thuật</p>
            </div>
            
            <div class="auth-body">
                {{ $slot }}
            </div>
            
            <div class="auth-footer">
                <div class="copyright">
                    &copy; {{ date('Y') }} Karate TMA. Đã đăng ký Bản quyền.
                </div>
                <a href="{{ route('home') }}" class="home-link">
                    <i class="fas fa-home"></i>
                    <span>Quay lại trang chủ</span>
                </a>
            </div>
            
            <div class="belt-decoration"></div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
