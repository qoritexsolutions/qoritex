@extends('layouts.app')

@section('title', 'About Us')

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

        /* Story Section */
        .story-section {
            padding: 8rem 0;
        }

        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .story-images {
            position: relative;
        }

        .story-image-main {
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

        .story-image-main::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .year-badge {
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 150px;
            height: 150px;
            background: var(--dark);
            border: 3px solid var(--primary);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .year-badge .year {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .year-badge .text {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .story-content h2 {
            font-size: 2.75rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .story-content h2 span {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .story-content p {
            color: var(--gray-light);
            line-height: 1.9;
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .story-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .story-stat {
            text-align: center;
        }

        .story-stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .story-stat-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        /* Mission Vision Section */
        .mission-section {
            padding: 8rem 0;
            background: var(--dark-light);
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
        }

        .mission-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 3rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-primary);
        }

        .mission-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .mission-icon {
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
        }

        .mission-card h3 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .mission-card p {
            color: var(--gray-light);
            line-height: 1.8;
        }

        /* Values Section */
        .values-section {
            padding: 8rem 0;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .value-card {
            text-align: center;
            padding: 3rem 2rem;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            transition: all 0.4s ease;
            position: relative;
        }

        .value-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-primary);
            opacity: 0;
            border-radius: var(--radius-lg);
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .value-card:hover {
            transform: translateY(-10px);
            border-color: transparent;
        }

        .value-card:hover::before {
            opacity: 0.1;
        }

        .value-icon {
            width: 90px;
            height: 90px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.25rem;
            margin: 0 auto 1.5rem;
            color: var(--white);
            transition: transform 0.4s ease;
        }

        .value-card:hover .value-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .value-card h3 {
            font-size: 1.35rem;
            margin-bottom: 1rem;
        }

        .value-card p {
            color: var(--gray-light);
            line-height: 1.7;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 8rem 0;
            background: var(--dark-light);
        }

        .timeline {
            position: relative;
            max-width: 900px;
            margin: 3rem auto 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: var(--gradient-primary);
        }

        .timeline-item {
            position: relative;
            padding: 2rem 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
        }

        .timeline-item:nth-child(even) .timeline-content {
            grid-column: 2;
        }

        .timeline-item:nth-child(even) .timeline-date {
            grid-column: 1;
            grid-row: 1;
            text-align: right;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--primary);
            border: 3px solid var(--dark-light);
            border-radius: 50%;
            top: 2.5rem;
        }

        .timeline-content h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .timeline-content p {
            color: var(--gray-light);
            font-size: 0.95rem;
        }

        .timeline-date {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        /* Team Section */
        .team-section {
            padding: 8rem 0;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .team-card {
            text-align: center;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .team-card:hover::before {
            transform: scaleX(1);
        }

        .team-photo {
            width: 140px;
            height: 140px;
            background: var(--gradient-primary);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: rgba(255, 255, 255, 0.9);
            overflow: hidden;
            border: 4px solid rgba(255, 255, 255, 0.1);
            transition: border-color 0.4s ease;
        }

        .team-card:hover .team-photo {
            border-color: var(--primary);
        }

        .team-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .team-card .position {
            color: var(--primary-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .team-card .bio {
            color: var(--gray-light);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        .team-social a {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            color: var(--gray-light);
            transition: all 0.3s ease;
        }

        .team-social a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Leadership Section */
        .leadership-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(14, 165, 233, 0.03) 100%);
        }

        .leadership-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
            margin-top: 3rem;
        }

        .leadership-card {
            display: flex;
            gap: 2rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .leadership-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .leadership-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
        }

        .leadership-card:hover::before {
            transform: scaleX(1);
        }

        .leadership-photo {
            width: 180px;
            height: 180px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.9);
            overflow: hidden;
            flex-shrink: 0;
            border: 4px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .leadership-photo::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.1) 100%);
        }

        .leadership-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .leadership-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .leadership-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .leadership-info .position {
            color: var(--primary-light);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .leadership-info .bio {
            color: var(--gray-light);
            font-size: 0.95rem;
            line-height: 1.7;
            flex: 1;
        }

        .leadership-social {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .leadership-social a {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            color: var(--gray-light);
            transition: all 0.3s ease;
        }

        .leadership-social a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Featured Leader (CEO) */
        .leadership-featured {
            grid-column: span 2;
            display: flex;
            gap: 3rem;
            padding: 3rem;
        }

        .leadership-featured .leadership-photo {
            width: 220px;
            height: 220px;
            font-size: 5rem;
        }

        .leadership-featured h3 {
            font-size: 1.75rem;
        }

        .leadership-featured .position {
            font-size: 1.1rem;
        }

        .leadership-quote {
            font-style: italic;
            color: var(--gray-light);
            margin-top: 1rem;
            padding-left: 1.5rem;
            border-left: 3px solid var(--primary);
            line-height: 1.7;
        }

        /* CTA Section */
        .cta-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.75rem;
            margin-bottom: 1rem;
        }

        .cta-section p {
            color: var(--gray-light);
            font-size: 1.15rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        @media (max-width: 1024px) {
            .story-grid {
                grid-template-columns: 1fr;
            }

            .story-images {
                max-width: 500px;
                margin: 0 auto;
            }

            .mission-grid {
                grid-template-columns: 1fr;
            }

            .values-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .leadership-grid {
                grid-template-columns: 1fr;
            }

            .leadership-featured {
                grid-column: span 1;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                grid-template-columns: 1fr;
                padding-left: 60px;
            }

            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                text-align: left;
                grid-column: 1;
            }

            .timeline-item:nth-child(even) .timeline-date {
                grid-column: 1;
                grid-row: auto;
                text-align: left;
            }

            .timeline-dot {
                left: 30px;
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }

            .story-stats {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .values-grid,
            .team-grid {
                grid-template-columns: 1fr;
            }

            .leadership-card {
                flex-direction: column;
                text-align: center;
            }

            .leadership-photo {
                margin: 0 auto;
            }

            .leadership-social {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>About Us</h1>
            <p>We're a team of passionate innovators dedicated to transforming businesses through cutting-edge technology
                solutions.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="story-grid">
                <div class="story-images">
                    <div class="story-image-main">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="year-badge">
                        <div class="year">2014</div>
                        <div class="text">Founded</div>
                    </div>
                </div>
                <div class="story-content">
                    <span class="section-badge"
                        style="display: inline-block; padding: 0.5rem 1rem; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 50px; font-size: 0.85rem; margin-bottom: 1rem;">Our
                        Story</span>
                    <h2>Building the Future of <span>Technology</span></h2>
                    <p>Founded in 2014, TechCompany started as a small team of developers with a big dream: to make
                        cutting-edge technology accessible to businesses of all sizes. What began in a small garage has
                        grown into a thriving company with over 50 talented professionals.</p>
                    <p>Today, we've helped hundreds of businesses across the globe transform their digital presence,
                        streamline operations, and achieve unprecedented growth through innovative technology solutions.</p>
                    <div class="story-stats">
                        <div class="story-stat">
                            <div class="story-stat-value">200+</div>
                            <div class="story-stat-label">Projects Completed</div>
                        </div>
                        <div class="story-stat">
                            <div class="story-stat-value">50+</div>
                            <div class="story-stat-label">Team Members</div>
                        </div>
                        <div class="story-stat">
                            <div class="story-stat-value">15+</div>
                            <div class="story-stat-label">Countries Served</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>To empower businesses with innovative technology solutions that drive growth, improve efficiency, and
                        create lasting value. We believe that the right technology, implemented thoughtfully, can transform
                        any organization and help it reach its full potential.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-icon"><i class="fas fa-eye"></i></div>
                    <h3>Our Vision</h3>
                    <p>To be the most trusted technology partner for businesses worldwide, known for our innovation,
                        reliability, and commitment to client success. We envision a future where technology barriers are
                        removed and every business can leverage digital solutions to thrive.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-title">
                <span>Our Values</span>
                <h2>What Drives Us Forward</h2>
                <p>The core principles that guide everything we do</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                    <h3>Innovation</h3>
                    <p>We constantly push boundaries and embrace new technologies to deliver cutting-edge solutions that
                        give our clients a competitive edge.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-handshake"></i></div>
                    <h3>Integrity</h3>
                    <p>We build trust through transparency, honesty, and ethical business practices in every interaction and
                        project we undertake.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-users"></i></div>
                    <h3>Collaboration</h3>
                    <p>We work closely with our clients as true partners, ensuring their success is our success through open
                        communication and teamwork.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-award"></i></div>
                    <h3>Excellence</h3>
                    <p>We strive for excellence in everything we do, from code quality to customer service, never settling
                        for anything less than our best.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-rocket"></i></div>
                    <h3>Agility</h3>
                    <p>We adapt quickly to change and deliver solutions that evolve with your business, staying ahead of
                        industry trends.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-heart"></i></div>
                    <h3>Passion</h3>
                    <p>We love what we do and bring enthusiasm and dedication to every project, treating each challenge as
                        an opportunity to excel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-title">
                <span>Our Journey</span>
                <h2>Milestones Along the Way</h2>
                <p>Key moments that shaped who we are today</p>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>Company Founded</h4>
                        <p>Started with a team of 5 passionate developers in a small garage with big dreams.</p>
                    </div>
                    <div class="timeline-date">2014</div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2016</div>
                    <div class="timeline-content">
                        <h4>First Major Client</h4>
                        <p>Secured our first enterprise client and moved to a proper office space.</p>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>50 Projects Milestone</h4>
                        <p>Celebrated completing 50 successful projects and expanded to 20 team members.</p>
                    </div>
                    <div class="timeline-date">2018</div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2020</div>
                    <div class="timeline-content">
                        <h4>Global Expansion</h4>
                        <p>Opened satellite offices and started serving clients in 10+ countries.</p>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>200+ Projects</h4>
                        <p>Reached 200 completed projects with 50+ team members and growing.</p>
                    </div>
                    <div class="timeline-date">2024</div>
                    <div class="timeline-dot"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="leadership-section">
        <div class="container">
            <div class="section-title">
                <span>Leadership</span>
                <h2>Meet Our Leadership Team</h2>
                <p>The visionaries guiding our company towards excellence</p>
            </div>
            <div class="leadership-grid">
                @forelse($leaders as $leader)
                    <div class="leadership-card {{ $leader->is_featured ? 'leadership-featured' : '' }}">
                        <div class="leadership-photo">
                            @if ($leader->photo)
                                <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}">
                            @else
                                <i class="{{ $leader->icon }}"></i>
                            @endif
                        </div>
                        <div class="leadership-info">
                            <h3>{{ $leader->name }}</h3>
                            <p class="position">{{ $leader->position }}</p>
                            @if ($leader->bio)
                                <p class="bio">{{ $leader->bio }}</p>
                            @endif
                            @if ($leader->is_featured && $leader->quote)
                                <p class="leadership-quote">"{{ $leader->quote }}"</p>
                            @endif
                            <div class="leadership-social">
                                @if ($leader->linkedin)
                                    <a href="{{ $leader->linkedin }}" target="_blank"><i
                                            class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if ($leader->twitter)
                                    <a href="{{ $leader->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if ($leader->github)
                                    <a href="{{ $leader->github }}" target="_blank"><i class="fab fa-github"></i></a>
                                @endif
                                @if ($leader->email)
                                    <a href="mailto:{{ $leader->email }}"><i class="fas fa-envelope"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Demo Leaders -->
                    @php
                        $demoLeaders = [
                            [
                                'name' => 'Robert Anderson',
                                'position' => 'Chief Executive Officer (CEO)',
                                'bio' =>
                                    'With over 20 years of experience in technology and business leadership, Robert founded TechCompany with a vision to democratize access to cutting-edge technology solutions.',
                                'icon' => 'fas fa-user-tie',
                                'featured' => true,
                                'quote' =>
                                    'Our mission is simple: empower businesses with technology that truly transforms how they operate and compete in the digital age.',
                            ],
                            [
                                'name' => 'Dr. Sarah Mitchell',
                                'position' => 'Chief Technology Officer (CTO)',
                                'bio' =>
                                    'A PhD in Computer Science from MIT, Sarah leads our technical vision and innovation strategy with 15+ years of experience in AI and cloud architecture.',
                                'icon' => 'fas fa-laptop-code',
                                'featured' => false,
                                'quote' => '',
                            ],
                            [
                                'name' => 'Michael Thompson',
                                'position' => 'Chief Financial Officer (CFO)',
                                'bio' =>
                                    'Michael brings 18 years of financial expertise from Fortune 500 companies. He oversees our financial strategy and sustainable growth.',
                                'icon' => 'fas fa-chart-line',
                                'featured' => false,
                                'quote' => '',
                            ],
                            [
                                'name' => 'Jennifer Williams',
                                'position' => 'Chief Operating Officer (COO)',
                                'bio' =>
                                    'Jennifer ensures operational excellence across all departments with her background in project management and business operations.',
                                'icon' => 'fas fa-cogs',
                                'featured' => false,
                                'quote' => '',
                            ],
                            [
                                'name' => 'David Park',
                                'position' => 'VP of Engineering',
                                'bio' =>
                                    'David leads our engineering teams with a focus on code quality, scalability, and innovation. Former Google engineer with expertise in distributed systems.',
                                'icon' => 'fas fa-code',
                                'featured' => false,
                                'quote' => '',
                            ],
                            [
                                'name' => 'Amanda Roberts',
                                'position' => 'VP of Sales & Partnerships',
                                'bio' =>
                                    'Amanda drives our business development initiatives and builds strategic partnerships. Her client-first approach has helped us expand into 15+ countries.',
                                'icon' => 'fas fa-handshake',
                                'featured' => false,
                                'quote' => '',
                            ],
                        ];
                    @endphp
                    @foreach ($demoLeaders as $leader)
                        <div class="leadership-card {{ $leader['featured'] ? 'leadership-featured' : '' }}">
                            <div class="leadership-photo">
                                <i class="{{ $leader['icon'] }}"></i>
                            </div>
                            <div class="leadership-info">
                                <h3>{{ $leader['name'] }}</h3>
                                <p class="position">{{ $leader['position'] }}</p>
                                <p class="bio">{{ $leader['bio'] }}</p>
                                @if ($leader['featured'] && $leader['quote'])
                                    <p class="leadership-quote">"{{ $leader['quote'] }}"</p>
                                @endif
                                <div class="leadership-social">
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Want to Join Our Team?</h2>
            <p>We're always looking for talented individuals who share our passion for technology and innovation.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">
                Get In Touch <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection
