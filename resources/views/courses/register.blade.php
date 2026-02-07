@extends('layouts.app')

@section('title', 'Course Registration')

@section('styles')
    <style>
        .register-hero {
            padding: 10rem 0 4rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
        }

        .register-section {
            padding: 6rem 0;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--dark-light);
            padding: 4rem;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .form-header p {
            color: var(--gray-light);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--gray-light);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.5rem;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.5rem center;
            background-size: 1.25rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1.25rem;
            font-size: 1.125rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        .alert {
            padding: 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-container {
                padding: 2.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="register-hero">
        <div class="container">
            <h1>Join Our <span>Learning Community</span></h1>
            <p>Complete the form below to register for your desired course. Our team will review your application and get
                back to you with the admission process.</p>
        </div>
    </section>

    <section class="register-section">
        <div class="container">
            <div class="form-container" style="max-width: 1000px;">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert"
                        style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger);">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-header">
                    <h2>Course Enrollment Form</h2>
                    <p>Please fill in all the details below to complete your registration application.</p>
                </div>

                <form action="{{ route('courses.register.store') }}" method="POST">
                    @csrf

                    <!-- Student Information -->
                    <div style="margin-bottom: 3rem;">
                        <h3
                            style="color: var(--primary-light); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-user-graduate"></i> Student Information
                        </h3>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="student_name">Full Name <span class="required">*</span></label>
                                <input type="text" name="student_name" id="student_name" class="form-control"
                                    value="{{ old('student_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Father Name <span class="required">*</span></label>
                                <input type="text" name="father_name" id="father_name" class="form-control"
                                    value="{{ old('father_name') }}" required>
                            </div>
                        </div>

                        <div class="form-grid" style="grid-template-columns: 1fr 1fr 1fr;">
                            <div class="form-group">
                                <label for="gender">Gender <span class="required">*</span></label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                    value="{{ old('date_of_birth') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cnic">CNIC / ID Number <span class="required">*</span></label>
                                <input type="text" name="cnic" id="cnic" class="form-control"
                                    value="{{ old('cnic') }}" placeholder="12345-1234567-1" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="whatsapp_number">WhatsApp Number <span class="required">*</span></label>
                                <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control"
                                    value="{{ old('whatsapp_number') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City <span class="required">*</span></label>
                                <input type="text" name="city" id="city" class="form-control"
                                    value="{{ old('city') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Postal Address <span class="required">*</span></label>
                            <textarea name="address" id="address" rows="2" class="form-control" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="form-grid" style="grid-template-columns: 2fr 1fr;">
                            <div class="form-group">
                                <label for="education">Highest Education <span class="required">*</span></label>
                                <input type="text" name="education" id="education" class="form-control"
                                    value="{{ old('education') }}" placeholder="e.g. BS Computer Science" required>
                            </div>
                            <div class="form-group">
                                <label for="skill_level">Current Skill Level <span class="required">*</span></label>
                                <select name="skill_level" id="skill_level" class="form-control" required>
                                    <option value="Beginner" {{ old('skill_level') == 'Beginner' ? 'selected' : '' }}>
                                        Beginner</option>
                                    <option value="Intermediate"
                                        {{ old('skill_level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('skill_level') == 'Advanced' ? 'selected' : '' }}>
                                        Advanced</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Do you have a laptop? <span class="required">*</span></label>
                                <div style="display: flex; gap: 2rem; margin-top: 0.5rem;">
                                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                        <input type="radio" name="has_laptop" value="1"
                                            {{ old('has_laptop') == '1' ? 'checked' : '' }} required> Yes
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                        <input type="radio" name="has_laptop" value="0"
                                            {{ old('has_laptop') == '0' ? 'checked' : '' }}> No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="class_type">Class Type <span class="required">*</span></label>
                                <select name="class_type" id="class_type" class="form-control" required>
                                    <option value="Physical" {{ old('class_type') == 'Physical' ? 'selected' : '' }}>
                                        Physical (On-site)</option>
                                    <option value="Online" {{ old('class_type') == 'Online' ? 'selected' : '' }}>Online
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Your Goal / Expectations</label>
                            <textarea name="message" id="message" rows="2" class="form-control"
                                placeholder="What do you hope to achieve?">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <!-- Course Details -->
                    <div style="margin-bottom: 3rem;">
                        <h3
                            style="color: var(--primary-light); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-book-open"></i> Course Details
                        </h3>

                        <div class="form-group">
                            <label for="course_id">Select Course <span class="required">*</span></label>
                            <select name="course_id" id="course_id" class="form-control" required
                                onchange="updateCourseDetails(this)">
                                <option value="">-- Choose a Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" data-price="{{ $course->price }}"
                                        data-duration="{{ $course->duration }}"
                                        {{ (isset($selectedCourse) && $selectedCourse->id == $course->id) || old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-grid" style="grid-template-columns: 1fr 1fr 1fr;">
                            <div class="form-group">
                                <label for="course_fee">Course Fee (USD)</label>
                                <input type="number" name="course_fee" id="course_fee" class="form-control"
                                    value="{{ old('course_fee') }}" readonly style="background: rgba(255,255,255,0.05);">
                            </div>
                            <div class="form-group">
                                <label for="deposit_amount">Deposit Amount <span class="required">*</span></label>
                                <input type="number" name="deposit_amount" id="deposit_amount" class="form-control"
                                    value="{{ old('deposit_amount') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit_method">Payment Method <span class="required">*</span></label>
                                <select name="deposit_method" id="deposit_method" class="form-control" required>
                                    <option value="Full" {{ old('deposit_method') == 'Full' ? 'selected' : '' }}>Full
                                        Payment</option>
                                    <option value="Installment"
                                        {{ old('deposit_method') == 'Installment' ? 'selected' : '' }}>Installments
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div style="margin-bottom: 3rem;">
                        <h3
                            style="color: var(--primary-light); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-phone-alt"></i> Emergency Contact
                        </h3>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="emergency_contact_name">Contact Name <span class="required">*</span></label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                                    class="form-control" value="{{ old('emergency_contact_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="emergency_relationship">Relationship <span class="required">*</span></label>
                                <input type="text" name="emergency_relationship" id="emergency_relationship"
                                    class="form-control" value="{{ old('emergency_relationship') }}"
                                    placeholder="e.g. Father, Brother" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="emergency_phone">Emergency Phone <span class="required">*</span></label>
                                <input type="tel" name="emergency_phone" id="emergency_phone" class="form-control"
                                    value="{{ old('emergency_phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="emergency_whatsapp">Emergency WhatsApp <span class="required">*</span></label>
                                <input type="tel" name="emergency_whatsapp" id="emergency_whatsapp"
                                    class="form-control" value="{{ old('emergency_whatsapp') }}" required>
                            </div>
                        </div>
                    </div>

                    <div
                        style="background: rgba(255,255,255,0.02); padding: 2rem; border-radius: var(--radius); border: 1px dashed rgba(255,255,255,0.1); margin-bottom: 2rem;">
                        <label style="display: flex; align-items: flex-start; gap: 1rem; cursor: pointer;">
                            <input type="checkbox" required style="margin-top: 0.25rem;">
                            <span style="font-size: 0.9rem; color: var(--gray-light); line-height: 1.5;">
                                I hereby certify that the information provided is accurate. I understand that my enrollment
                                is subject to office approval and verification of details.
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary submit-btn">Submit Enrollment Application</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function updateCourseDetails(select) {
            const option = select.options[select.selectedIndex];
            const price = option.getAttribute('data-price');
            document.getElementById('course_fee').value = price || '';

            // Set default deposit to 50% if empty
            if (price && !document.getElementById('deposit_amount').value) {
                document.getElementById('deposit_amount').value = price / 2;
            }
        }

        // Run on load if redirected back with old input
        window.onload = function() {
            const select = document.getElementById('course_id');
            if (select.value) updateCourseDetails(select);
        };
    </script>
@endsection
