@extends('admin.layouts.app')

@section('title', 'Add New Course')

@section('content')
    <div class="content-header">
        <div>
            <h1>Add New Course</h1>
            <p>Create a new training program for your office</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Courses
        </a>
    </div>

    <div class="card">
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="title">Course Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        placeholder="e.g. Master Web Development">
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duration">Duration <span class="required">*</span></label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration') }}" required
                        placeholder="e.g. 6 Months">
                    @error('duration')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price (USD) <span class="required">*</span></label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required
                        placeholder="e.g. 1200.00">
                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="icon">Icon (FontAwesome Class)</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon', 'fas fa-graduation-cap') }}"
                        placeholder="fas fa-code">
                    @error('icon')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Short Description <span class="required">*</span></label>
                <textarea id="description" name="description" rows="3" required
                    placeholder="A brief summary of what students will learn...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Course Topics / Curriculum <span class="required">*</span></label>
                <div id="topics-container">
                    <div class="topic-input-row" style="display: flex; gap: 1rem; margin-bottom: 0.5rem;">
                        <input type="text" name="content[]" required
                            placeholder="Topic/Module Title (e.g. HTML5 & CSS3)">
                        <button type="button" class="btn btn-secondary remove-topic" style="padding: 0.5rem 1rem;"><i
                                class="fas fa-times"></i></button>
                    </div>
                </div>
                <button type="button" id="add-topic" class="btn btn-secondary" style="margin-top: 0.5rem;">
                    <i class="fas fa-plus"></i> Add Topic
                </button>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Featured Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="order">Display Order</label>
                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}">
                </div>
            </div>

            <div class="checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                    <span>Active and Visible on Website</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Course
                </button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('topics-container');
            const addButton = document.getElementById('add-topic');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'topic-input-row';
                row.style.display = 'flex';
                row.style.gap = '1rem';
                row.style.marginBottom = '0.5rem';
                row.innerHTML = `
                    <input type="text" name="content[]" required placeholder="Topic/Module Title">
                    <button type="button" class="btn btn-secondary remove-topic" style="padding: 0.5rem 1rem;"><i class="fas fa-times"></i></button>
                `;
                container.appendChild(row);
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-topic')) {
                    const rows = container.querySelectorAll('.topic-input-row');
                    if (rows.length > 1) {
                        e.target.closest('.topic-input-row').remove();
                    } else {
                        alert('At least one topic is required.');
                    }
                }
            });
        });
    </script>
@endsection
