@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

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
        <h2><i class="fas fa-edit"></i> Edit Testimonial</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Client Photo -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-user-circle"></i> Client Photo
                </h3>
                <div class="photo-upload-container">
                    <div class="photo-preview" id="photoPreview">
                        @if($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->client_name }}">
                        @else
                        <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="photo-upload-info">
                        <div class="photo-upload-area">
                            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(this)">
                            <p style="color: var(--gray-light); margin-bottom: 0.5rem;">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                                {{ $testimonial->photo ? 'Upload new photo to replace' : 'Click to upload' }}
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
                        <input type="text" id="client_name" name="client_name" class="form-control" value="{{ old('client_name', $testimonial->client_name) }}" required oninput="updatePreview()">
                    </div>
                    <div class="form-group">
                        <label for="client_position">Position/Title <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="client_position" name="client_position" class="form-control" value="{{ old('client_position', $testimonial->client_position) }}" required oninput="updatePreview()">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="company">Company Name <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="company" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}" required oninput="updatePreview()">
                    </div>
                    <div class="form-group">
                        <label for="company_url">Company Website</label>
                        <input type="url" id="company_url" name="company_url" class="form-control" value="{{ old('company_url', $testimonial->company_url ?? '') }}">
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
                    <textarea id="content" name="content" class="form-control" rows="5" required oninput="updatePreview()">{{ old('content', $testimonial->content) }}</textarea>
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
                    <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', $testimonial->rating) }}" required>
                </div>

                <!-- Live Preview -->
                <div class="testimonial-preview">
                    <p class="testimonial-preview-content" id="previewContent">"{{ $testimonial->content }}"</p>
                    <div class="testimonial-preview-author">
                        <div class="preview-avatar" id="previewAvatar">
                            @if($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="">
                            @else
                            <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div class="preview-info">
                            <h4 id="previewName">{{ $testimonial->client_name }}</h4>
                            <p id="previewPosition">{{ $testimonial->client_position }} at {{ $testimonial->company }}</p>
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
                        <input type="number" id="order" name="order" class="form-control" value="{{ old('order', $testimonial->order) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>Show this testimonial on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
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
                            <p>Feature this testimonial on the homepage</p>
                        </div>
                        <label class="toggle-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}>
                            <span class="toggle-checkbox"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Testimonial
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Danger Zone -->
        <div class="form-section danger-zone" style="margin-top: 3rem;">
            <h3 class="form-section-title">
                <i class="fas fa-exclamation-triangle"></i> Danger Zone
            </h3>
            <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Permanently delete this testimonial.</p>
            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    <i class="fas fa-trash"></i> Delete Testimonial
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentRating = {{ old('rating', $testimonial->rating) }};

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
</script>
@endsection
