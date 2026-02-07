@extends('layouts.app')

@section('title', $course->title)

@section('styles')
    <style>
        .course-detail-hero {
            padding: 12rem 0 6rem;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.8) 100%),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            text-align: center;
        }

        .course-detail-hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 2rem;
            color: white;
        }

        .course-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 3rem;
        }

        .stat-item {
            text-align: left;
        }

        .stat-item label {
            display: block;
            color: var(--gray-light);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .stat-item span {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .course-body {
            padding: 8rem 0;
        }

        .course-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 5rem;
        }

        .curriculum h2 {
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
            color: white;
        }

        .topic-list {
            list-style: none;
        }

        .topic-item {
            background: var(--dark-light);
            padding: 1.5rem 2rem;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s ease;
        }

        .topic-item:hover {
            border-color: var(--primary);
            transform: translateX(10px);
        }

        .topic-number {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-card {
            background: var(--dark-light);
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: sticky;
            top: 100px;
        }

        .sidebar-card h3 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .benefits-list {
            list-style: none;
            margin-bottom: 2.5rem;
        }

        .benefits-list li {
            color: var(--gray-light);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .benefits-list li i {
            color: var(--success);
        }

        .presentation-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 1rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px dashed var(--primary);
            color: var(--primary-light);
            border-radius: var(--radius);
            text-decoration: none;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .presentation-btn:hover {
            background: var(--primary);
            color: white;
        }

        @media (max-width: 1024px) {
            .course-grid {
                grid-template-columns: 1fr;
            }

            .course-detail-hero h1 {
                font-size: 3rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="course-detail-hero">
        <div class="container">
            <h1>{{ $course->title }}</h1>
            <div class="course-stats">
                <div class="stat-item">
                    <label>Duration</label>
                    <span>{{ $course->duration }}</span>
                </div>
                <div class="stat-item">
                    <label>Investment</label>
                    <span>${{ number_format($course->price, 2) }}</span>
                </div>
                <div class="stat-item">
                    <label>Location</label>
                    <span>In-Office Sessions</span>
                </div>
            </div>
        </div>
    </section>

    <section class="course-body">
        <div class="container">
            <div class="course-grid">
                <div class="curriculum">
                    <h2>Course Syllabus</h2>
                    <div class="topic-list">
                        @foreach ($course->content as $index => $topic)
                            <div class="topic-item">
                                <div class="topic-number">{{ $index + 1 }}</div>
                                <div class="topic-text">
                                    <h4 style="color: white; margin-bottom: 0.25rem;">{{ $topic }}</h4>
                                    <p style="color: var(--gray-light); font-size: 0.875rem;">Master the core concepts and
                                        practical implementation.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <aside class="course-sidebar">
                    <div class="sidebar-card">
                        <h3>Enrollment Details</h3>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Physical Office Training</li>
                            <li><i class="fas fa-check-circle"></i> Industry Expert Mentors</li>
                            <li><i class="fas fa-check-circle"></i> Real-world Project Portfolio</li>
                            <li><i class="fas fa-check-circle"></i> Course Completion Certificate</li>
                            <li><i class="fas fa-check-circle"></i> Internship Opportunities</li>
                        </ul>

                        <a href="{{ route('courses.presentation', $course->slug) }}" class="presentation-btn">
                            <i class="fas fa-file-pdf"></i> View Course Presentation
                        </a>

                        <a href="{{ route('courses.register', $course->slug) }}" class="btn btn-primary"
                            style="width: 100%; text-align: center;">Register Now</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
