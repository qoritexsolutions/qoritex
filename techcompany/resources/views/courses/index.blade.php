@extends('layouts.app')

@section('title', 'Our Courses')

@section('styles')
    <style>
        .courses-hero {
            padding: 10rem 0 6rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .courses-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .courses-hero p {
            font-size: 1.25rem;
            color: var(--gray-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            padding: 6rem 0;
        }

        .course-card {
            background: var(--dark-light);
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .course-image {
            height: 200px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .course-image i {
            color: white;
            opacity: 0.9;
        }

        .course-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--secondary);
            border: 1px solid rgba(14, 165, 233, 0.3);
        }

        .course-content {
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .course-content h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .course-content p {
            color: var(--gray-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: auto;
        }

        .course-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-light);
        }

        .course-duration {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-light);
            font-size: 0.875rem;
        }

        .course-actions {
            padding: 0 2rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        @media (max-width: 768px) {
            .courses-hero h1 {
                font-size: 2.5rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <section class="courses-hero">
        <div class="container">
            <h1>Professional <span>Tech Courses</span></h1>
            <p>Advance your career with our physical, industry-led training programs at our office. Learn from experts and
                build a real-world portfolio.</p>
        </div>
    </section>

    <section class="courses-section">
        <div class="container">
            <div class="courses-grid">
                @foreach ($courses as $course)
                    <div class="course-card">
                        <div class="course-image">
                            @if ($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="{{ $course->icon ?: 'fas fa-graduation-cap' }}"></i>
                            @endif
                            <div class="course-badge">Physics Classes</div>
                        </div>
                        <div class="course-content">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ $course->description }}</p>
                            <div class="course-meta">
                                <div class="course-duration">
                                    <i class="far fa-clock"></i> {{ $course->duration }}
                                </div>
                                <div class="course-price">
                                    ${{ number_format($course->price, 2) }}
                                </div>
                            </div>
                        </div>
                        <div class="course-actions">
                            <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-outline">View Details</a>
                            <a href="{{ route('courses.register', $course->slug) }}" class="btn btn-primary">Enroll Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
