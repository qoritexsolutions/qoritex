@extends('admin.layouts.app')

@section('title', 'Edit Project')

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

    .current-image {
        margin-bottom: 1.5rem;
    }

    .current-image img {
        max-width: 400px;
        max-height: 250px;
        border-radius: var(--radius);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .current-image-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
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

    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: var(--radius);
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
    }

    .tech-tag button:hover {
        color: #ef4444;
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
        <h2><i class="fas fa-edit"></i> Edit: {{ $project->title }}</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Project Image -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-image"></i> Project Image
                </h3>
                @if($project->image)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                    <p class="current-image-label">Current project image</p>
                </div>
                @endif
                <div class="image-upload-area">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <p style="color: var(--gray-light);">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                        {{ $project->image ? 'Upload new image to replace' : 'Click to upload' }}
                    </p>
                    <p style="font-size: 0.85rem; color: var(--gray);">1200x800px recommended. Max 5MB</p>
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
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category <span style="color: var(--danger);">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach(['Web Development', 'Mobile Development', 'UI/UX Design', 'Cloud Solutions', 'AI & Machine Learning', 'DevOps', 'E-Commerce', 'Enterprise Software'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="client">Client Name</label>
                        <input type="text" id="client" name="client" class="form-control" value="{{ old('client', $project->client) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Project Description <span style="color: var(--danger);">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $project->description) }}</textarea>
                </div>
            </div>

            <!-- Technologies Used -->
            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-code"></i> Technologies Used
                </h3>
                <div class="tech-container" id="techContainer"></div>
                <div class="add-tech-row">
                    <input type="text" id="newTech" class="form-control" placeholder="Type and press Enter">
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
                        <input type="url" id="url" name="url" class="form-control" value="{{ old('url', $project->url) }}">
                    </div>
                    <div class="form-group">
                        <label for="completed_at">Completion Date</label>
                        <input type="date" id="completed_at" name="completed_at" class="form-control" value="{{ old('completed_at', $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}">
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
                        <label>Featured Project</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Show on Homepage</h4>
                                <p>Feature this project on the homepage</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>
                        <div class="toggle-group">
                            <div class="toggle-info">
                                <h4>Active Status</h4>
                                <p>Show this project on the website</p>
                            </div>
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                                <span class="toggle-checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Danger Zone -->
        <div class="form-section danger-zone" style="margin-top: 3rem;">
            <h3 class="form-section-title">
                <i class="fas fa-exclamation-triangle"></i> Danger Zone
            </h3>
            <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Permanently delete this project.</p>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    <i class="fas fa-trash"></i> Delete Project
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let technologies = @json($project->technologies ?? []);

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
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
        container.innerHTML = '<span style="color: var(--gray);">No technologies added</span>';
    } else {
        container.innerHTML = technologies.map((tech, index) => `
            <span class="tech-tag">${tech}<button type="button" onclick="removeTech(${index})"><i class="fas fa-times"></i></button></span>
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

updateTechDisplay();
</script>
@endsection
