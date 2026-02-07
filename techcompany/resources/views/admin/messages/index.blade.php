@extends('admin.layouts.app')

@section('title', 'Messages')

@section('styles')
<style>
    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .filter-tab {
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        color: var(--gray-light);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .filter-tab:hover,
    .filter-tab.active {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }
    .message-row {
        cursor: pointer;
    }
    .message-row:hover {
        background: rgba(99, 102, 241, 0.05) !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Contact Messages</h2>
    </div>
    <div class="card-body">
        <div class="filter-tabs">
            <a href="{{ route('admin.messages.index') }}" class="filter-tab {{ !request('status') ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.messages.index', ['status' => 'new']) }}" class="filter-tab {{ request('status') == 'new' ? 'active' : '' }}">New</a>
            <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" class="filter-tab {{ request('status') == 'read' ? 'active' : '' }}">Read</a>
            <a href="{{ route('admin.messages.index', ['status' => 'replied']) }}" class="filter-tab {{ request('status') == 'replied' ? 'active' : '' }}">Replied</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr class="message-row" onclick="showMessage({{ $message->id }})">
                        <td>
                            <span class="badge badge-{{ $message->status === 'new' ? 'warning' : ($message->status === 'read' ? 'primary' : 'success') }}">
                                {{ ucfirst($message->status) }}
                            </span>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $message->name }}</strong>
                                <div style="font-size: 0.85rem; color: var(--gray);">{{ $message->email }}</div>
                            </div>
                        </td>
                        <td>{{ $message->subject }}</td>
                        <td style="color: var(--gray);">{{ $message->created_at->format('M d, Y h:i A') }}</td>
                        <td onclick="event.stopPropagation()">
                            <div class="actions">
                                @if($message->status === 'new')
                                <form action="{{ route('admin.messages.update-status', $message) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="read">
                                    <button type="submit" class="action-btn" title="Mark as Read">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="5" style="text-align: center; color: var(--gray); padding: 3rem;">
                            No messages found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
        <div class="pagination">{{ $messages->links() }}</div>
        @endif
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--dark-light); border-radius: var(--radius); max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
        <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between;">
            <h3 id="modalSubject">Subject</h3>
            <button onclick="closeModal()" style="background: none; border: none; color: var(--gray); font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div><strong style="color: var(--gray-light);">From:</strong> <span id="modalName"></span></div>
                <div><strong style="color: var(--gray-light);">Email:</strong> <span id="modalEmail"></span></div>
                <div><strong style="color: var(--gray-light);">Phone:</strong> <span id="modalPhone"></span></div>
                <div><strong style="color: var(--gray-light);">Date:</strong> <span id="modalDate"></span></div>
            </div>
            <div style="background: rgba(15,23,42,0.5); padding: 1.5rem; border-radius: var(--radius);">
                <p id="modalMessage" style="line-height: 1.8;"></p>
            </div>
            <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                <a id="replyLink" href="" class="btn btn-primary"><i class="fas fa-reply"></i> Reply via Email</a>
                <button onclick="closeModal()" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
const messages = @json($messages->items());

function showMessage(id) {
    const message = messages.find(m => m.id === id);
    if (!message) return;
    
    document.getElementById('modalSubject').textContent = message.subject;
    document.getElementById('modalName').textContent = message.name;
    document.getElementById('modalEmail').textContent = message.email;
    document.getElementById('modalPhone').textContent = message.phone || 'N/A';
    document.getElementById('modalDate').textContent = new Date(message.created_at).toLocaleString();
    document.getElementById('modalMessage').textContent = message.message;
    document.getElementById('replyLink').href = 'mailto:' + message.email + '?subject=Re: ' + message.subject;
    
    document.getElementById('messageModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}

document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endsection
