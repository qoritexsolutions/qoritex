@extends('admin.layouts.app')

@section('title', 'Add Project')

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

    .image-upload-area {
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        background: rgba(15, 23, 42, 0.3);
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
        font-size: 3.5rem;
        color: var(--gray);
        margin-bottom: 1rem;
    }

    .image-upload-text {
        color: var(--gray-light);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .image-upload-hint {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .image-preview {
        max-width: 100%;
        max-height: 300px;
        border-radius: var(--radius);
        margin-top: 1rem;
        display: none;
    }

    .tech-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
        min-height: 40px;
        padding: 0.75rem;
        background: rgba(15, 23, 42, 0.3);
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .tech-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.85rem;
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--primary-light);
    }

    .tech-tag button {
        background: none;
        border: none;
        color: var(--primary-light);
        cursor: pointer;
        padding: 0;
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .tech-tag button:hover {
        color: #ef4444;
        opacity: 1;
    }

    .add-tech-row {
        display: flex;
        gap: 0.75rem;
    }

    .add-tech-row input {
        flex: 1;
    }

    .tech-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .tech-suggestion {
        padding: 0.4rem 0.75rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.8rem;
        color: var(--gray-light);
    }

    .tech-suggestion:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    .category-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .category-option {
        padding: 0.75rem 1.25rem;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        color: var(--gray-light);
    }

    .category-option:hover,
    .category-option.selected {
        background: rgba(99, 102, 241, 0.1);
        border-color: var(--primary);
        color: var(--primary-light);
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

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .gallery-item {
        aspect-ratio: 1;
        background: rgba(15, 23, 42, 0.5);
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .gallery-item:hover {
        border-color: var(--primary);
    }

    .gallery-item i {
        font-size: 2rem;
        color: var(--gray);
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-folder-plus"></i> Add New Project</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Project Image -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-image"></i> Project Image
                </h3>
                <div class="image-upload-area" id="mainImageArea">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <div id="uploadPlaceholder">
                        <div class="image-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <p class="image-upload-text">Drop your project image here or click to browse</p>
                        <p class="image-upload-hint">Recommended size: 1200x800px. Accepts PNG, JPG, WEBP up to 5MB</p>
                    </div>
                    <img id="imagePreview" class="image-preview" src="" alt="">
                </div>
            </div>

            <!-- Basic Information -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Basic Information
                </h3>
                <div class="form-group">
                    <label for="title">Project Title <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g., E-Commerce Platform Redesign" required>
                    @error('title')
                    <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category <span style="color: var(--danger);">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select a category</option>
                            <option value="Web Development" {{ old('category') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Mobile Development" {{ old('category') == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                            <option value="UI/UX Design" {{ old('category') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="Cloud Solutions" {{ old('category') == 'Cloud Solutions' ? 'selected' : '' }}>Cloud Solutions</option>
                            <option value="AI & Machine Learning" {{ old('category') == 'AI & Machine Learning' ? 'selected' : '' }}>AI & Machine Learning</option>
                            <option value="DevOps" {{ old('category') == 'DevOps' ? 'selected' : '' }}>DevOps</option>
                            <option value="E-Commerce" {{ old('category') == 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
                            <option value="Enterprise Software" {{ old('category') == 'Enterprise Software' ? 'selected' : '' }}>Enterprise Software</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="client">Client Name</label>
                        <input type="text" id="client" name="client" class="form-control" value="{{ old('client') }}" placeholder="e.g., Acme Corporation">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Project Description <span style="color: var(--danger);">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="5" placeholder="Describe the project, its goals, challenges, and outcomes..." required>{{ old('description') }}</textarea>
                    @error('description')
                    <p style="color: var(--danger); font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Technologies Used -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-code"></i> Technologies Used
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1rem;">Add the technologies, frameworks, and tools used in this project.</p>
                <div class="tech-container" id="techContainer">
                    <!-- Technologies will be added here -->
                </div>
                <div class="add-tech-row">
                    <input type="text" id="newTech" class="form-control" placeholder="Type and press Enter or click Add">
                    <button type="button" class="btn btn-secondary" onclick="addTech()">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <div class="tech-suggestions">
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Laravel')">Laravel</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('React')">React</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Vue.js')">Vue.js</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Node.js')">Node.js</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Python')">Python</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('AWS')">AWS</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Docker')">Docker</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('MySQL')">MySQL</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('MongoDB')">MongoDB</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Tailwind CSS')">Tailwind CSS</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('TypeScript')">TypeScript</span>
                    <span class="tech-suggestion" onclick="addTechFromSuggestion('Figma')">Figma</span>
                </div>
                <input type="hidden" name="technologies" id="technologiesInput" value="">
            </div>

            <!-- Project Details -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-link"></i> Project Details
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="url">Live Project URL</label>
                        <input type="url" id="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://project-demo.com">
                        <small style="color: var(--gray);">Link to the live project or demo (if available)</small>
                    </div>
                    <div class="form-group">
                        <label for="completed_at">Completion Date</label>
                        <input type="date" id="completed_at" name="completed_at" class="form-control" value="{{ old('completed_at') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="duration">Project Duration</label>
                        <input type="text" id="duration" name="duration" class="form-control" value="{{ old('duration') }}" placeholder="e.g., 3 months">
                    </div>
                    <div class="form-group">
                        <label for="team_size">Team Size</label>
                        <input type="text" id="team_size" name="team_size" class="form-control" value="{{ old('team_size') }}" placeholder="e.g., 5 developers">
                    </div>
                </div>
            </div>

            <!-- Results & Metrics -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-chart-line"></i> Results & Metrics (Optional)
                </h3>
                <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Showcase the impact and results of this project.</p>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="metric1_value">Metric 1 Value</label>
                        <input type="text" id="metric1_value" name="metric1_value" class="form-control" value="{{ old('metric1_value') }}" placeholder="e.g., 150%">
                    </div>
                    <div class="form-group">
                        <label for="metric1_label">Metric 1 Label</label>
                        <input type="text" id="metric1_label" name="metric1_label" class="form-control" value="{{ old('metric1_label') }}" placeholder="e.g., Increase in Sales">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <div style="padding-top: 0.5rem; color: var(--gray);">Result or KPI achieved</div>
                    </div>
                </div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="metric2_value">Metric 2 Value</label>
                        <input type="text" id="metric2_value" name="metric2_value" class="form-control" value="{{ old('metric2_value') }}" placeholder="e.g., 50K+">
                    </div>
                    <div class="form-group">
                        <label for="metric2_label">Metric 2 Label</label>
                        <input type="text" id="metric2_label" name="metric2_label" class="form-control" value="{{ old('metric2_label') }}" placeholder="e.g., Active Users">
                    </div>
                    <div class="form-group"></div>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-cog"></i> Display Settings
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Featured Project</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Show on Homepage</h4>
                                <p>Feature this project prominently on the homepage</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>When enabled, this project will be visible on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
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
                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Custom title for search engines">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="2" placeholder="Description for search results (150-160 characters)">{{ old('meta_description') }}</textarea>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Project
                </button>
                <button type="submit" name="save_and_add" value="1" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Save & Add Another
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
let technologies = [];

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

function addTech() {
    const input = document.getElementById('newTech');
    const tech = input.value.trim();
    
    if (tech && !technologies.includes(tech)) {
        technologies.push(tech);
        updateTechDisplay();
        input.value = '';
    }
    input.focus();
}

function addTechFromSuggestion(tech) {
    if (!technologies.includes(tech)) {
        technologies.push(tech);
        updateTechDisplay();
    }
}

function removeTech(index) {
    technologies.splice(index, 1);
    updateTechDisplay();
}

function updateTechDisplay() {
    const container = document.getElementById('techContainer');
    const hiddenInput = document.getElementById('technologiesInput');
    
    if (technologies.length === 0) {
        container.innerHTML = '<span style="color: var(--gray); font-size: 0.9rem;">No technologies added yet</span>';
    } else {
        container.innerHTML = technologies.map((tech, index) => `
            <span class="tech-tag">
                ${tech}
                <button type="button" onclick="removeTech(${index})"><i class="fas fa-times"></i></button>
            </span>
        `).join('');
    }
    
    hiddenInput.value = JSON.stringify(technologies);
}

document.getElementById('newTech').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addTech();
    }
});

// Initialize
updateTechDisplay();
</script>
@endsection
