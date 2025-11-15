document.addEventListener('DOMContentLoaded', function() {
    // Dark mode toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
    const htmlElement = document.documentElement;
    
    function toggleDarkMode() {
        if (htmlElement.className === 'dark') {
            htmlElement.className = 'light';
            localStorage.setItem('theme', 'light');
        } else {
            htmlElement.className = 'dark';
            localStorage.setItem('theme', 'dark');
        }
    }
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', toggleDarkMode);
    }
    
    if (darkModeToggleMobile) {
        darkModeToggleMobile.addEventListener('click', toggleDarkMode);
    }
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Header scroll effect
    const header = document.querySelector('header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Scroll animations
    function revealOnScroll() {
        const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        
        for (let i = 0; i < reveals.length; i++) {
            const windowHeight = window.innerHeight;
            const elementTop = reveals[i].getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add('active');
            } else {
                reveals[i].classList.remove('active');
            }
        }
        
        // Staggered animations
        const staggerContainers = document.querySelectorAll('.stagger-container');
        
        staggerContainers.forEach(container => {
            const windowHeight = window.innerHeight;
            const containerTop = container.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (containerTop < windowHeight - elementVisible) {
                const items = container.querySelectorAll('.stagger-item');
                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.add('active');
                    }, 100 * index);
                });
            }
        });
    }
    
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Initial check on page load
    
    // Scroll to top button
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('active');
            } else {
                scrollToTopBtn.classList.remove('active');
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Parallax effect for hero section
    const heroSection = document.querySelector('.hero-image');
    
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.pageYOffset;
            heroSection.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
        });
    }
    
    // Counter animation
    function animateCounter(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    const counters = document.querySelectorAll('.counter');
    
    function startCounters() {
        counters.forEach(counter => {
            if (!counter.classList.contains('counted')) {
                const windowHeight = window.innerHeight;
                const elementTop = counter.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, 0, target, 2000);
                    counter.classList.add('counted'); // Add class to prevent recounting
                }
            }
        });
    }
    
    window.addEventListener('scroll', startCounters);
    
    // Check if counters are in view on page load
    setTimeout(startCounters, 500);
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
    
    // Image lazy loading with fade-in effect
    const lazyImages = document.querySelectorAll('.lazy-image');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('fade-in');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers without IntersectionObserver support
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
        });
    }
    
    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.btn-primary, .btn-secondary, .cta-button');
    
    buttons.forEach(button => {
        button.classList.add('ripple');
        
        button.addEventListener('click', function(e) {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Animate elements when they come into view
    const animatedElements = document.querySelectorAll('[data-animation]');
    
    if ('IntersectionObserver' in window) {
        const animationObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const animation = element.dataset.animation;
                    
                    element.classList.add(`animate-${animation}`);
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(element => {
            animationObserver.observe(element);
        });
    } else {
        // Fallback for browsers without IntersectionObserver support
        animatedElements.forEach(element => {
            const animation = element.dataset.animation;
            element.classList.add(`animate-${animation}`);
        });
    }
});