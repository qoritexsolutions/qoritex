@extends('admin.layouts.app')

@section('title', 'Edit Service')

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

    .icon-preview {
        width: 60px;
        height: 60px;
        background: var(--gradient-primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--white);
        margin-top: 0.5rem;
    }

    .icon-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .icon-suggestion {
        padding: 0.5rem 0.75rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--gray-light);
    }

    .icon-suggestion:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    .image-upload-area {
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .image-upload-area:hover {
        border-color: var(--primary);
        background: rgba(99, 102, 241, 0.05);
    }

    .image-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .image-upload-icon {
        font-size: 3rem;
        color: var(--gray);
        margin-bottom: 1rem;
    }

    .image-upload-text {
        color: var(--gray-light);
        margin-bottom: 0.5rem;
    }

    .image-upload-hint {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .current-image {
        margin-bottom: 1rem;
    }

    .current-image img {
        max-width: 300px;
        max-height: 200px;
        border-radius: var(--radius);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .current-image-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    .features-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .feature-input {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .feature-input input {
        flex: 1;
    }

    .add-feature-btn {
        padding: 0.75rem 1.25rem;
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: var(--primary-light);
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .add-feature-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    .remove-feature-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-feature-btn:hover {
        background: #ef4444;
        color: var(--white);
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
        <h2><i class="fas fa-edit"></i> Edit Service: {{ $service->title }}</h2>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Basic Information
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Service Title <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $service->title) }}" placeholder="e.g., Web Development" required>
                        @error('title')
                        <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon (Font Awesome Class) <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="icon" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}" placeholder="e.g., fas fa-code" required>
                        <div class="icon-suggestions">
                            <span class="icon-suggestion" onclick="setIcon('fas fa-code')"><i class="fas fa-code"></i> Code</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-mobile-alt')"><i class="fas fa-mobile-alt"></i> Mobile</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-cloud')"><i class="fas fa-cloud"></i> Cloud</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-brain')"><i class="fas fa-brain"></i> AI</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-palette')"><i class="fas fa-palette"></i> Design</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-shield-alt')"><i class="fas fa-shield-alt"></i> Security</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-database')"><i class="fas fa-database"></i> Database</span>
                            <span class="icon-suggestion" onclick="setIcon('fas fa-chart-line')"><i class="fas fa-chart-line"></i> Analytics</span>
                        </div>
                        <div class="icon-preview" id="iconPreview">
                            <i class="{{ old('icon', $service->icon ?? 'fas fa-code') }}"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <input type="text" id="short_description" name="short_description" class="form-control" value="{{ old('short_description', $service->short_description ?? '') }}" placeholder="Brief one-line description (shown in cards)" maxlength="150">
                    <small style="color: var(--gray);">Max 150 characters. This appears on service cards.</small>
                </div>

                <div class="form-group">
                    <label for="description">Full Description <span style="color: var(--danger);">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="6" placeholder="Detailed description of the service..." required>{{ old('description', $service->description) }}</textarea>
                    @error('description')
                    <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Service Features -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-list-check"></i> Service Features
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1rem;">Add key features or benefits of this service. These will be displayed as bullet points.</p>
                <div class="features-container" id="featuresContainer">
                    @php
                        $features = old('features', $service->features ?? ['', '', '']);
                        if (!is_array($features)) $features = ['', '', ''];
                    @endphp
                    @foreach($features as $index => $feature)
                    <div class="feature-input">
                        <input type="text" name="features[]" class="form-control" value="{{ $feature }}" placeholder="Enter feature...">
                        @if($index > 0)
                        <button type="button" class="remove-feature-btn" onclick="removeFeature(this)">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                    </div>
                    @endforeach
                </div>
                <button type="button" class="add-feature-btn" onclick="addFeature()">
                    <i class="fas fa-plus"></i> Add Another Feature
                </button>
            </div>

            <!-- Media Section -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-image"></i> Media
                </h3>
                <div class="form-group">
                    <label>Service Image</label>
                    @if($service->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        <p class="current-image-label">Current image</p>
                    </div>
                    @endif
                    <div class="image-upload-area">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <div id="uploadPlaceholder">
                            <div class="image-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <p class="image-upload-text">{{ $service->image ? 'Upload new image to replace' : 'Drag & drop an image or click to browse' }}</p>
                            <p class="image-upload-hint">Recommended size: 800x600px. Max file size: 2MB</p>
                        </div>
                        <img id="imagePreview" src="" alt="" style="max-width: 300px; max-height: 200px; display: none; margin: 0 auto;">
                    </div>
                </div>
            </div>

            <!-- Pricing (Optional) -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-tag"></i> Pricing Information (Optional)
                </h3>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="price_type">Pricing Type</label>
                        <select id="price_type" name="price_type" class="form-control">
                            <option value="">Not Specified</option>
                            <option value="fixed" {{ old('price_type', $service->price_type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                            <option value="hourly" {{ old('price_type', $service->price_type ?? '') == 'hourly' ? 'selected' : '' }}>Hourly Rate</option>
                            <option value="custom" {{ old('price_type', $service->price_type ?? '') == 'custom' ? 'selected' : '' }}>Custom Quote</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="starting_price">Starting Price ($)</label>
                        <input type="number" id="starting_price" name="starting_price" class="form-control" value="{{ old('starting_price', $service->starting_price ?? '') }}" placeholder="e.g., 999" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="price_note">Price Note</label>
                        <input type="text" id="price_note" name="price_note" class="form-control" value="{{ old('price_note', $service->price_note ?? '') }}" placeholder="e.g., Starting from">
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
                        <input type="number" id="order" name="order" class="form-control" value="{{ old('order', $service->order) }}" min="0">
                        <small style="color: var(--gray);">Lower numbers appear first. Default is 0.</small>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>When enabled, this service will be visible on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Featured Service</label>
                    <div class="toggle-group">
                        <div class="toggle-info">
                            <h4>Featured on Homepage</h4>
                            <p>Show this service prominently on the homepage</p>
                        </div>
                        <label class="toggle-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured ?? false) ? 'checked' : '' }}>
                            <span class="toggle-checkbox"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-search"></i> SEO Settings (Optional)
                </h3>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title ?? '') }}" placeholder="Custom title for search engines (leave blank to use service title)">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Description for search engine results (150-160 characters recommended)">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Danger Zone -->
        <div class="form-section danger-zone" style="margin-top: 3rem;">
            <h3 class="form-section-title">
                <i class="fas fa-exclamation-triangle"></i> Danger Zone
            </h3>
            <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Permanently delete this service. This action cannot be undone.</p>
            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this service? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    <i class="fas fa-trash"></i> Delete Service
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function setIcon(iconClass) {
    document.getElementById('icon').value = iconClass;
    document.getElementById('iconPreview').innerHTML = '<i class="' + iconClass + '"></i>';
}

document.getElementById('icon').addEventListener('input', function() {
    document.getElementById('iconPreview').innerHTML = '<i class="' + this.value + '"></i>';
});

function addFeature() {
    const container = document.getElementById('featuresContainer');
    
    const newFeature = document.createElement('div');
    newFeature.className = 'feature-input';
    newFeature.innerHTML = `
        <input type="text" name="features[]" class="form-control" placeholder="Enter feature...">
        <button type="button" class="remove-feature-btn" onclick="removeFeature(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newFeature);
}

function removeFeature(button) {
    button.parentElement.remove();
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('uploadPlaceholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
