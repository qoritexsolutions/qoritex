@extends('admin.layouts.app')

@section('title', 'Add Team Member')

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
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-user-plus"></i> Add New Team Member</h2>
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Photo -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-camera"></i> Profile Photo
                </h3>
                <div class="photo-upload-container">
                    <div class="photo-preview" id="photoPreview">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="photo-upload-info">
                        <div class="photo-upload-area">
                            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(this)">
                            <p style="color: var(--gray-light); margin-bottom: 0.5rem;">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                                Click to upload or drag and drop
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
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., John Smith" required>
                        @error('name')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Position/Title <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}" placeholder="e.g., Senior Developer" required>
                        @error('position')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="e.g., john@company.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="e.g., +1 234 567 8900">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea id="bio" name="bio" class="form-control" rows="4" placeholder="Write a short biography about this team member...">{{ old('bio') }}</textarea>
                    <small style="color: var(--gray);">A brief description that will appear on the team page. Keep it engaging and professional.</small>
                </div>
            </div>

            <!-- Skills & Expertise -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-tools"></i> Skills & Expertise
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1rem;">Add skills or areas of expertise for this team member.</p>
                <div class="skills-container" id="skillsContainer">
                    <!-- Skills will be added here dynamically -->
                </div>
                <div class="add-skill-row">
                    <input type="text" id="newSkill" class="form-control" placeholder="e.g., Laravel, React, Project Management">
                    <button type="button" class="btn btn-secondary" onclick="addSkill()">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <input type="hidden" name="skills" id="skillsInput" value="">
            </div>

            <!-- Social Media Links -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-share-alt"></i> Social Media Links
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Add social media profile URLs to display on the team member's card.</p>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <div class="social-input">
                            <i class="fab fa-linkedin"></i>
                            <input type="url" id="linkedin" name="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter / X</label>
                        <div class="social-input">
                            <i class="fab fa-twitter"></i>
                            <input type="url" id="twitter" name="twitter" class="form-control" value="{{ old('twitter') }}" placeholder="https://twitter.com/username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="github">GitHub</label>
                        <div class="social-input">
                            <i class="fab fa-github"></i>
                            <input type="url" id="github" name="github" class="form-control" value="{{ old('github') }}" placeholder="https://github.com/username">
                        </div>
                    </div>
                </div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <div class="social-input">
                            <i class="fab fa-facebook"></i>
                            <input type="url" id="facebook" name="facebook" class="form-control" value="{{ old('facebook') }}" placeholder="https://facebook.com/username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <div class="social-input">
                            <i class="fab fa-instagram"></i>
                            <input type="url" id="instagram" name="instagram" class="form-control" value="{{ old('instagram') }}" placeholder="https://instagram.com/username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website">Personal Website</label>
                        <div class="social-input">
                            <i class="fas fa-globe"></i>
                            <input type="url" id="website" name="website" class="form-control" value="{{ old('website') }}" placeholder="https://example.com">
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
                        <input type="number" id="order" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                        <small style="color: var(--gray);">Lower numbers appear first. Use this to control the order of team members.</small>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>When enabled, this team member will be visible on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Featured Team Member</label>
                    <div class="toggle-group">
                        <div class="toggle-info">
                            <h4>Show on Homepage</h4>
                            <p>Feature this team member prominently on the homepage</p>
                        </div>
                        <label class="toggle-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <span class="toggle-checkbox"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Team Member
                </button>
                <button type="submit" name="save_and_add" value="1" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Save & Add Another
                </button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
let skills = [];

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

function addSkill() {
    const input = document.getElementById('newSkill');
    const skill = input.value.trim();
    
    if (skill && !skills.includes(skill)) {
        skills.push(skill);
        updateSkillsDisplay();
        input.value = '';
    }
}

function removeSkill(index) {
    skills.splice(index, 1);
    updateSkillsDisplay();
}

function updateSkillsDisplay() {
    const container = document.getElementById('skillsContainer');
    const hiddenInput = document.getElementById('skillsInput');
    
    container.innerHTML = skills.map((skill, index) => `
        <span class="skill-tag">
            ${skill}
            <button type="button" onclick="removeSkill(${index})"><i class="fas fa-times"></i></button>
        </span>
    `).join('');
    
    hiddenInput.value = JSON.stringify(skills);
}

document.getElementById('newSkill').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addSkill();
    }
});
</script>
@endsection
