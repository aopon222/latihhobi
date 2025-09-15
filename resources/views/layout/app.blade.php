<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LatihHobi - Platform Pembelajaran')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #4a5568;
        }

        /* Header Styles */
        .header {
            background: white;
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
            font-size: 1.5rem;
            font-weight: 700;
            color: #17a2b8;
        }

        .logo::before {
            content: "📚";
            margin-right: 0.5rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-item a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-item a:hover,
        .nav-item a.active {
            color: #17a2b8;
        }

        .nav-item a.active::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #17a2b8;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-signin {
            color: #17a2b8;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-signin:hover {
            background: #e6f7ff;
        }

        .btn-signup {
            background: #17a2b8;
            color: white;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-signup:hover {
            background: #138496;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 50%, #1a202c 100%);
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            line-height: 1.8;
        }

        .btn-start {
            background: #17a2b8;
            color: white;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-start:hover {
            background: #138496;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(23, 162, 184, 0.3);
        }

        /* Services Section */
        .services {
            padding: 4rem 5%;
            background: #f8fafc;
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .service-card {
            background: #17a2b8;
            color: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.2);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(23, 162, 184, 0.3);
        }

        .service-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .service-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .service-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* About Section */
        .about {
            padding: 4rem 5%;
            background: white;
        }

        .about-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .about h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
        }

        .about p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .btn-show-all {
            background: #2d3748;
            color: white;
            text-decoration: none;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .btn-show-all:hover {
            background: #1a202c;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 3%;
            }

            .nav-menu {
                display: none;
            }

            .hero {
                padding: 6rem 3% 3rem;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .services-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }

            .service-card {
                padding: 1.5rem;
            }

            .services, .about {
                padding: 3rem 3%;
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
            observer.observe(e