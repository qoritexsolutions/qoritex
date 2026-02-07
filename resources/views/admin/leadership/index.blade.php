@extends('admin.layouts.app')

@section('title', 'Leadership Team')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Leadership Team</h2>
            <a href="{{ route('admin.leadership.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Leader
            </a>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Order</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaders as $leader)
                            <tr>
                                <td>
                                    <div
                                        style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        @if ($leader->photo)
                                            <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="{{ $leader->icon }}" style="color: white; font-size: 1.25rem;"></i>
                                        @endif
                                    </div>
                                </td>
                                <td><strong>{{ $leader->name }}</strong></td>
                                <td>{{ $leader->position }}</td>
                                <td>{{ $leader->order }}</td>
                                <td>
                                    @if ($leader->is_featured)
                                        <span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $leader->is_active ? 'success' : 'danger' }}">
                                        {{ $leader->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.leadership.edit', $leader) }}" class="action-btn"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.leadership.destroy', $leader) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this leader?')">
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
                                <td colspan="7" style="text-align: center; color: var(--gray); padding: 3rem;">
                                    No leadership members found. <a href="{{ route('admin.leadership.create') }}">Add your
                                        first leader</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
