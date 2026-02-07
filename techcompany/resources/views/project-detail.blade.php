@extends('layouts.app')

@section('title', $project->title)

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
        margin-bottom: 1rem;
    }

    .breadcrumb a {
        color: var(--gray-light);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: var(--primary);
    }

    .project-category {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: var(--gradient-primary);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .project-detail {
        padding: 6rem 0;
    }

    .project-image {
        width: 100%;
        height: 500px;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8rem;
        color: rgba(255, 255, 255, 0.3);
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .project-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 4rem;
    }

    .project-content h2 {
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
    }

    .project-content p {
        color: var(--gray-light);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .project-sidebar {
        background: rgba(30, 41, 59, 0.5);
        border-radius: var(--radius-lg);
        padding: 2rem;
        height: fit-content;
    }

    .sidebar-item {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .sidebar-item h4 {
        color: var(--gray);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .sidebar-item p {
        color: var(--white);
        font-weight: 500;
    }

    .sidebar-item a {
        color: var(--primary);
        text-decoration: none;
    }

    .sidebar-item a:hover {
        text-decoration: underline;
    }

    .tech-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tech-tag {
        padding: 0.35rem 0.75rem;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--primary-light);
    }

    .other-projects {
        padding: 6rem 0;
        background: var(--dark-light);
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .project-card {
        border-radius: var(--radius-lg);
        overflow: hidden;
        position: relative;
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
        padding: 1.5rem;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .project-card:hover img {
        transform: scale(1.1);
    }

    .project-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .project-card-category {
        color: var(--primary-light);
        font-size: 0.85rem;
    }

    @media (max-width: 1024px) {
        .project-grid {
            grid-template-columns: 1fr;
        }

        .projects-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .project-image {
            height: 300px;
        }

        .projects-grid {
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
            <a href="{{ route('projects') }}">Projects</a>
            <span>/</span>
            <span>{{ $project->title }}</span>
        </div>
        @if($project->category)
        <span class="project-category">{{ $project->category }}</span>
        @endif
        <h1>{{ $project->title }}</h1>
    </div>
</section>

<section class="project-detail">
    <div class="container">
        <div class="project-image">
            @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
            @else
            <i class="fas fa-image"></i>
            @endif
        </div>

        <div class="project-grid">
            <div class="project-content">
                <h2>Project Overview</h2>
                <p>{{ $project->description }}</p>
                
                @if($project->url)
                <a href="{{ $project->url }}" target="_blank" class="btn btn-primary">
                    View Live Project <i class="fas fa-external-link-alt"></i>
                </a>
                @endif
            </div>

            <div class="project-sidebar">
                @if($project->client)
                <div class="sidebar-item">
                    <h4>Client</h4>
                    <p>{{ $project->client }}</p>
                </div>
                @endif

                @if($project->category)
                <div class="sidebar-item">
                    <h4>Category</h4>
                    <p>{{ $project->category }}</p>
                </div>
                @endif

                @if($project->completed_at)
                <div class="sidebar-item">
                    <h4>Completed</h4>
                    <p>{{ $project->completed_at->format('F Y') }}</p>
                </div>
                @endif

                @if($project->technologies && count($project->technologies) > 0)
                <div class="sidebar-item">
                    <h4>Technologies</h4>
                    <div class="tech-tags">
                        @foreach($project->technologies as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($project->url)
                <div class="sidebar-item">
                    <h4>Website</h4>
                    <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if($otherProjects->count() > 0)
<section class="other-projects">
    <div class="container">
        <div class="section-title">
            <span>Explore More</span>
            <h2>Other Projects</h2>
        </div>
        <div class="projects-grid">
            @foreach($otherProjects as $otherProject)
            <a href="{{ route('projects.show', $otherProject->id) }}" class="project-card">
                @if($otherProject->image)
                <img src="{{ asset('storage/' . $otherProject->image) }}" alt="{{ $otherProject->title }}">
                @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: rgba(255,255,255,0.3);">
                    <i class="fas fa-image"></i>
                </div>
                @endif
                <div class="project-overlay">
                    <div class="project-card-category">{{ $otherProject->category ?? 'Project' }}</div>
                    <div class="project-card-title">{{ $otherProject->title }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
