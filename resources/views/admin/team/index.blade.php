@extends('admin.layouts.app')

@section('title', 'Team Members')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Team Members</h2>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Member
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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teamMembers as $member)
                    <tr>
                        <td>
                            <div style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                <i class="fas fa-user" style="color: white;"></i>
                                @endif
                            </div>
                        </td>
                        <td><strong>{{ $member->name }}</strong></td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->order }}</td>
                        <td>
                            <span class="badge badge-{{ $member->is_active ? 'success' : 'danger' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.team.edit', $member) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                            No team members found. <a href="{{ route('admin.team.create') }}">Add your first member</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($teamMembers->hasPages())
        <div class="pagination">{{ $teamMembers->links() }}</div>
        @endif
    </div>
</div>
@endsection
