@extends('layouts.app')

@section('title', 'Our Projects')

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
        font-size: 2.75rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        color: var(--gray-light);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    /* Filter Section */
    .filter-section {
        padding: 4rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .filter-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-label {
        color: var(--gray-light);
        font-weight: 500;
        margin-right: 1rem;
    }

    .filter-btn {
        padding: 0.75rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        color: var(--gray-light);
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--gradient-primary);
        border-color: transparent;
        color: var(--white);
    }

    /* Projects Grid */
    .projects-section {
        padding: 6rem 0;
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
        background: var(--gradient-primary);
        aspect-ratio: 4/3;
        cursor: pointer;
        transition: transform 0.4s ease;
    }

    .project-card:hover {
        transform: scale(1.02);
    }

    .project-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .project-card:hover img {
        transform: scale(1.1);
    }

    .project-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 0%, transparent 30%, rgba(15, 23, 42, 0.98) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
        transition: background 0.4s ease;
    }

    .project-card:hover .project-overlay {
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.3) 0%, rgba(15, 23, 42, 0.98) 100%);
    }

    .project-category {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        background: rgba(99, 102, 241, 0.2);
        border-radius: 50px;
        color: var(--primary-light);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
        width: fit-content;
    }

    .project-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    .project-card:hover .project-title {
        color: var(--primary-light);
    }

    .project-desc {
        color: var(--gray-light);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
    }

    .project-card:hover .project-desc {
        opacity: 1;
        transform: translateY(0);
    }

    .project-tech {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease 0.1s;
    }

    .project-card:hover .project-tech {
        opacity: 1;
        transform: translateY(0);
    }

    .tech-tag {
        padding: 0.25rem 0.6rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        font-size: 0.75rem;
        color: var(--gray-light);
    }

    .project-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--white);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease 0.2s;
    }

    .project-card:hover .project-link {
        opacity: 1;
        transform: translateY(0);
    }

    .project-link:hover {
        color: var(--primary-light);
    }

    /* Featured Badge */
    .featured-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 0.8rem;
        background: var(--gradient-primary);
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--white);
        z-index: 10;
    }

    /* Pagination */
    .pagination-section {
        padding: 2rem 0 6rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination a,
    .pagination span {
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        color: var(--gray-light);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination a:hover,
    .pagination .current {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: var(--gray-light);
        font-size: 1.15rem;
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 2rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--gray-light);
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 1024px) {
        .projects-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2.5rem;
        }

        .stats-grid,
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .filter-container {
            flex-direction: column;
        }

        .filter-label {
            margin-right: 0;
            margin-bottom: 0.5rem;
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
        <h1>Our Projects</h1>
        <p>Explore our portfolio of successful projects. Each represents our commitment to quality, innovation, and delivering real results for our clients.</p>
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
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">15+</div>
                <div class="stat-label">Industries Served</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99%</div>
                <div class="stat-label">Success Rate</div>
            </div>
        </div>
    </div>
</section>

@if($categories->count() > 0)
<section class="filter-section">
    <div class="container">
        <div class="filter-container">
            <span class="filter-label">Filter by:</span>
            <a href="{{ route('projects') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">All Projects</a>
            @foreach($categories as $category)
            <a href="{{ route('projects', ['category' => $category]) }}" class="filter-btn {{ request('category') == $category ? 'active' : '' }}">{{ $category }}</a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="projects-section">
    <div class="container">
        <div class="projects-grid">
            @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                @if($project->is_featured)
                <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                @endif
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: rgba(255,255,255,0.2);">
                    <i class="fas fa-image"></i>
                </div>
                @endif
                <div class="project-overlay">
                    <span class="project-category">{{ $project->category ?? 'Project' }}</span>
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-desc">{{ Str::limit($project->description, 80) }}</p>
                    @if($project->technologies && count($project->technologies) > 0)
                    <div class="project-tech">
                        @foreach(array_slice($project->technologies, 0, 4) as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                    <span class="project-link">View Details <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
            @empty
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <h3>No Projects Found</h3>
                <p>Check back soon! We're always working on exciting new projects.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@if($projects->hasPages())
<section class="pagination-section">
    <div class="container">
        <div class="pagination">
            @if($projects->onFirstPage())
            <span><i class="fas fa-chevron-left"></i></span>
            @else
            <a href="{{ $projects->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
            @if($page == $projects->currentPage())
            <span class="current">{{ $page }}</span>
            @else
            <a href="{{ $url }}">{{ $page }}</a>
            @endif
            @endforeach

            @if($projects->hasMorePages())
            <a href="{{ $projects->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            @else
            <span><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
</section>
@endif

<section class="cta-section">
    <div class="container">
        <h2>Have a Project in Mind?</h2>
        <p>Let's work together to bring your ideas to life. Our team is ready to help you build something amazing.</p>
        <div class="cta-buttons">
            <a href="{{ route('contact') }}" class="btn btn-primary">
                Start Your Project <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('services') }}" class="btn btn-outline">
                Explore Our Services
            </a>
        </div>
    </div>
</section>
@endsection
