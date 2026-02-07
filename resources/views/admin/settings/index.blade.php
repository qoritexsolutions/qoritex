@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Site Settings</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <h3 style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">General Settings</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="site_name">Site Name</label>
                    <input type="text" id="site_name" name="settings[site_name]" class="form-control" value="{{ $settings['site_name'] ?? 'TechCompany' }}">
                </div>
                <div class="form-group">
                    <label for="site_tagline">Tagline</label>
                    <input type="text" id="site_tagline" name="settings[site_tagline]" class="form-control" value="{{ $settings['site_tagline'] ?? '' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea id="site_description" name="settings[site_description]" class="form-control" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>

            <h3 style="margin: 2rem 0 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">Contact Information</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="contact_email">Email Address</label>
                    <input type="email" id="contact_email" name="settings[contact_email]" class="form-control" value="{{ $settings['contact_email'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="contact_phone">Phone Number</label>
                    <input type="text" id="contact_phone" name="settings[contact_phone]" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="contact_address">Address</label>
                <textarea id="contact_address" name="settings[contact_address]" class="form-control" rows="2">{{ $settings['contact_address'] ?? '' }}</textarea>
            </div>

            <h3 style="margin: 2rem 0 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">Social Media</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="social_facebook">Facebook URL</label>
                    <input type="url" id="social_facebook" name="settings[social_facebook]" class="form-control" value="{{ $settings['social_facebook'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_twitter">Twitter URL</label>
                    <input type="url" id="social_twitter" name="settings[social_twitter]" class="form-control" value="{{ $settings['social_twitter'] ?? '' }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="social_linkedin">LinkedIn URL</label>
                    <input type="url" id="social_linkedin" name="settings[social_linkedin]" class="form-control" value="{{ $settings['social_linkedin'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_instagram">Instagram URL</label>
                    <input type="url" id="social_instagram" name="settings[social_instagram]" class="form-control" value="{{ $settings['social_instagram'] ?? '' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="social_github">GitHub URL</label>
                <input type="url" id="social_github" name="settings[social_github]" class="form-control" value="{{ $settings['social_github'] ?? '' }}">
            </div>

            <h3 style="margin: 2rem 0 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">Other Settings</h3>

            <div class="form-group">
                <label for="footer_text">Footer Text</label>
                <textarea id="footer_text" name="settings[footer_text]" class="form-control" rows="2">{{ $settings['footer_text'] ?? '' }}</textarea>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
