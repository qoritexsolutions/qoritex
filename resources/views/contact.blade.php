@extends('layouts.app')

@section('title', 'Contact Us')

@section('styles')
    <style>
        .page-header {
            padding: 10rem 0 5rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(14, 165, 233, 0.08) 100%);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            border-radius: 50%;
        }

        .page-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .page-header p {
            color: var(--gray-light);
            font-size: 1.25rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
            position: relative;
            z-index: 1;
        }

        /* Contact Info Cards */
        .contact-info-section {
            padding: 5rem 0;
            background: var(--dark-light);
            margin-top: -3rem;
            position: relative;
            z-index: 10;
        }

        .contact-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .contact-info-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .contact-info-card:hover {
            transform: translateY(-10px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .contact-info-card:hover::before {
            transform: scaleX(1);
        }

        .contact-info-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
            margin: 0 auto 1.5rem;
            transition: transform 0.4s ease;
        }

        .contact-info-card:hover .contact-info-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .contact-info-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .contact-info-card p {
            color: var(--gray-light);
            margin-bottom: 0.25rem;
        }

        .contact-info-card a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .contact-info-card a:hover {
            color: var(--white);
        }

        /* Main Contact Section */
        .contact-section {
            padding: 6rem 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 4rem;
            align-items: start;
        }

        /* Contact Form */
        .contact-form-wrapper {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 3rem;
        }

        .contact-form-wrapper h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .contact-form-wrapper>p {
            color: var(--gray-light);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-light);
        }

        .form-group label span {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            color: var(--white);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-control::placeholder {
            color: var(--gray);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 1.25rem 2rem;
            background: var(--gradient-primary);
            border: none;
            border-radius: var(--radius);
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }

        /* Success Message */
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        /* Contact Info Sidebar */
        .contact-sidebar h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .contact-sidebar>p {
            color: var(--gray-light);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .sidebar-info-list {
            margin-bottom: 2.5rem;
        }

        .sidebar-info-item {
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            padding: 1.25rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-info-item:last-child {
            border-bottom: none;
        }

        .sidebar-info-icon {
            width: 50px;
            height: 50px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .sidebar-info-content h4 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .sidebar-info-content p,
        .sidebar-info-content a {
            color: var(--gray-light);
            text-decoration: none;
        }

        .sidebar-info-content a:hover {
            color: var(--primary-light);
        }

        /* Social Links */
        .social-links-section h4 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
        }

        .social-link {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-light);
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Map Section */
        .map-section {
            padding: 0 0 6rem;
        }

        .map-wrapper {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            overflow: hidden;
            height: 400px;
            position: relative;
        }

        .map-placeholder {
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
        }

        .map-placeholder i {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .map-placeholder p {
            font-size: 1.25rem;
        }

        /* FAQ Section */
        .faq-section {
            padding: 6rem 0;
            background: var(--dark-light);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .faq-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: rgba(99, 102, 241, 0.3);
        }

        .faq-item h4 {
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .faq-item h4 i {
            color: var(--primary);
            margin-top: 0.25rem;
        }

        .faq-item p {
            color: var(--gray-light);
            line-height: 1.7;
            padding-left: 1.75rem;
        }

        @media (max-width: 1024px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .contact-sidebar {
                order: -1;
            }

            .contact-info-grid {
                grid-template-columns: 1fr;
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .contact-form-wrapper {
                padding: 2rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container">
            <h1>Get In Touch</h1>
            <p>Have a question or want to discuss a project? We'd love to hear from you. Get in touch and let's start a
                conversation.</p>
        </div>
    </section>

    <section class="contact-info-section">
        <div class="container">
            <div class="contact-info-grid">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p>Our team will respond within 24 hours</p>
                    <a href="mailto:hello@techcompany.com">hello@techcompany.com</a>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p>Mon-Fri from 9am to 6pm EST</p>
                    <a href="tel:+12345678900">+1 (234) 567-8900</a>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Visit Us</h3>
                    <p>123 Tech Street</p>
                    <p>Silicon Valley, CA 94000</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-sidebar">
                    <h2>Let's Start a Conversation</h2>
                    <p>Whether you're looking to build a new application, improve your existing systems, or need expert
                        advice on technology solutions, we're here to help. Our team of experts is ready to turn your vision
                        into reality.</p>

                    <div class="sidebar-info-list">
                        <div class="sidebar-info-item">
                            <div class="sidebar-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="sidebar-info-content">
                                <h4>Business Hours</h4>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p>Saturday: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                        <div class="sidebar-info-item">
                            <div class="sidebar-info-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="sidebar-info-content">
                                <h4>Support</h4>
                                <p>24/7 emergency support available</p>
                                <a href="mailto:support@techcompany.com">support@techcompany.com</a>
                            </div>
                        </div>
                        <div class="sidebar-info-item">
                            <div class="sidebar-info-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="sidebar-info-content">
                                <h4>Careers</h4>
                                <p>Join our growing team</p>
                                <a href="mailto:careers@techcompany.com">careers@techcompany.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="social-links-section">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="contact-form-wrapper">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible.</p>

                    @if (session('success'))
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name <span>*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="john@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="+1 (234) 567-8900" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject <span>*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control"
                                    placeholder="Project Inquiry" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message <span>*</span></label>
                            <textarea id="message" name="message" class="form-control" placeholder="Tell us about your project or inquiry..."
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="submit-btn">
                            Send Message <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <div class="map-wrapper">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Interactive Map Coming Soon</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <div class="section-title">
                <span>FAQ</span>
                <h2>Frequently Asked Questions</h2>
                <p>Quick answers to questions you might have</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item">
                    <h4><i class="fas fa-question-circle"></i> How long does a typical project take?</h4>
                    <p>Project timelines vary based on complexity. A simple website might take 4-6 weeks, while complex
                        applications can take 3-6 months. We'll provide a detailed timeline during our initial consultation.
                    </p>
                </div>
                <div class="faq-item">
                    <h4><i class="fas fa-question-circle"></i> What is your pricing model?</h4>
                    <p>We offer both fixed-price and time & materials pricing depending on project requirements. We provide
                        detailed estimates upfront with no hidden costs.</p>
                </div>
                <div class="faq-item">
                    <h4><i class="fas fa-question-circle"></i> Do you provide ongoing support?</h4>
                    <p>Yes! We offer comprehensive maintenance and support packages to ensure your applications run smoothly
                        after launch. 24/7 emergency support is also available.</p>
                </div>
                <div class="faq-item">
                    <h4><i class="fas fa-question-circle"></i> What technologies do you specialize in?</h4>
                    <p>We specialize in Laravel, React, Vue.js, Node.js, Python, AWS, and mobile development with React
                        Native and Flutter. We choose the best tech stack for each project.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
