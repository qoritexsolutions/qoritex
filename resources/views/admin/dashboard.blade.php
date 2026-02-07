@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-light);
        border-radius: var(--radius);
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-card-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--white);
    }

    .stat-card-icon.services { background: linear-gradient(135deg, #6366f1, #818cf8); }
    .stat-card-icon.team { background: linear-gradient(135deg, #0ea5e9, #38bdf8); }
    .stat-card-icon.projects { background: linear-gradient(135deg, #10b981, #34d399); }
    .stat-card-icon.messages { background: linear-gradient(135deg, #f59e0b, #fbbf24); }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .stat-label {
        color: var(--gray-light);
        font-size: 0.9rem;
    }

    .stat-change {
        font-size: 0.85rem;
        color: var(--success);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .recent-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-icon {
        width: 44px;
        height: 44px;
        background: rgba(99, 102, 241, 0.1);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }

    .recent-info {
        flex: 1;
    }

    .recent-info h4 {
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .recent-info p {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .welcome-banner {
        background: var(--gradient-primary);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .welcome-banner h2 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }

    .welcome-banner p {
        opacity: 0.9;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="welcome-banner">
    <h2>Welcome back, {{ auth()->user()->name }}! 👋</h2>
    <p>Here's what's happening with your website today.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $stats['services'] }}</div>
                <div class="stat-label">Services</div>
            </div>
            <div class="stat-card-icon services">
                <i class="fas fa-cogs"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $stats['team_members'] }}</div>
                <div class="stat-label">Team Members</div>
            </div>
            <div class="stat-card-icon team">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $stats['projects'] }}</div>
                <div class="stat-label">Projects</div>
            </div>
            <div class="stat-card-icon projects">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $stats['messages'] }}</div>
                <div class="stat-label">Messages</div>
                @if($stats['new_messages'] > 0)
                <div class="stat-change">{{ $stats['new_messages'] }} new</div>
                @endif
            </div>
            <div class="stat-card-icon messages">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card">
        <div class="card-header">
            <h2>Recent Messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-secondary">View All</a>
        </div>
        <div class="card-body">
            @forelse($recentMessages as $message)
            <div class="recent-item">
                <div class="recent-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="recent-info">
                    <h4>{{ $message->name }}</h4>
                    <p>{{ Str::limit($message->subject, 40) }}</p>
                </div>
                <span class="badge badge-{{ $message->status === 'new' ? 'warning' : ($message->status === 'read' ? 'primary' : 'success') }}">
                    {{ ucfirst($message->status) }}
                </span>
            </div>
            @empty
            <p style="color: var(--gray); text-align: center; padding: 2rem;">No messages yet</p>
            @endforelse
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Recent Projects</h2>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-secondary">View All</a>
        </div>
        <div class="card-body">
            @forelse($recentProjects as $project)
            <div class="recent-item">
                <div class="recent-icon">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="recent-info">
                    <h4>{{ $project->title }}</h4>
                    <p>{{ $project->category ?? 'No category' }}</p>
                </div>
                <span class="badge badge-{{ $project->is_active ? 'success' : 'danger' }}">
                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            @empty
            <p style="color: var(--gray); text-align: center; padding: 2rem;">No projects yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
