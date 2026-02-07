@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Project
        </a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>
                            <div style="width: 80px; height: 50px; background: var(--gradient-primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                <i class="fas fa-image" style="color: rgba(255,255,255,0.3);"></i>
                                @endif
                            </div>
                        </td>
                        <td><strong>{{ $project->title }}</strong></td>
                        <td>{{ $project->category ?? '-' }}</td>
                        <td>
                            @if($project->is_featured)
                            <span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $project->is_active ? 'success' : 'danger' }}">
                                {{ $project->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--gray); padding: 3rem;">
                            No projects found. <a href="{{ route('admin.projects.create') }}">Add your first project</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($projects->hasPages())
        <div class="pagination">{{ $projects->links() }}</div>
        @endif
    </div>
</div>
@endsection
