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
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .logo:hover {
            opacity: 0.8;
        }

        .logo-img {
            height: 50px;
            width: auto;
            margin-right: 15px;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-tagline {
            font-size: 0.8rem;
            color: #666;
            font-weight: 500;
            margin-top: 2px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-item a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
            font-size: 1rem;
        }

        .nav-item a:hover,
        .nav-item a.active {
            color: #007bff;
        }

        .nav-item a.active::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #007bff;
        }

        .dropdown-arrow {
            font-size: 0.7rem;
            margin-left: 5px;
        }

        /* Dropdown Menu */
        .nav-item.dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 8px;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            padding: 0.5rem 0;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            transition: background 0.3s ease;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: #007bff;
        }

        .dropdown-icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-icon {
            color: #333;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .user-icon:hover {
            color: #007bff;
        }

        .btn-signin {
            color: #007bff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .btn-signin:hover {
            background: #e6f7ff;
        }

        .btn-signup {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .btn-signup:hover {
            background: #0056b3;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-start:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
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

        /* Ekskul Reguler Page Styles */
        .ekskul-hero {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
        }

        .ekskul-hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: -0.02em;
        }

        .ekskul-section {
            padding: 4rem 5%;
            background: white;
        }

        .ekskul-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .ekskul-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .ekskul-item {
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .ekskul-item:hover {
            transform: translateY(-5px);
        }

        .ekskul-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 3px solid #e9ecef;
        }

        .ekskul-icon-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .ekskul-item h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .galeri-section {
            padding: 4rem 5%;
            background: #f8f9fa;
        }

        .galeri-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .galeri-container h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .galeri-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .galeri-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .galeri-item:hover .galeri-img {
            transform: scale(1.05);
        }

        .social-section {
            padding: 3rem 5%;
            background: white;
            text-align: center;
        }

        .social-container h2 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .social-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.1);
        }

        .instagram {
            background: #E4405F;
            color: white;
        }

        .facebook {
            background: #1877F2;
            color: white;
        }

        .youtube {
            background: #FF0000;
            color: white;
        }

        .footer {
            background: #2d3748;
            color: white;
            padding: 2rem 5%;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-right {
            display: flex;
            gap: 1rem;
        }

        .footer-social {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: opacity 0.3s ease;
        }

        .footer-social:hover {
            opacity: 0.7;
        }

        /* E-Course Page Styles */
        .ecourse-hero {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
        }

        .ecourse-hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .ecourse-hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .ecourse-categories {
            padding: 4rem 5%;
            background: white;
        }

        .ecourse-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .ecourse-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .ecourse-category {
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .ecourse-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .category-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 3px solid #e9ecef;
        }

        .category-icon-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .ecourse-category h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .ecourse-category p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .btn-category {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-category:hover {
            background: #0056b3;
        }

        .products-section {
            padding: 4rem 5%;
            background: #f8f9fa;
        }

        .products-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .products-container h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            text-align: center;
            margin-bottom: 1rem;
        }

        .product-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .product-info h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .product-author {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-price {
            margin-bottom: 1rem;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .current-price {
            color: #007bff;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-add-cart {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        .btn-add-cart:hover {
            background: #218838;
        }

        .coming-soon-section {
            padding: 4rem 5%;
            background: white;
        }

        .coming-soon-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .coming-soon-container h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
        }

        .coming-soon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .coming-soon-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            position: relative;
            border: 2px dashed #dee2e6;
        }

        .coming-soon-badge {
            background: #ffc107;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .coming-soon-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin: 1rem 0 0.5rem;
        }

        .coming-soon-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .btn-enroll {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: not-allowed;
            width: 100%;
            opacity: 0.6;
        }

        /* Event Page Styles */
        .event-hero {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            text-align: center;
            padding: 8rem 5% 4rem;
            margin-top: 70px;
        }

        .event-hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .event-hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .event-categories {
            padding: 4rem 5%;
            background: white;
        }

        .event-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .event-category {
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .event-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .event-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 3px solid #e9ecef;
        }

        .event-emoji {
            font-size: 3rem;
        }

        .event-category h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .event-category p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .btn-event {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-event:hover {
            background: #0056b3;
        }

        .upcoming-events {
            padding: 4rem 5%;
            background: #f8f9fa;
        }

        .upcoming-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .upcoming-container h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
            text-align: center;
        }

        .events-timeline {
            max-width: 800px;
            margin: 0 auto;
        }

        .event-item {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .event-date {
            background: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin-right: 1.5rem;
            min-width: 80px;
        }

        .event-date .month {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .event-date .day {
            display: block;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .event-details {
            flex: 1;
        }

        .event-details h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .event-details p {
            color: #666;
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .event-status {
            background: #28a745;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .event-status:contains("Coming Soon") {
            background: #ffc107;
            color: #212529;
        }

        /* Private Class Section */
        .private-class {
            padding: 4rem 5%;
            background: #2d3748;
            color: white;
        }

        .private-class-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .private-class-container h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .private-class-container p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .private-class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .private-class-item {
            background: white;
            color: #333;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .private-class-item:hover {
            transform: translateY(-5px);
        }

        .private-class-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 3px solid #e9ecef;
        }

        .private-class-icon-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .private-class-item h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
        }

        /* Komunitas & Club Section */
        .komunitas-club {
            padding: 4rem 5%;
            background: white;
        }

        .komunitas-club-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .komunitas-club-container h2 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 2rem;
        }

        .komunitas-club-container p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .komunitas-club-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .komunitas-club-item {
            background: #2d3748;
            color: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            position: relative;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .club-badge {
            background: #ffc107;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .komunitas-club-item h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn-club {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
            margin-top: 1rem;
        }

        .btn-club:hover {
            background: #0056b3;
        }

        .btn-club:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Bootcamp & Workshop Section */
        .bootcamp-workshop {
            padding: 4rem 5%;
            background: #2d3748;
            color: white;
        }

        .bootcamp-workshop-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .bootcamp-workshop-container h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .bootcamp-workshop-container p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .workshop-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .workshop-card {
            background: white;
            color: #333;
            padding: 2rem;
            border-radius: 12px;
            text-align: left;
            position: relative;
            border: 2px solid #e9ecef;
        }

        .workshop-card.coming-soon {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
        }

        .workshop-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .workshop-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #007bff;
        }

        .workshop-badge {
            background: #28a745;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .workshop-badge-coming {
            background: #ffc107;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .workshop-card h4 {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .workshop-card p {
            color: #666;
            margin-bottom: 1rem;
        }

        .workshop-details {
            margin-bottom: 1.5rem;
        }

        .workshop-date, .workshop-time {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .date-icon, .time-icon {
            margin-right: 0.5rem;
        }

        .btn-register {
            background: #ff6b35;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        .btn-register:hover {
            background: #e55a2b;
        }

        /* Podcast Section */
        .podcast-section {
            padding: 4rem 5%;
            background: #007bff;
            color: white;
        }

        .podcast-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .podcast-container h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 3rem;
        }

        .podcast-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .podcast-item {
            background: white;
            color: #333;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .podcast-item:hover {
            transform: translateY(-5px);
        }

        .podcast-thumbnail {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .play-button {
            font-size: 3rem;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .podcast-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 1rem;
            text-align: left;
        }

        .podcast-overlay h4 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.3rem;
        }

        .podcast-overlay p {
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .podcast-overlay span {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .podcast-info {
            padding: 1.5rem;
            text-align: left;
        }

        .podcast-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .podcast-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .btn-subscribe {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-subscribe:hover {
            background: #c82333;
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