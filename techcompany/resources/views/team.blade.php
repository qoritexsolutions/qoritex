@extends('layouts.app')

@section('title', 'Our Team')

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
            background: radial-gradient(circle, rgba(14, 165, 233, 0.08) 0%, transparent 70%);
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

        .page-header h1 span {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .stat-value {
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

        /* Leadership Section */
        .leadership-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(14, 165, 233, 0.02) 100%);
        }

        .leadership-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem;
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
            width: 160px;
            height: 160px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.9);
            overflow: hidden;
            flex-shrink: 0;
            border: 3px solid rgba(255, 255, 255, 0.1);
            position: relative;
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
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
        }

        .leadership-info .position {
            color: var(--primary-light);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .leadership-info .bio {
            color: var(--gray-light);
            font-size: 0.9rem;
            line-height: 1.7;
            flex: 1;
        }

        .leadership-social {
            display: flex;
            gap: 0.6rem;
            margin-top: 1rem;
        }

        .leadership-social a {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            color: var(--gray-light);
            transition: all 0.3s ease;
            font-size: 0.9rem;
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
            width: 200px;
            height: 200px;
            font-size: 5rem;
        }

        .leadership-featured h3 {
            font-size: 1.75rem;
        }

        .leadership-featured .position {
            font-size: 1.1rem;
        }

        .leadership-featured .bio {
            font-size: 1rem;
        }

        .leadership-quote {
            font-style: italic;
            color: var(--gray-light);
            margin-top: 1rem;
            padding-left: 1.5rem;
            border-left: 3px solid var(--primary);
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* Team Section */
        .team-section {
            padding: 6rem 0;
        }

        .team-filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: var(--gray-light);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
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
            width: 130px;
            height: 130px;
            background: var(--gradient-primary);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
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
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
        }

        .team-card .position {
            color: var(--primary-light);
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }

        .team-card .department {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 50px;
            font-size: 0.75rem;
            color: var(--primary-light);
            margin-bottom: 1rem;
        }

        .team-card .bio {
            color: var(--gray-light);
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 1.25rem;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 0.6rem;
        }

        .team-social a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            color: var(--gray-light);
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .team-social a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Join Team CTA */
        .join-section {
            padding: 6rem 0;
            background: var(--dark-light);
        }

        .join-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .join-text h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .join-text h2 span {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .join-text p {
            color: var(--gray-light);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .perks-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .perk-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .perk-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--white);
            flex-shrink: 0;
        }

        .perk-item span {
            color: var(--gray-light);
            font-size: 0.95rem;
        }

        .join-image {
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            color: rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .join-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .team-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .leadership-grid {
                grid-template-columns: 1fr;
            }

            .leadership-featured {
                grid-column: span 1;
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .join-content {
                grid-template-columns: 1fr;
            }

            .join-image {
                height: 300px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }

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

            .leadership-quote {
                text-align: left;
            }

            .perks-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Meet Our <span>Team</span></h1>
            <p>A talented group of innovators, creators, and problem-solvers dedicated to delivering exceptional technology
                solutions for our clients.</p>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">50+</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Departments</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">8</div>
                    <div class="stat-label">Countries</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">10+</div>
                    <div class="stat-label">Years Average Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet The Experts Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-title">
                <span>Our Experts</span>
                <h2>Meet The Experts</h2>
                <p>The talented professionals driving innovation every day</p>
            </div>

            <div class="team-grid">
                @forelse($teamMembers as $member)
                    <div class="team-card">
                        <div class="team-photo">
                            @if ($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <h3>{{ $member->name }}</h3>
                        <p class="position">{{ $member->position }}</p>
                        @if ($member->bio)
                            <p class="bio">{{ Str::limit($member->bio, 80) }}</p>
                        @endif
                        <div class="team-social">
                            @if ($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if ($member->twitter)
                                <a href="{{ $member->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if ($member->github)
                                <a href="{{ $member->github }}" target="_blank"><i class="fab fa-github"></i></a>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Demo Team Experts -->
                    @php
                        $demoExperts = [
                            [
                                'name' => 'Alex Rivera',
                                'position' => 'Senior Full-Stack Developer',
                                'bio' => 'Building scalable web applications with 8+ years of expertise.',
                            ],
                            [
                                'name' => 'Emma Wilson',
                                'position' => 'Lead UX Designer',
                                'bio' => 'Creating intuitive and beautiful user experiences.',
                            ],
                            [
                                'name' => 'James Chen',
                                'position' => 'Cloud Architect',
                                'bio' => 'AWS certified expert in cloud infrastructure and DevOps.',
                            ],
                            [
                                'name' => 'Sophia Brown',
                                'position' => 'AI/ML Engineer',
                                'bio' => 'Developing intelligent solutions with machine learning.',
                            ],
                            [
                                'name' => 'Liam Johnson',
                                'position' => 'Mobile Developer',
                                'bio' => 'iOS and Android specialist using React Native.',
                            ],
                            [
                                'name' => 'Olivia Davis',
                                'position' => 'Frontend Developer',
                                'bio' => 'Crafting responsive and accessible web interfaces.',
                            ],
                            [
                                'name' => 'Noah Garcia',
                                'position' => 'Backend Developer',
                                'bio' => 'Building robust APIs and microservices.',
                            ],
                            [
                                'name' => 'Ava Martinez',
                                'position' => 'Quality Assurance Lead',
                                'bio' => 'Ensuring top-quality software through rigorous testing.',
                            ],
                        ];
                    @endphp
                    @foreach ($demoExperts as $expert)
                        <div class="team-card">
                            <div class="team-photo">
                                <i class="fas fa-user"></i>
                            </div>
                            <h3>{{ $expert['name'] }}</h3>
                            <p class="position">{{ $expert['position'] }}</p>
                            <p class="bio">{{ $expert['bio'] }}</p>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join Our Team Section -->
    <section class="join-section">
        <div class="container">
            <div class="join-content">
                <div class="join-text">
                    <h2>Join Our <span>Team</span></h2>
                    <p>We're always looking for talented individuals who share our passion for technology and innovation.
                        Join us and be part of a team that's shaping the future of digital solutions.</p>
                    <div class="perks-grid">
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-laptop-house"></i></div>
                            <span>Remote-First Culture</span>
                        </div>
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-graduation-cap"></i></div>
                            <span>Learning & Development</span>
                        </div>
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-heart"></i></div>
                            <span>Health & Wellness</span>
                        </div>
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-plane"></i></div>
                            <span>Unlimited PTO</span>
                        </div>
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-chart-line"></i></div>
                            <span>Career Growth</span>
                        </div>
                        <div class="perk-item">
                            <div class="perk-icon"><i class="fas fa-users"></i></div>
                            <span>Team Events</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top: 2rem;">
                        View Open Positions <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="join-image">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </section>
@endsection
