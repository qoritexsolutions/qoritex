@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Testimonial
        </a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Company</th>
                        <th>Rating</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 40px; height: 40px; background: var(--gradient-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($testimonial->client_photo)
                                    <img src="{{ asset('storage/' . $testimonial->client_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                    <i class="fas fa-user" style="color: white;"></i>
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $testimonial->client_name }}</strong>
                                    <div style="font-size: 0.85rem; color: var(--gray);">{{ $testimonial->client_position }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $testimonial->client_company ?? '-' }}</td>
                        <td>
                            <span style="color: #fbbf24;">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                @endfor
                            </span>
                        </td>
                        <td>{{ Str::limit($testimonial->content, 50) }}</td>
                        <td>
                            <span class="badge badge-{{ $testimonial->is_active ? 'success' : 'danger' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                            No testimonials found. <a href="{{ route('admin.testimonials.create') }}">Add your first testimonial</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($testimonials->hasPages())
        <div class="pagination">{{ $testimonials->links() }}</div>
        @endif
    </div>
</div>
@endsection
