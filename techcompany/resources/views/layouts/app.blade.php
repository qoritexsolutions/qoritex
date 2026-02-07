<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TechCompany - Innovative Technology Solutions for Your Business">
    <title>@yield('title', 'TechCompany') - Innovative Technology Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --accent: #f43f5e;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --gray: #64748b;
            --gray-light: #94a3b8;
            --light: #f1f5f9;
            --white: #ffffff;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #0ea5e9 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius: 12px;
            --radius-lg: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: var(--white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 1rem 2rem;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.75rem 2rem;
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
        }

        .nav-links>li {
            position: relative;
        }

        .nav-links a {
            color: var(--gray-light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--white);
        }

        .nav-links>li>a::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-links>li>a:hover::after,
        .nav-links>li>a.active::after {
            width: 100%;
        }

        /* Mega Menu Trigger */
        .has-mega-menu>a {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .has-mega-menu>a i {
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .has-mega-menu:hover>a i {
            transform: rotate(180deg);
        }

        /* Mega Menu */
        .mega-menu {
            position: fixed;
            top: 100%;
            left: 0;
            right: 0;
            width: 100%;
            background: #0f172a;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .has-mega-menu:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mega-menu-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0;
            display: flex;
        }

        /* Mega Menu Categories (Left Side) */
        .mega-menu-categories {
            width: 280px;
            background: #1e293b;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem 0;
            flex-shrink: 0;
        }

        .mega-menu-categories h3 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--gray);
            padding: 0.75rem 1.5rem;
            margin-bottom: 0.5rem;
        }

        .category-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .category-item:hover,
        .category-item.active {
            background: rgba(99, 102, 241, 0.1);
            border-left-color: var(--primary);
        }

        .category-item i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            border-radius: 10px;
            font-size: 1rem;
            color: var(--white);
        }

        .category-item-content h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 0.15rem;
        }

        .category-item-content p {
            font-size: 0.8rem;
            color: var(--gray-light);
        }

        .category-item .arrow {
            margin-left: auto;
            color: var(--gray);
            font-size: 0.8rem;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .category-item:hover .arrow,
        .category-item.active .arrow {
            opacity: 1;
            transform: translateX(0);
        }

        /* Mega Menu Content (Right Side) */
        .mega-menu-content {
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 400px;
        }

        .mega-menu-content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .mega-menu-content-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .mega-menu-content-header a {
            color: var(--primary-light);
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
        }

        .mega-menu-content-header a:hover {
            color: var(--white);
        }

        /* Services Grid */
        .mega-menu-services {
            display: none;
        }

        .mega-menu-services.active {
            display: block;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        .mega-service-card {
            display: flex;
            gap: 1rem;
            padding: 1.25rem;
            border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid transparent;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .mega-service-card:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-2px);
        }

        .mega-service-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            border-radius: 12px;
            font-size: 1.25rem;
            color: var(--white);
            flex-shrink: 0;
        }

        .mega-service-info {
            flex: 1;
        }

        .mega-service-info h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 0.35rem;
        }

        .mega-service-info p {
            font-size: 0.8rem;
            color: var(--gray-light);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Featured Section in Mega Menu */
        .mega-menu-featured {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .mega-menu-featured h4 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--gray);
            margin-bottom: 1rem;
        }

        .featured-links {
            display: flex;
            gap: 2rem;
        }

        .featured-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--gray-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .featured-link:hover {
            color: var(--primary-light);
        }

        .featured-link i {
            color: var(--primary);
        }

        .nav-cta {
            padding: 0.75rem 1.75rem;
            background: var(--gradient-primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title span {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--gray-light);
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background: var(--dark-light);
            padding: 5rem 0 2rem;
            margin-top: 6rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(3, 1fr);
            gap: 4rem;
            margin-bottom: 4rem;
        }

        .footer-brand p {
            color: var(--gray-light);
            margin: 1.5rem 0;
            line-height: 1.8;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            color: var(--gray-light);
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .footer-column h4 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 0.75rem;
        }

        .footer-column a {
            color: var(--gray-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-column a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .mega-menu {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--dark-light);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
            }

            .nav-links.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-cta {
                display: none;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .has-mega-menu>a i {
                display: none;
            }
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .alert-error {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.3);
            color: #f43f5e;
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">TechCompany</a>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
                <li class="has-mega-menu">
                    <a href="{{ route('services') }}" class="{{ request()->routeIs('services*') ? 'active' : '' }}">
                        Services <i class="fas fa-chevron-down"></i>
                    </a>
                    <!-- Mega Menu -->
                    <div class="mega-menu">
                        <div class="mega-menu-inner">
                            <!-- Categories (Left Side) -->
                            <div class="mega-menu-categories">
                                <h3>Service Categories</h3>
                                <div class="category-item active" data-category="development">
                                    <i class="fas fa-code"></i>
                                    <div class="category-item-content">
                                        <h4>Development</h4>
                                        <p>Web & Mobile Apps</p>
                                    </div>
                                    <i class="fas fa-chevron-right arrow"></i>
                                </div>
                                <div class="category-item" data-category="cloud">
                                    <i class="fas fa-cloud"></i>
                                    <div class="category-item-content">
                                        <h4>Cloud & DevOps</h4>
                                        <p>Infrastructure & CI/CD</p>
                                    </div>
                                    <i class="fas fa-chevron-right arrow"></i>
                                </div>
                                <div class="category-item" data-category="ai">
                                    <i class="fas fa-brain"></i>
                                    <div class="category-item-content">
                                        <h4>AI & Data</h4>
                                        <p>Machine Learning & Analytics</p>
                                    </div>
                                    <i class="fas fa-chevron-right arrow"></i>
                                </div>
                                <div class="category-item" data-category="design">
                                    <i class="fas fa-palette"></i>
                                    <div class="category-item-content">
                                        <h4>Design & UX</h4>
                                        <p>UI/UX & Branding</p>
                                    </div>
                                    <i class="fas fa-chevron-right arrow"></i>
                                </div>
                            </div>

                            <!-- Services Content (Right Side) -->
                            <div class="mega-menu-content">
                                <!-- Development Services -->
                                <div class="mega-menu-services active" id="category-development">
                                    <div class="mega-menu-content-header">
                                        <h3>Development Services</h3>
                                        <a href="{{ route('services') }}">View All Services <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="services-grid">
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-laptop-code"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Web Development</h4>
                                                <p>Custom websites and web applications built with modern technologies
                                                    like Laravel, React, and Vue.js.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Mobile Development</h4>
                                                <p>Native and cross-platform mobile apps for iOS and Android using React
                                                    Native and Flutter.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>E-Commerce Solutions</h4>
                                                <p>Scalable online stores with payment integration, inventory
                                                    management, and analytics.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>API Development</h4>
                                                <p>RESTful and GraphQL APIs for seamless integration between systems and
                                                    applications.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-database"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Database Design</h4>
                                                <p>Optimized database architecture for performance, scalability, and
                                                    data integrity.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-plug"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>System Integration</h4>
                                                <p>Connect your tools and platforms for unified workflows and data
                                                    synchronization.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- Cloud Services -->
                                <div class="mega-menu-services" id="category-cloud">
                                    <div class="mega-menu-content-header">
                                        <h3>Cloud & DevOps Services</h3>
                                        <a href="{{ route('services') }}">View All Services <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="services-grid">
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fab fa-aws"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>AWS Solutions</h4>
                                                <p>Comprehensive AWS infrastructure setup, migration, and optimization
                                                    services.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fab fa-docker"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Container & Kubernetes</h4>
                                                <p>Docker containerization and Kubernetes orchestration for scalable
                                                    deployments.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-infinity"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>CI/CD Pipelines</h4>
                                                <p>Automated build, test, and deployment pipelines for faster releases.
                                                </p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Cloud Security</h4>
                                                <p>Security audits, compliance, and best practices for cloud
                                                    infrastructure.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-server"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Server Management</h4>
                                                <p>24/7 monitoring, maintenance, and optimization of your servers.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-sync-alt"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Disaster Recovery</h4>
                                                <p>Backup strategies and disaster recovery plans to protect your data.
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- AI Services -->
                                <div class="mega-menu-services" id="category-ai">
                                    <div class="mega-menu-content-header">
                                        <h3>AI & Data Services</h3>
                                        <a href="{{ route('services') }}">View All Services <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="services-grid">
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-robot"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Machine Learning</h4>
                                                <p>Custom ML models for prediction, classification, and automation.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>AI Chatbots</h4>
                                                <p>Intelligent conversational AI for customer support and engagement.
                                                </p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Data Analytics</h4>
                                                <p>Transform raw data into actionable insights with advanced analytics.
                                                </p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Computer Vision</h4>
                                                <p>Image recognition, object detection, and visual AI solutions.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-language"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>NLP Solutions</h4>
                                                <p>Natural language processing for text analysis and understanding.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-project-diagram"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Data Engineering</h4>
                                                <p>Build robust data pipelines and warehouses for big data processing.
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- Design Services -->
                                <div class="mega-menu-services" id="category-design">
                                    <div class="mega-menu-content-header">
                                        <h3>Design & UX Services</h3>
                                        <a href="{{ route('services') }}">View All Services <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="services-grid">
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-pencil-ruler"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>UI/UX Design</h4>
                                                <p>User-centered designs that are beautiful, intuitive, and
                                                    conversion-focused.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Design Systems</h4>
                                                <p>Scalable component libraries and design tokens for consistency.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-object-group"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Prototyping</h4>
                                                <p>Interactive prototypes to validate ideas before development.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-paint-brush"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Brand Identity</h4>
                                                <p>Logo design, color palettes, and complete brand guidelines.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>User Research</h4>
                                                <p>Understand your users through interviews, surveys, and testing.</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('services') }}" class="mega-service-card">
                                            <div class="mega-service-icon">
                                                <i class="fas fa-universal-access"></i>
                                            </div>
                                            <div class="mega-service-info">
                                                <h4>Accessibility</h4>
                                                <p>WCAG-compliant designs ensuring access for all users.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- Featured Links -->
                                <div class="mega-menu-featured">
                                    <h4>Quick Links</h4>
                                    <div class="featured-links">
                                        <a href="{{ route('projects') }}" class="featured-link">
                                            <i class="fas fa-folder-open"></i> View Our Projects
                                        </a>
                                        <a href="{{ route('contact') }}" class="featured-link">
                                            <i class="fas fa-comments"></i> Get a Free Consultation
                                        </a>
                                        <a href="{{ route('team') }}" class="featured-link">
                                            <i class="fas fa-users"></i> Meet Our Team
                                        </a>
                                        <a href="{{ route('courses.index') }}" class="featured-link">
                                            <i class="fas fa-graduation-cap"></i> Our Courses
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="{{ route('projects') }}"
                        class="{{ request()->routeIs('projects*') ? 'active' : '' }}">Projects</a></li>
                <li><a href="{{ route('courses.index') }}"
                        class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">Courses</a></li>
                <li><a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'active' : '' }}">Team</a>
                </li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            <a href="{{ route('contact') }}" class="nav-cta">Get Started</a>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="logo">TechCompany</a>
                    <p>We're a team of passionate developers, designers, and strategists dedicated to helping businesses
                        succeed in the digital world.</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('team') }}">Our Team</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('projects') }}">Projects</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Mobile Apps</a></li>
                        <li><a href="#">Cloud Solutions</a></li>
                        <li><a href="{{ route('courses.index') }}">Training & Courses</a></li>
                        <li><a href="#">AI & ML</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact</h4>
                    <ul>
                        <li><a href="mailto:hello@techcompany.com">hello@techcompany.com</a></li>
                        <li><a href="tel:+1234567890">+1 (234) 567-890</a></li>
                        <li><a href="{{ route('contact') }}">Contact Form</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} TechCompany. All rights reserved.</p>
                <p>Crafted with <i class="fas fa-heart" style="color: var(--accent);"></i> for innovation</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Mega Menu Category Switching
        const categoryItems = document.querySelectorAll('.category-item');
        const servicesSections = document.querySelectorAll('.mega-menu-services');

        categoryItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const category = this.dataset.category;

                // Remove active from all categories
                categoryItems.forEach(cat => cat.classList.remove('active'));
                // Add active to current
                this.classList.add('active');

                // Hide all service sections
                servicesSections.forEach(section => section.classList.remove('active'));
                // Show selected section
                const targetSection = document.getElementById('category-' + category);
                if (targetSection) {
                    targetSection.classList.add('active');
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    </script>
    @yield('scripts')
</body>

</html>
