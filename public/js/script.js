// Xử lý thông báo thành công tự động ẩn sau 3 giây
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-success');
    
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 1s';
            alert.style.opacity = '0';
            
            setTimeout(function() {
                alert.style.display = 'none';
            }, 1000);
        }, 3000);
    });
});

// Thêm vào file script.js hiện có

// Hiệu ứng khi cuộn trang cho header
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.main-header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Xử lý active menu item dựa trên URL hiện tại
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('.navbar-nav .nav-link');
    
    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href === currentLocation || (href === '/' && currentLocation === '/home')) {
            item.classList.add('active');
        }
    });
});