@extends('layouts.app')

@section('title', $service->title)

@section('styles')
<style>
    .page-header {
        padding: 10rem 0 4rem;
        text-align: center;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        color: var(--gray-light);
    }

    .breadcrumb a {
        color: var(--gray-light);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: var(--primary);
    }

    .service-detail {
        padding: 6rem 0;
    }

    .service-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .service-image {
        height: 400px;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8rem;
        color: rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .service-content h2 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .service-content p {
        color: var(--gray-light);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .service-icon-large {
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
    }

    .features-list {
        list-style: none;
        margin: 2rem 0;
    }

    .features-list li {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
        color: var(--gray-light);
    }

    .features-list li i {
        color: var(--success);
        font-size: 1.25rem;
    }

    .cta-section {
        background: var(--dark-light);
        padding: 4rem 0;
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: var(--gray-light);
        margin-bottom: 2rem;
    }

    .other-services {
        padding: 6rem 0;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .service-card {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        padding: 2rem;
        transition: all 0.4s ease;
        text-decoration: none;
        color: inherit;
    }

    .service-card:hover {
        transform: translateY(-5px);
        border-color: rgba(99, 102, 241, 0.3);
    }

    .service-card-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient-primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--white);
        margin-bottom: 1rem;
    }

    .service-card h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .service-card p {
        color: var(--gray-light);
        font-size: 0.9rem;
    }

    @media (max-width: 1024px) {
        .service-grid {
            grid-template-columns: 1fr;
        }

        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('services') }}">Services</a>
            <span>/</span>
            <span>{{ $service->title }}</span>
        </div>
        <h1>{{ $service->title }}</h1>
    </div>
</section>

<section class="service-detail">
    <div class="container">
        <div class="service-grid">
            <div class="service-image">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                @else
                <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                @endif
            </div>
            <div class="service-content">
                <div class="service-icon-large">
                    <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                </div>
                <h2>{{ $service->title }}</h2>
                <p>{{ $service->description }}</p>
                
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Expert team with years of experience</li>
                    <li><i class="fas fa-check-circle"></i> Tailored solutions for your business</li>
                    <li><i class="fas fa-check-circle"></i> Ongoing support and maintenance</li>
                    <li><i class="fas fa-check-circle"></i> Competitive pricing</li>
                    <li><i class="fas fa-check-circle"></i> Fast turnaround time</li>
                </ul>

                <a href="{{ route('contact') }}" class="btn btn-primary">
                    Get Started <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Contact us today to discuss how we can help with your {{ strtolower($service->title) }} needs.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
    </div>
</section>

@if($otherServices->count() > 0)
<section class="other-services">
    <div class="container">
        <div class="section-title">
            <span>Explore More</span>
            <h2>Other Services</h2>
        </div>
        <div class="services-grid">
            @foreach($otherServices as $otherService)
            <a href="{{ route('services.show', $otherService->id) }}" class="service-card">
                <div class="service-card-icon">
                    <i class="{{ $otherService->icon ?? 'fas fa-cog' }}"></i>
                </div>
                <h3>{{ $otherService->title }}</h3>
                <p>{{ Str::limit($otherService->description, 80) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
