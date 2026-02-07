@extends('admin.layouts.app')

@section('title', 'Add Testimonial')

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
        width: 120px;
        height: 120px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
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

    .testimonial-preview {
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-top: 1.5rem;
        position: relative;
    }

    .testimonial-preview::before {
        content: '"';
        position: absolute;
        top: 1rem;
        left: 1.5rem;
        font-size: 4rem;
        color: var(--primary);
        opacity: 0.3;
        font-family: Georgia, serif;
        line-height: 1;
    }

    .testimonial-preview-content {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--gray-light);
        font-style: italic;
        padding-left: 2rem;
        min-height: 60px;
    }

    .testimonial-preview-author {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-left: 2rem;
    }

    .preview-avatar {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.25rem;
        overflow: hidden;
    }

    .preview-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-info h4 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .preview-info p {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .rating-input {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .rating-star {
        font-size: 1.75rem;
        color: var(--gray);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .rating-star:hover,
    .rating-star.active {
        color: #fbbf24;
        transform: scale(1.1);
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

    .char-count {
        font-size: 0.85rem;
        color: var(--gray);
        text-align: right;
        margin-top: 0.5rem;
    }

    .char-count.warning {
        color: #f59e0b;
    }

    .char-count.danger {
        color: #ef4444;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-comment-dots"></i> Add New Testimonial</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Client Photo -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-user-circle"></i> Client Photo
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
                                Click to upload client photo
                            </p>
                            <p style="font-size: 0.85rem; color: var(--gray);">Square images work best. 200x200px recommended</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Information -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Client Information
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="client_name">Client Name <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="client_name" name="client_name" class="form-control" value="{{ old('client_name') }}" placeholder="e.g., John Smith" required oninput="updatePreview()">
                        @error('client_name')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="client_position">Position/Title <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="client_position" name="client_position" class="form-control" value="{{ old('client_position') }}" placeholder="e.g., CEO" required oninput="updatePreview()">
                        @error('client_position')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="company">Company Name <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="company" name="company" class="form-control" value="{{ old('company') }}" placeholder="e.g., Acme Corporation" required oninput="updatePreview()">
                        @error('company')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company_url">Company Website</label>
                        <input type="url" id="company_url" name="company_url" class="form-control" value="{{ old('company_url') }}" placeholder="https://company.com">
                    </div>
                </div>
            </div>

            <!-- Testimonial Content -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-quote-left"></i> Testimonial Content
                </h3>
                <div class="form-group">
                    <label for="content">Testimonial Text <span style="color: var(--danger);">*</span></label>
                    <textarea id="content" name="content" class="form-control" rows="5" placeholder="What did the client say about your services..." required oninput="updatePreview(); updateCharCount(this);" maxlength="500">{{ old('content') }}</textarea>
                    <div class="char-count" id="charCount">0 / 500 characters</div>
                    @error('content')
                    <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Rating <span style="color: var(--danger);">*</span></label>
                    <div class="rating-input" id="ratingInput">
                        <i class="fas fa-star rating-star" data-rating="1" onclick="setRating(1)"></i>
                        <i class="fas fa-star rating-star" data-rating="2" onclick="setRating(2)"></i>
                        <i class="fas fa-star rating-star" data-rating="3" onclick="setRating(3)"></i>
                        <i class="fas fa-star rating-star" data-rating="4" onclick="setRating(4)"></i>
                        <i class="fas fa-star rating-star" data-rating="5" onclick="setRating(5)"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', 5) }}" required>
                    <small style="color: var(--gray);">Click to set the rating (1-5 stars)</small>
                </div>

                <!-- Live Preview -->
                <div class="testimonial-preview">
                    <p class="testimonial-preview-content" id="previewContent">"Your testimonial will appear here..."</p>
                    <div class="testimonial-preview-author">
                        <div class="preview-avatar" id="previewAvatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="preview-info">
                            <h4 id="previewName">Client Name</h4>
                            <p id="previewPosition">Position at Company</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Association -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-project-diagram"></i> Project Association (Optional)
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1rem;">Link this testimonial to a specific project for context.</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="project_id">Related Project</label>
                        <select id="project_id" name="project_id" class="form-control">
                            <option value="">No project associated</option>
                            @if(isset($projects))
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_type">Service Type</label>
                        <select id="service_type" name="service_type" class="form-control">
                            <option value="">Select service type</option>
                            <option value="Web Development" {{ old('service_type') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Mobile Development" {{ old('service_type') == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                            <option value="UI/UX Design" {{ old('service_type') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="Cloud Solutions" {{ old('service_type') == 'Cloud Solutions' ? 'selected' : '' }}>Cloud Solutions</option>
                            <option value="Consulting" {{ old('service_type') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                        </select>
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
                        <small style="color: var(--gray);">Lower numbers appear first on the website.</small>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>When enabled, this testimonial will be visible on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Featured Testimonial</label>
                    <div class="toggle-group">
                        <div class="toggle-info">
                            <h4>Show on Homepage</h4>
                            <p>Feature this testimonial prominently on the homepage</p>
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
                    <i class="fas fa-save"></i> Save Testimonial
                </button>
                <button type="submit" name="save_and_add" value="1" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Save & Add Another
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentRating = {{ old('rating', 5) }};

document.addEventListener('DOMContentLoaded', function() {
    setRating(currentRating);
    updatePreview();
});

function previewPhoto(input) {
    const preview = document.getElementById('photoPreview');
    const avatarPreview = document.getElementById('previewAvatar');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
            avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function setRating(rating) {
    currentRating = rating;
    document.getElementById('ratingValue').value = rating;
    
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

function updatePreview() {
    const content = document.getElementById('content').value || 'Your testimonial will appear here...';
    const name = document.getElementById('client_name').value || 'Client Name';
    const position = document.getElementById('client_position').value || 'Position';
    const company = document.getElementById('company').value || 'Company';
    
    document.getElementById('previewContent').textContent = '"' + content + '"';
    document.getElementById('previewName').textContent = name;
    document.getElementById('previewPosition').textContent = position + ' at ' + company;
}

function updateCharCount(textarea) {
    const count = textarea.value.length;
    const max = 500;
    const countEl = document.getElementById('charCount');
    
    countEl.textContent = count + ' / ' + max + ' characters';
    countEl.classList.remove('warning', 'danger');
    
    if (count > 450) {
        countEl.classList.add('danger');
    } else if (count > 350) {
        countEl.classList.add('warning');
    }
}
</script>
@endsection
