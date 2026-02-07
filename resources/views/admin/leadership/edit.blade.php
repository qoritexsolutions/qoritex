@extends('admin.layouts.app')

@section('title', 'Edit Leadership Member')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Leadership Member</h2>
            <a href="{{ route('admin.leadership.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.leadership.update', $leadership) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $leadership->name) }}"
                            required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position">Position <span class="required">*</span></label>
                        <input type="text" id="position" name="position"
                            value="{{ old('position', $leadership->position) }}" required>
                        @error('position')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4">{{ old('bio', $leadership->bio) }}</textarea>
                    @error('bio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quote">Quote (Featured Leaders)</label>
                    <textarea id="quote" name="quote" rows="2">{{ old('quote', $leadership->quote) }}</textarea>
                    @error('quote')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        @if ($leadership->photo)
                            <div style="margin-bottom: 1rem;">
                                <img src="{{ asset('storage/' . $leadership->photo) }}" alt="{{ $leadership->name }}"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px;">
                                <p style="color: var(--gray-light); font-size: 0.875rem; margin-top: 0.5rem;">Current photo
                                </p>
                            </div>
                        @endif
                        <input type="file" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon Class (if no photo)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $leadership->icon) }}">
                        <small style="color: var(--gray-light);">Font Awesome icon class</small>
                        @error('icon')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="linkedin">LinkedIn URL</label>
                        <input type="url" id="linkedin" name="linkedin"
                            value="{{ old('linkedin', $leadership->linkedin) }}">
                        @error('linkedin')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter URL</label>
                        <input type="url" id="twitter" name="twitter"
                            value="{{ old('twitter', $leadership->twitter) }}">
                        @error('twitter')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="github">GitHub URL</label>
                        <input type="url" id="github" name="github"
                            value="{{ old('github', $leadership->github) }}">
                        @error('github')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $leadership->email) }}">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $leadership->order) }}"
                            min="0">
                        @error('order')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group" style="margin-top: 2rem;">
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured', $leadership->is_featured) ? 'checked' : '' }}>
                                <span>Featured (CEO/Primary Leader)</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $leadership->is_active) ? 'checked' : '' }}>
                                <span>Active</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Leader
                    </button>
                    <a href="{{ route('admin.leadership.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
