@extends('layouts.app')

@section('title', 'Innovative Technology Solutions')

@section('styles')
    <style>
        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 8rem 0 4rem;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            border-radius: 50%;
            animation: pulse 10s ease-in-out infinite reverse;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .hero-badge i {
            font-size: 0.75rem;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero h1 span {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.25rem;
            color: var(--gray-light);
            line-height: 1.8;
            margin-bottom: 2rem;
            max-width: 540px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .hero-visual {
            position: relative;
        }

        .hero-image {
            width: 100%;
            height: 500px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            color: rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .hero-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .floating-card {
            position: absolute;
            background: rgba(30, 41, 59, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        .floating-card.card-1 {
            top: 20%;
            left: -30px;
            animation-delay: 0s;
        }

        .floating-card.card-2 {
            bottom: 20%;
            right: -30px;
            animation-delay: 1.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .floating-card-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--white);
        }

        .floating-card-text h4 {
            font-size: 0.9rem;
            margin-bottom: 0.125rem;
        }

        .floating-card-text p {
            font-size: 0.8rem;
            color: var(--gray);
        }

        /* Clients Section */
        .clients-section {
            padding: 4rem 0;
            background: var(--dark-light);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .clients-label {
            text-align: center;
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .clients-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4rem;
            flex-wrap: wrap;
        }

        .client-logo {
            font-size: 2rem;
            color: var(--gray);
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .client-logo:hover {
            color: var(--white);
            opacity: 1;
        }

        /* Services Section */
        .services-section {
            padding: 8rem 0;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .service-card {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: var(--white);
            margin-bottom: 1.5rem;
            transition: transform 0.4s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .service-card h3 {
            font-size: 1.35rem;
            margin-bottom: 1rem;
        }

        .service-card p {
            color: var(--gray-light);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .service-link {
            color: var(--primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* About Section */
        .about-section {
            padding: 8rem 0;
            background: var(--dark-light);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-images {
            position: relative;
        }

        .about-image-main {
            width: 100%;
            height: 450px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            color: rgba(255, 255, 255, 0.2);
        }

        .about-image-small {
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
            border-radius: var(--radius-lg);
            border: 5px solid var(--dark-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.3);
        }

        .experience-badge {
            position: absolute;
            top: -20px;
            left: -20px;
            background: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            padding: 1.5rem;
            text-align: center;
        }

        .experience-badge .number {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .experience-badge .text {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .about-content h2 {
            font-size: 2.75rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .about-content>p {
            color: var(--gray-light);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .about-feature {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .about-feature i {
            width: 40px;
            height: 40px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .about-feature span {
            font-weight: 500;
        }

        /* Projects Section */
        .projects-section {
            padding: 8rem 0;
        }

        .projects-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 3rem;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .project-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 4/3;
            background: var(--gradient-primary);
        }

        .project-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .project-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(15, 23, 42, 0.95) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .project-card:hover .project-overlay {
            opacity: 1;
        }

        .project-card:hover img {
            transform: scale(1.1);
        }

        .project-category {
            color: var(--primary-light);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .project-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .project-desc {
            color: var(--gray-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .project-link {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 8rem 0;
            background: var(--dark-light);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .testimonial-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            transition: all 0.4s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .testimonial-rating {
            display: flex;
            gap: 0.25rem;
            margin-bottom: 1.5rem;
        }

        .testimonial-rating i {
            color: #fbbf24;
        }

        .testimonial-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray-light);
            margin-bottom: 2rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 55px;
            height: 55px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            overflow: hidden;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 1.1rem;
            margin-bottom: 0.125rem;
        }

        .author-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-primary);
            opacity: 0.1;
        }

        .cta-content {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-content h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .cta-content p {
            font-size: 1.25rem;
            color: var(--gray-light);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {

            .hero-grid,
            .about-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero-description {
                margin: 0 auto 2rem;
            }

            .hero-buttons,
            .hero-stats {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .floating-card {
                display: none;
            }

            .services-grid,
            .projects-grid,
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-images {
                max-width: 500px;
                margin: 0 auto;
            }

            .about-features {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .services-grid,
            .projects-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .about-features {
                grid-template-columns: 1fr;
            }

            .cta-content h2 {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-circle"></i>
                        Leading Tech Solutions Provider
                    </div>
                    <h1>We Build <span>Digital Products</span> That Drive Growth</h1>
                    <p class="hero-description">Transform your business with cutting-edge technology solutions. We help
                        companies of all sizes achieve their goals through innovative software development, cloud solutions,
                        and AI-powered applications.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('contact') }}" class="btn btn-primary">
                            Start Your Project <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('projects') }}" class="btn btn-outline">
                            View Our Work
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-value">200+</div>
                            <div class="hero-stat-label">Projects Delivered</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-value">50+</div>
                            <div class="hero-stat-label">Team Experts</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-value">99%</div>
                            <div class="hero-stat-label">Client Satisfaction</div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-image">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="floating-card card-1">
                        <div class="floating-card-icon"><i class="fas fa-check"></i></div>
                        <div class="floating-card-text">
                            <h4>Project Completed</h4>
                            <p>E-commerce Platform</p>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="floating-card-icon"><i class="fas fa-star"></i></div>
                        <div class="floating-card-text">
                            <h4>5.0 Rating</h4>
                            <p>Client Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="clients-section">
        <div class="container">
            <p class="clients-label">Trusted by Industry Leaders</p>
            <div class="clients-grid">
                <div class="client-logo"><i class="fab fa-google"></i></div>
                <div class="client-logo"><i class="fab fa-microsoft"></i></div>
                <div class="client-logo"><i class="fab fa-amazon"></i></div>
                <div class="client-logo"><i class="fab fa-apple"></i></div>
                <div class="client-logo"><i class="fab fa-stripe"></i></div>
                <div class="client-logo"><i class="fab fa-spotify"></i></div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-title">
                <span>Our Services</span>
                <h2>What We Offer</h2>
                <p>Comprehensive technology solutions tailored to your needs</p>
            </div>
            <div class="services-grid">
                @forelse($services as $service)
                    <a href="{{ route('services.show', $service->id) }}" class="service-card">
                        <div class="service-icon">
                            <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ Str::limit($service->description, 100) }}</p>
                        <span class="service-link">Learn More <i class="fas fa-arrow-right"></i></span>
                    </a>
                @empty
                    @php
                        $demoServices = [
                            [
                                'title' => 'Web Development',
                                'icon' => 'fas fa-code',
                                'desc' => 'Custom web applications with modern frameworks and best practices.',
                            ],
                            [
                                'title' => 'Mobile Apps',
                                'icon' => 'fas fa-mobile-alt',
                                'desc' => 'Native and cross-platform mobile solutions for iOS and Android.',
                            ],
                            [
                                'title' => 'Cloud Solutions',
                                'icon' => 'fas fa-cloud',
                                'desc' => 'Scalable cloud infrastructure on AWS, Azure, and Google Cloud.',
                            ],
                            [
                                'title' => 'AI & ML',
                                'icon' => 'fas fa-brain',
                                'desc' => 'Intelligent automation and data-driven insights for your business.',
                            ],
                            [
                                'title' => 'UI/UX Design',
                                'icon' => 'fas fa-palette',
                                'desc' => 'Beautiful, user-centered designs that convert visitors to customers.',
                            ],
                            [
                                'title' => 'DevOps',
                                'icon' => 'fas fa-infinity',
                                'desc' => 'Streamlined CI/CD pipelines and infrastructure automation.',
                            ],
                        ];
                    @endphp
                    @foreach ($demoServices as $s)
                        <div class="service-card">
                            <div class="service-icon"><i class="{{ $s['icon'] }}"></i></div>
                            <h3>{{ $s['title'] }}</h3>
                            <p>{{ $s['desc'] }}</p>
                            <span class="service-link">Learn More <i class="fas fa-arrow-right"></i></span>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-images">
                    <div class="about-image-main">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="about-image-small">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="experience-badge">
                        <div class="number">10+</div>
                        <div class="text">Years Experience</div>
                    </div>
                </div>
                <div class="about-content">
                    <span class="section-badge"
                        style="display: inline-block; padding: 0.5rem 1rem; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 50px; font-size: 0.85rem; margin-bottom: 1rem;">About
                        Us</span>
                    <h2>We Are a Team of Passionate Tech Innovators</h2>
                    <p>Since 2014, we've been helping businesses transform their digital presence. Our team of 50+ experts
                        brings together diverse skills in development, design, and strategy to deliver solutions that make a
                        real impact.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Award-Winning Team</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>200+ Projects Delivered</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>24/7 Premium Support</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Agile Methodology</span>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary">
                        Learn More About Us <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects-section" id="projects">
        <div class="container">
            <div class="projects-header">
                <div class="section-title" style="text-align: left; margin-bottom: 0;">
                    <span>Our Portfolio</span>
                    <h2>Featured Projects</h2>
                    <p>Showcasing our best work across industries</p>
                </div>
                <a href="{{ route('projects') }}" class="btn btn-outline">View All Projects</a>
            </div>
            <div class="projects-grid">
                @forelse($projects as $project)
                    <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                        @if ($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @else
                            <div
                                style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: rgba(255,255,255,0.2);">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="project-overlay">
                            <div class="project-category">{{ $project->category ?? 'Project' }}</div>
                            <div class="project-title">{{ $project->title }}</div>
                            <p class="project-desc">{{ Str::limit($project->description, 60) }}</p>
                            <span class="project-link">View Project <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                @empty
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="project-card">
                            <div
                                style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: rgba(255,255,255,0.2);">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="project-overlay">
                                <div class="project-category">Web Development</div>
                                <div class="project-title">Sample Project {{ $i }}</div>
                                <p class="project-desc">A showcase of our development capabilities.</p>
                                <span class="project-link">View Project <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-title">
                <span>Client Testimonials</span>
                <h2>What Our Clients Say</h2>
                <p>Don't just take our word for it</p>
            </div>
            <div class="testimonials-grid">
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <p class="testimonial-content">"{{ Str::limit($testimonial->content, 150) }}"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                @if ($testimonial->client_photo)
                                    <img src="{{ asset('storage/' . $testimonial->client_photo) }}"
                                        alt="{{ $testimonial->client_name }}">
                                @else
                                    {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                @endif
                            </div>
                            <div class="author-info">
                                <h4>{{ $testimonial->client_name }}</h4>
                                <p>{{ $testimonial->client_position }}{{ $testimonial->client_company ? ' at ' . $testimonial->client_company : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    @php
                        $demoTestimonials = [
                            [
                                'name' => 'David Wilson',
                                'position' => 'CEO',
                                'company' => 'TechStart Inc.',
                                'content' =>
                                    'Exceptional work! They delivered a platform that exceeded all our expectations. Highly recommended for any project.',
                            ],
                            [
                                'name' => 'Sarah Chen',
                                'position' => 'CTO',
                                'company' => 'DataFlow',
                                'content' =>
                                    'The team\'s expertise in cloud solutions helped us scale effortlessly. Outstanding technical skills and communication.',
                            ],
                            [
                                'name' => 'Michael Brown',
                                'position' => 'Founder',
                                'company' => 'AppVentures',
                                'content' =>
                                    'From concept to launch, they were with us every step. The mobile app they built has transformed our business.',
                            ],
                        ];
                    @endphp
                    @foreach ($demoTestimonials as $t)
                        <div class="testimonial-card">
                            <div class="testimonial-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p class="testimonial-content">"{{ $t['content'] }}"</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">{{ strtoupper(substr($t['name'], 0, 1)) }}</div>
                                <div class="author-info">
                                    <h4>{{ $t['name'] }}</h4>
                                    <p>{{ $t['position'] }} at {{ $t['company'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section" style="padding: 8rem 0; background: var(--dark);">
        <div class="container">
            <div class="section-title">
                <span>Skill Up</span>
                <h2>Professional Tech Courses</h2>
                <p>Join our physical classes at our office and kickstart your tech career</p>
            </div>
            <div class="courses-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin-top: 3rem;">
                @forelse($courses as $course)
                    <div class="course-card"
                        style="background: var(--dark-light); border-radius: var(--radius-lg); border: 1px solid rgba(255, 255, 255, 0.05); overflow: hidden; transition: all 0.4s ease; display: flex; flex-direction: column;">
                        <div class="course-image"
                            style="height: 200px; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; font-size: 4rem; color: rgba(255, 255, 255, 0.2); position: relative;">
                            @if ($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="{{ $course->icon ?: 'fas fa-graduation-cap' }}"
                                    style="color: white; opacity: 0.9;"></i>
                            @endif
                            <div
                                style="position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(8px); padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.875rem; font-weight: 600; color: var(--secondary); border: 1px solid rgba(14, 165, 233, 0.3);">
                                Physical Class</div>
                        </div>
                        <div class="course-content"
                            style="padding: 2rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 1.35rem; margin-bottom: 1rem; color: white;">{{ $course->title }}</h3>
                            <p style="color: var(--gray-light); margin-bottom: 1.5rem; line-height: 1.6; flex-grow: 1;">
                                {{ Str::limit($course->description, 120) }}</p>
                            <div class="course-meta"
                                style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.05); margin-top: auto;">
                                <div
                                    style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-light); font-size: 0.875rem;">
                                    <i class="far fa-clock"></i> {{ $course->duration }}
                                </div>
                                <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary-light);">
                                    ${{ number_format($course->price, 2) }}
                                </div>
                            </div>
                            <div style="margin-top: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-outline"
                                    style="padding: 0.75rem; font-size: 0.9rem;">Details</a>
                                <a href="{{ route('courses.register', $course->slug) }}" class="btn btn-primary"
                                    style="padding: 0.75rem; font-size: 0.9rem;">Enroll</a>
                            </div>
                        </div>
                    </div>
                @empty
                    @php
                        $demoCourses = [
                            [
                                'title' => 'Web Development',
                                'desc' => 'Master modern web technologies from HTML to advanced frameworks.',
                                'duration' => '6 Months',
                                'price' => 1200,
                                'icon' => 'fas fa-code',
                            ],
                            [
                                'title' => 'UI/UX Design',
                                'desc' => 'Learn industry-standard design tools and user-centric principles.',
                                'duration' => '3 Months',
                                'price' => 800,
                                'icon' => 'fas fa-paint-brush',
                            ],
                            [
                                'title' => 'Mobile App Dev',
                                'desc' => 'Build native apps for iOS and Android with cross-platform tools.',
                                'duration' => '4 Months',
                                'price' => 1000,
                                'icon' => 'fas fa-mobile-alt',
                            ],
                        ];
                    @endphp
                    @foreach ($demoCourses as $c)
                        <div class="course-card"
                            style="background: var(--dark-light); border-radius: var(--radius-lg); border: 1px solid rgba(255, 255, 255, 0.05); overflow: hidden; display: flex; flex-direction: column;">
                            <div class="course-image"
                                style="height: 180px; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: rgba(255, 255, 255, 0.5);">
                                <i class="{{ $c['icon'] }}"></i>
                            </div>
                            <div class="course-content" style="padding: 2rem;">
                                <h3 style="color: white; margin-bottom: 0.75rem;">{{ $c['title'] }}</h3>
                                <p style="color: var(--gray-light); margin-bottom: 1.25rem;">{{ $c['desc'] }}</p>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                                    <span style="font-size: 0.85rem; color: var(--gray);">{{ $c['duration'] }}</span>
                                    <span
                                        style="font-weight: 700; color: var(--primary-light);">${{ $c['price'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
            <div style="text-align: center; margin-top: 4rem;">
                <a href="{{ route('courses.index') }}" class="btn btn-outline">View All Courses <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Transform Your Business?</h2>
                <p>Let's discuss how we can help you achieve your goals with innovative technology solutions.</p>
                <div class="cta-buttons">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        Start Your Project <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="tel:+12345678900" class="btn btn-outline">
                        <i class="fas fa-phone"></i> Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
