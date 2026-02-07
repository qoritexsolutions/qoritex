@extends('admin.layouts.app')

@section('title', 'Course Admissions')

@section('content')
    <div class="content-header">
        <div>
            <h1>Course Admissions</h1>
            <p>Manage student registrations and applications</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Student Details</th>
                    <th>Course Info</th>
                    <th>Admission Info</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $reg)
                    <tr>
                        <td>
                            <div>
                                <strong style="font-size: 1.1rem; color: var(--white);">{{ $reg->student_name }}</strong><br>
                                <span style="color: var(--gray-light); font-size: 0.85rem;">
                                    <i class="fas fa-envelope"></i> {{ $reg->email }}<br>
                                    <i class="fas fa-phone"></i> {{ $reg->phone }}<br>
                                    <i class="fas fa-map-marker-alt"></i> {{ $reg->city }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong style="color: var(--primary-light);">{{ $reg->course->title }}</strong><br>
                                <span style="font-size: 0.85rem; color: var(--gray-light);">
                                    Fee: ${{ number_format($reg->course_fee, 2) }}<br>
                                    Paid: <span
                                        style="color: var(--success);">${{ number_format($reg->deposit_amount, 2) }}</span>
                                    ({{ $reg->deposit_method }})
                                </span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem; color: var(--gray-light);">
                                Type: <span
                                    class="badge {{ $reg->class_type == 'Physical' ? 'badge-primary' : 'badge-secondary' }}">{{ $reg->class_type }}</span><br>
                                Skill: {{ $reg->skill_level }}<br>
                                Laptop: {{ $reg->has_laptop ? 'Yes' : 'No' }}<br>
                                Date: {{ $reg->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('admin.courses.registrations.status', $reg) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="badge @if ($reg->status == 'pending') badge-warning @elseif($reg->status == 'approved') badge-success @else badge-danger @endif"
                                    style="border: none; cursor: pointer; color: inherit;">
                                    <option value="pending" {{ $reg->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ $reg->status == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="cancelled" {{ $reg->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button type="button" class="action-btn" title="View Full Details"
                                    onclick="showDetails({{ json_encode($reg) }}, '{{ $reg->course->title }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.courses.registrations.destroy', $reg) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this registration?')">
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
                        <td colspan="5" style="text-align: center; padding: 3rem;">No registrations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="padding: 1rem;">
            {{ $registrations->links() }}
        </div>
    </div>

    <!-- Details Modal Placeholder (Simple alert for now, could be a real modal) -->
    <script>
        function showDetails(reg, courseName) {
            let details = `Enrollment Details for ${reg.student_name}\n`;
            details += `-------------------------------------------\n`;
            details += `Father Name: ${reg.father_name}\n`;
            details += `Gender: ${reg.gender}\n`;
            details += `Date of Birth: ${reg.date_of_birth}\n`;
            details += `CNIC: ${reg.cnic}\n\n`;

            details += `WhatsApp: ${reg.whatsapp_number}\n`;
            details += `Address: ${reg.address}, ${reg.city}\n`;
            details += `Education: ${reg.education}\n\n`;

            details += `Emergency Contact: ${reg.emergency_contact_name} (${reg.emergency_relationship})\n`;
            details += `Emergency Phone: ${reg.emergency_phone}\n\n`;

            details += `Goal: ${reg.message || 'No goal provided.'}`;

            alert(details);
        }
    </script>
@endsection
