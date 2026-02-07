@extends('admin.layouts.app')

@section('title', 'Edit Team Member')

@section('styles')
<style>
    .form-section {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .form-section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-section-title i {
        color: var(--primary);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-row-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .photo-upload-container {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .photo-preview {
        width: 150px;
        height: 150px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.3);
        overflow: hidden;
        flex-shrink: 0;
        border: 4px solid rgba(255, 255, 255, 0.1);
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-upload-info {
        flex: 1;
    }

    .photo-upload-area {
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .photo-upload-area:hover {
        border-color: var(--primary);
        background: rgba(99, 102, 241, 0.05);
    }

    .photo-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .social-input {
        position: relative;
    }

    .social-input i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 1.1rem;
    }

    .social-input input {
        padding-left: 3rem;
    }

    .toggle-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.02);
        border-radius: var(--radius);
    }

    .toggle-label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .toggle-checkbox {
        width: 50px;
        height: 26px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 13px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .toggle-checkbox::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: var(--white);
        border-radius: 50%;
        top: 3px;
        left: 3px;
        transition: transform 0.3s ease;
    }

    .toggle-label input:checked + .toggle-checkbox {
        background: var(--primary);
    }

    .toggle-label input:checked + .toggle-checkbox::after {
        transform: translateX(24px);
    }

    .toggle-label input {
        display: none;
    }

    .toggle-info {
        flex: 1;
    }

    .toggle-info h4 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .toggle-info p {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 50px;
        font-size: 0.9rem;
        color: var(--primary-light);
    }

    .skill-tag button {
        background: none;
        border: none;
        color: var(--primary-light);
        cursor: pointer;
        padding: 0;
        font-size: 0.85rem;
    }

    .skill-tag button:hover {
        color: #ef4444;
    }

    .add-skill-row {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .add-skill-row input {
        flex: 1;
    }

    .add-skill-row button {
        padding: 0.75rem 1.5rem;
    }

    .danger-zone {
        background: rgba(239, 68, 68, 0.05);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .danger-zone .form-section-title {
        color: #ef4444;
    }

    .danger-zone .form-section-title i {
        color: #ef4444;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-user-edit"></i> Edit: {{ $teamMember->name }}</h2>
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.team.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Photo -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-camera"></i> Profile Photo
                </h3>
                <div class="photo-upload-container">
                    <div class="photo-preview" id="photoPreview">
                        @if($teamMember->photo)
                        <img src="{{ asset('storage/' . $teamMember->photo) }}" alt="{{ $teamMember->name }}">
                        @else
                        <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="photo-upload-info">
                        <div class="photo-upload-area">
                            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(this)">
                            <p style="color: var(--gray-light); margin-bottom: 0.5rem;">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                                {{ $teamMember->photo ? 'Upload new photo to replace' : 'Click to upload or drag and drop' }}
                            </p>
                            <p style="font-size: 0.85rem; color: var(--gray);">PNG, JPG up to 2MB. Square images work best (400x400px recommended)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Basic Information
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $teamMember->name) }}" required>
                        @error('name')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Position/Title <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="position" name="position" class="form-control" value="{{ old('position', $teamMember->position) }}" required>
                        @error('position')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $teamMember->email ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $teamMember->phone ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea id="bio" name="bio" class="form-control" rows="4">{{ old('bio', $teamMember->bio) }}</textarea>
                    <small style="color: var(--gray);">A brief description that will appear on the team page.</small>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-share-alt"></i> Social Media Links
                </h3>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <div class="social-input">
                            <i class="fab fa-linkedin"></i>
                            <input type="url" id="linkedin" name="linkedin" class="form-control" value="{{ old('linkedin', $teamMember->linkedin) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter / X</label>
                        <div class="social-input">
                            <i class="fab fa-twitter"></i>
                            <input type="url" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', $teamMember->twitter) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="github">GitHub</label>
                        <div class="social-input">
                            <i class="fab fa-github"></i>
                            <input type="url" id="github" name="github" class="form-control" value="{{ old('github', $teamMember->github) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-cog"></i> Display Settings
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" id="order" name="order" class="form-control" value="{{ old('order', $teamMember->order) }}" min="0">
                        <small style="color: var(--gray);">Lower numbers appear first.</small>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>When enabled, this team member will be visible on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $teamMember->is_active) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Team Member
                </button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Danger Zone -->
        <div class="form-section danger-zone" style="margin-top: 3rem;">
            <h3 class="form-section-title">
                <i class="fas fa-exclamation-triangle"></i> Danger Zone
            </h3>
            <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Permanently delete this team member.</p>
            <form action="{{ route('admin.team.destroy', $teamMember) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    <i class="fas fa-trash"></i> Delete Team Member
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewPhoto(input) {
    const preview = document.getElementById('photoPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
