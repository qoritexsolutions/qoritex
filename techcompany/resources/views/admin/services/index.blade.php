@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Services</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Service
        </a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>
                            <div style="width: 40px; height: 40px; background: var(--gradient-primary); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $service->icon ?? 'fas fa-cog' }}" style="color: white;"></i>
                            </div>
                        </td>
                        <td><strong>{{ $service->title }}</strong></td>
                        <td>{{ Str::limit($service->description, 50) }}</td>
                        <td>{{ $service->order }}</td>
                        <td>
                            <span class="badge badge-{{ $service->is_active ? 'success' : 'danger' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.services.edit', $service) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?')">
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
                            No services found. <a href="{{ route('admin.services.create') }}">Add your first service</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
        <div class="pagination">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
