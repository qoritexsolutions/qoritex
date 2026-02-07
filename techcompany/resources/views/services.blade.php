@extends('layouts.app')

@section('title', 'Our Services')

@section('styles')
<style>
    .page-header {
        padding: 10rem 0 5rem;
        text-align: center;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(14, 165, 233, 0.08) 100%);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
        top: -200px;
        right: -200px;
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%);
        bottom: -100px;
        left: -100px;
        border-radius: 50%;
    }

    .page-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        color: var(--gray-light);
        font-size: 1.25rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    /* Stats Bar */
    .stats-bar {
        background: var(--dark-light);
        padding: 3rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        text-align: center;
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        color: var(--gray-light);
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    /* Services Section */
    .services-section {
        padding: 6rem 0;
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
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
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
        width: 80px;
        height: 80px;
        background: var(--gradient-primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--white);
        margin-bottom: 1.5rem;
        transition: transform 0.4s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .service-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .service-card p {
        color: var(--gray-light);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-features {
        list-style: none;
        margin-bottom: 1.5rem;
    }

    .service-features li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
        color: var(--gray-light);
        font-size: 0.95rem;
    }

    .service-features li i {
        color: var(--success);
        font-size: 0.85rem;
    }

    .service-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s ease;
    }

    .service-link:hover {
        gap: 1rem;
    }

    /* Process Section */
    .process-section {
        padding: 6rem 0;
        background: var(--dark-light);
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        margin-top: 3rem;
        position: relative;
    }

    .process-grid::before {
        content: '';
        position: absolute;
        top: 60px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary), var(--secondary), transparent);
        z-index: 0;
    }

    .process-step {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .process-number {
        width: 80px;
        height: 80px;
        background: var(--dark);
        border: 3px solid var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0 auto 1.5rem;
        position: relative;
    }

    .process-step h3 {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }

    .process-step p {
        color: var(--gray-light);
        font-size: 0.95rem;
    }

    /* Technologies Section */
    .tech-section {
        padding: 6rem 0;
    }

    .tech-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .tech-item {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .tech-item:hover {
        transform: translateY(-5px);
        border-color: rgba(99, 102, 241, 0.3);
        background: rgba(30, 41, 59, 0.8);
    }

    .tech-item i {
        font-size: 3rem;
        margin-bottom: 1rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .tech-item span {
        display: block;
        font-weight: 500;
        color: var(--gray-light);
    }

    /* Why Choose Us */
    .why-section {
        padding: 6rem 0;
        background: var(--dark-light);
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 4rem;
        align-items: center;
    }

    .why-content h2 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .why-content p {
        color: var(--gray-light);
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    .why-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .why-feature {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .why-feature-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--white);
        flex-shrink: 0;
    }

    .why-feature h4 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .why-feature p {
        font-size: 0.9rem;
        margin: 0;
    }

    .why-image {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .why-image-item {
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.3);
    }

    .why-image-item:first-child {
        height: 280px;
    }

    .why-image-item:nth-child(2) {
        margin-top: 80px;
        height: 280px;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        text-align: center;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: var(--gray-light);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .tech-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 1024px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-grid::before {
            display: none;
        }

        .why-grid {
            grid-template-columns: 1fr;
        }

        .why-image {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2.5rem;
        }

        .stats-grid,
        .services-grid,
        .process-grid {
            grid-template-columns: 1fr;
        }

        .tech-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .why-features {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Our Services</h1>
        <p>We provide comprehensive technology solutions that help businesses thrive in the digital age. From concept to deployment, we're with you every step of the way.</p>
    </div>
</section>

<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">200+</div>
                <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Expert Team Members</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99%</div>
                <div class="stat-label">Client Satisfaction</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Available</div>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="section-title">
            <span>What We Offer</span>
            <h2>Our Expertise</h2>
            <p>Comprehensive solutions tailored to your business needs</p>
        </div>
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card">
                <div class="service-icon">
                    <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                </div>
                <h3>{{ $service->title }}</h3>
                <p>{{ Str::limit($service->description, 120) }}</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Expert consultation</li>
                    <li><i class="fas fa-check"></i> Custom solutions</li>
                    <li><i class="fas fa-check"></i> Ongoing support</li>
                </ul>
                <a href="{{ route('services.show', $service->id) }}" class="service-link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @empty
            @php
            $demoServices = [
                ['title' => 'Web Development', 'icon' => 'fas fa-code', 'desc' => 'Custom web applications built with modern technologies and best practices for optimal performance and scalability.'],
                ['title' => 'Mobile Development', 'icon' => 'fas fa-mobile-alt', 'desc' => 'Native and cross-platform mobile apps that deliver exceptional user experiences across iOS and Android.'],
                ['title' => 'Cloud Solutions', 'icon' => 'fas fa-cloud', 'desc' => 'Scalable cloud infrastructure and services to power your digital transformation journey.'],
                ['title' => 'AI & Machine Learning', 'icon' => 'fas fa-brain', 'desc' => 'Intelligent solutions that leverage artificial intelligence to automate and optimize your processes.'],
                ['title' => 'UI/UX Design', 'icon' => 'fas fa-palette', 'desc' => 'Beautiful, intuitive designs that enhance user satisfaction and drive engagement.'],
                ['title' => 'DevOps & Security', 'icon' => 'fas fa-shield-alt', 'desc' => 'Streamlined development processes and robust security measures to protect your applications.'],
            ];
            @endphp
            @foreach($demoServices as $service)
            <div class="service-card">
                <div class="service-icon">
                    <i class="{{ $service['icon'] }}"></i>
                </div>
                <h3>{{ $service['title'] }}</h3>
                <p>{{ $service['desc'] }}</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Expert consultation</li>
                    <li><i class="fas fa-check"></i> Custom solutions</li>
                    <li><i class="fas fa-check"></i> Ongoing support</li>
                </ul>
                <a href="#" class="service-link">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

<section class="process-section">
    <div class="container">
        <div class="section-title">
            <span>How We Work</span>
            <h2>Our Process</h2>
            <p>A streamlined approach to delivering exceptional results</p>
        </div>
        <div class="process-grid">
            <div class="process-step">
                <div class="process-number">01</div>
                <h3>Discovery</h3>
                <p>We analyze your requirements, goals, and challenges to understand your unique needs.</p>
            </div>
            <div class="process-step">
                <div class="process-number">02</div>
                <h3>Strategy</h3>
                <p>Our team develops a comprehensive plan and roadmap tailored to your objectives.</p>
            </div>
            <div class="process-step">
                <div class="process-number">03</div>
                <h3>Development</h3>
                <p>We build your solution using agile methodologies with regular updates and feedback.</p>
            </div>
            <div class="process-step">
                <div class="process-number">04</div>
                <h3>Launch & Support</h3>
                <p>We deploy your solution and provide ongoing maintenance and support.</p>
            </div>
        </div>
    </div>
</section>

<section class="tech-section">
    <div class="container">
        <div class="section-title">
            <span>Our Stack</span>
            <h2>Technologies We Use</h2>
            <p>Cutting-edge tools and frameworks for modern solutions</p>
        </div>
        <div class="tech-grid">
            <div class="tech-item">
                <i class="fab fa-laravel"></i>
                <span>Laravel</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-react"></i>
                <span>React</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-vuejs"></i>
                <span>Vue.js</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-node-js"></i>
                <span>Node.js</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-python"></i>
                <span>Python</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-aws"></i>
                <span>AWS</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-docker"></i>
                <span>Docker</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-figma"></i>
                <span>Figma</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-android"></i>
                <span>Android</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-apple"></i>
                <span>iOS</span>
            </div>
            <div class="tech-item">
                <i class="fas fa-database"></i>
                <span>MySQL</span>
            </div>
            <div class="tech-item">
                <i class="fab fa-git-alt"></i>
                <span>Git</span>
            </div>
        </div>
    </div>
</section>

<section class="why-section">
    <div class="container">
        <div class="why-grid">
            <div class="why-content">
                <span class="section-badge" style="display: inline-block; padding: 0.5rem 1rem; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 50px; font-size: 0.85rem; margin-bottom: 1rem;">Why Choose Us</span>
                <h2>We Deliver Excellence in Every Project</h2>
                <p>With years of experience and a passionate team of experts, we transform your ideas into powerful digital solutions that drive real business results.</p>
                <div class="why-features">
                    <div class="why-feature">
                        <div class="why-feature-icon"><i class="fas fa-rocket"></i></div>
                        <div>
                            <h4>Fast Delivery</h4>
                            <p>Quick turnaround without compromising quality</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <h4>Secure Solutions</h4>
                            <p>Enterprise-grade security standards</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature-icon"><i class="fas fa-users"></i></div>
                        <div>
                            <h4>Expert Team</h4>
                            <p>50+ skilled professionals</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature-icon"><i class="fas fa-headset"></i></div>
                        <div>
                            <h4>24/7 Support</h4>
                            <p>Round-the-clock assistance</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-image">
                <div class="why-image-item"><i class="fas fa-laptop-code"></i></div>
                <div class="why-image-item"><i class="fas fa-chart-line"></i></div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h2>Ready to Start Your Project?</h2>
        <p>Let's discuss how we can help you achieve your business goals with our expert solutions.</p>
        <div class="cta-buttons">
            <a href="{{ route('contact') }}" class="btn btn-primary">
                Get Started <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('projects') }}" class="btn btn-outline">
                View Our Work
            </a>
        </div>
    </div>
</section>
@endsection
