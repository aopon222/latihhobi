<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LatihHobi - Platform Pembelajaran')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #00a8e6 0%, #0080b8 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logo i {
            margin-right: 10px;
            background: white;
            color: #00a8e6;
            padding: 8px;
            border-radius: 50%;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-item a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .nav-item a:hover,
        .nav-item a.active {
            color: #e0f7ff;
        }

        .nav-item a.active::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: white;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-signin, .btn-signup {
            padding: 8px 20px;
            border: 2px solid white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-signin {
            color: white;
            background: transparent;
        }

        .btn-signup {
            background: white;
            color: #00a8e6;
        }

        .btn-signin:hover {
            background: white;
            color: #00a8e6;
        }

        .btn-signup:hover {
            background: transparent;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            text-align: center;
            padding: 100px 5% 80px;
            margin-top: 70px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 2px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.8;
        }

        .btn-start {
            background: #00a8e6;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,168,230,0.3);
        }

        .btn-start:hover {
            background: #0080b8;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,168,230,0.4);
        }

        /* Services Section */
        .services {
            padding: 80px 5%;
            background: #f8f9fa;
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .service-card {
            background: #00a8e6;
            color: white;
            padding: 2rem 1.5rem;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,168,230,0.3);
            background: #0080b8;
        }

        .service-icon i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .service-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .service-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Jadwal Reguler Section */
        .jadwal-section {
            padding: 80px 5%;
            background: white;
        }

        .jadwal-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .jadwal-section h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .jadwal-section p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .btn-lihat-jadwal {
            background: transparent;
            color: #00a8e6;
            border: 2px solid #00a8e6;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .btn-lihat-jadwal:hover {
            background: #00a8e6;
            color: white;
        }

        /* Private Class Section */
        .private-class {
            padding: 80px 5%;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
        }

        .private-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .private-class h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .private-class p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .private-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .private-card {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }

        .private-card:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.2);
        }

        .private-card-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .private-card-image i {
            font-size: 4rem;
            color: white;
        }

        .private-card-content {
            padding: 1.5rem;
        }

        .private-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        /* E-Course Section */
        .ecourse-section {
            padding: 80px 5%;
            background: linear-gradient(135deg, #00a8e6 0%, #0080b8 100%);
            color: white;
        }

        .ecourse-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .ecourse-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .ecourse-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .ecourse-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .ecourse-card {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .ecourse-card:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.2);
        }

        .ecourse-card-image {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
        }

        .ecourse-card-image.robotik {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }

        .ecourse-card-image.komik {
            background: linear-gradient(135deg, #4ecdc4 0%, #26a69a 100%);
        }

        .ecourse-card-image.film {
            background: linear-gradient(135deg, #ffe66d 0%, #ff6b35 100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 3%;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-menu {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .hero {
                padding: 80px 3% 60px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .services-grid, .private-cards, .ecourse-cards {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }

            .service-card {
                padding: 1.5rem 1rem;
            }

            .service-icon i {
                font-size: 2rem;
            }

            .services, .jadwal-section, .private-class, .ecourse-section {
                padding: 60px 3%;
            }

            .jadwal-section h2, .private-class h2, .ecourse-section h2 {
                font-size: 2rem;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    @yield('content')

    <script>
        // Simple scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });

        // Add hover effect to service cards
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.background = '#0080b8';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.background = '#00a8e6';
            });
        });
    </script>
</body>
</html>