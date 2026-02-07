@extends('admin.layouts.app')

@section('title', 'Add Leadership Member')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Add Leadership Member</h2>
            <a href="{{ route('admin.leadership.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.leadership.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position">Position <span class="required">*</span></label>
                        <input type="text" id="position" name="position" value="{{ old('position') }}"
                            placeholder="e.g. Chief Executive Officer (CEO)" required>
                        @error('position')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4" placeholder="Brief biography...">{{ old('bio') }}</textarea>
                    @error('bio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quote">Quote (Featured Leaders)</label>
                    <textarea id="quote" name="quote" rows="2" placeholder="Inspirational quote...">{{ old('quote') }}</textarea>
                    @error('quote')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon Class (if no photo)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', 'fas fa-user-tie') }}"
                            placeholder="e.g. fas fa-user-tie">
                        <small style="color: var(--gray-light);">Font Awesome icon class</small>
                        @error('icon')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="linkedin">LinkedIn URL</label>
                        <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                            placeholder="https://linkedin.com/in/...">
                        @error('linkedin')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter URL</label>
                        <input type="url" id="twitter" name="twitter" value="{{ old('twitter') }}"
                            placeholder="https://twitter.com/...">
                        @error('twitter')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="github">GitHub URL</label>
                        <input type="url" id="github" name="github" value="{{ old('github') }}"
                            placeholder="https://github.com/...">
                        @error('github')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="email@example.com">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                        @error('order')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group" style="margin-top: 2rem;">
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <span>Featured (CEO/Primary Leader)</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                <span>Active</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Leader
                    </button>
                    <a href="{{ route('admin.leadership.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
