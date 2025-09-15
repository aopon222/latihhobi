<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'LatihHobi') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #4a5568;
            min-height: 100vh;
            color: white;
        }

        /* Navbar Styles */
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-custom .navbar-brand {
            color: #1a202c !important;
        }

        /* Logo Styles */
        .logo-container {
            display: flex;
            flex-direction: column;
        }

        .logo-ai {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 2px;
        }

        .logo-text {
            color: #22d3ee;
            font-weight: bold;
            font-size: 1.3rem;
            line-height: 1;
        }

        .logo-subtext {
            display: block;
            font-size: 0.7rem;
            color: #f59e0b;
            line-height: 1;
        }

        /* Navigation Links */
        .navbar-custom .nav-link {
            color: #64748b !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #f59e0b !important;
            background-color: #fef3c7;
        }

        /* Specific nav link colors */
        .nav-home.active {
            color: #f59e0b !important;
            background-color: #fef3c7;
        }

        .nav-home.active .bi-house-door-fill {
            color: #f59e0b;
        }

        .nav-regular:hover {
            color: #f59e0b !important;
        }

        .nav-ecourse .bi-play-fill {
            color: #22d3ee;
        }

        .nav-event .bi-calendar-event {
            color: #f59e0b;
        }

        /* Right side icons */
        .nav-search, .nav-cart {
            color: #f59e0b !important;
        }

        .nav-signin {
            color: #64748b !important;
        }

        .nav-signin:hover {
            color: #f59e0b !important;
        }

        /* Sign up button */
        .btn-signup {
            background-color: #22d3ee;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 16px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            background-color: #0891b2;
            color: #fff;
            transform: translateY(-1px);
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .dropdown-item:hover {
            background-color: #fef3c7;
            color: #f59e0b;
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            padding: 100px 0 80px 0;
            color: white;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 50px;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-cta {
            display: inline-block;
            background: #22d3ee;
            color: white;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 211, 238, 0.3);
            text-transform: uppercase;
        }

        .btn-cta:hover {
            background: #0891b2;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 211, 238, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Features Section */
        .features-section {
            padding: 60px 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-top: 40px;
        }

        .feature-card {
            background: #22d3ee;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s ease;
            color: white;
            cursor: pointer;
        }

        .feature-card:hover {
            background: #0891b2;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(34, 211, 238, 0.3);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 80px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-description {
                font-size: 16px;
                padding: 0 20px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .feature-card {
                padding: 25px 15px;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .feature-title {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .features-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .hero-section {
                padding: 60px 0;
            }

            .hero-title {
                font-size: 28px;
            }

            .btn-cta {
                padding: 12px 30px;
                font-size: 16px;
            }
        }

        /* Override Bootstrap container */
        .container {
            max-width: 1200px;
        }

        /* Remove Bootstrap's margin-top from container */
        body > .container {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
    @include('layout.navbar')

    @yield('content')

    <footer>
        <div class="container">
            <p>&copy; 2024 Latihhobi. Semua hak dilindungi undang-undang.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling untuk navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Interactive Feature Cards
        document.addEventListener('DOMContentLoaded', function() {
            const featureCards = document.querySelectorAll('.feature-card');
            const detailContents = document.querySelectorAll('.detail-content');
            
            // Show first detail by default
            if (detailContents.length > 0) {
                detailContents[0].style.display = 'block';
                detailContents[0].classList.add('active');
                featureCards[0].classList.add('active');
            }
            
            featureCards.forEach((card, index) => {
                card.addEventListener('click', function() {
                    // Remove active class from all cards
                    featureCards.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked card
                    this.classList.add('active');
                    
                    // Hide all detail contents
                    detailContents.forEach(content => {
                        content.classList.remove('active');
                        setTimeout(() => {
                            content.style.display = 'none';
                        }, 300);
                    });
                    
                    // Show corresponding detail content
                    setTimeout(() => {
                        if (detailContents[index]) {
                            detailContents[index].style.display = 'block';
                            setTimeout(() => {
                                detailContents[index].classList.add('active');
                            }, 50);
                        }
                    }, 300);
                });
                
                // Hover effects
                card.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateY(-5px)';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        // Observe detail sections
        document.querySelectorAll('.detail-content').forEach(content => {
            observer.observe(content);
        });
    </script>
</body>
</html>