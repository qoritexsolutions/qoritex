<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Course Presentation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #0ea5e9;
            --dark: #0f172a;
            --white: #ffffff;
            --gray: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--dark);
        }

        .presentation-container {
            max-width: 1000px;
            margin: 4rem auto;
            background: white;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .slide {
            min-height: 700px;
            padding: 5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-bottom: 2px solid #f1f5f9;
            page-break-after: always;
        }

        .slide-header {
            margin-bottom: 3rem;
        }

        .slide-header .brand {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            display: block;
        }

        .slide-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--dark);
        }

        .intro-slide {
            background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
            color: white;
            text-align: center;
        }

        .intro-slide .brand {
            color: var(--secondary);
        }

        .intro-slide h1 {
            color: white;
            font-size: 4.5rem;
        }

        .slide h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary);
        }

        .curriculum-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .curriculum-item {
            display: flex;
            gap: 1.5rem;
        }

        .curriculum-item i {
            color: var(--secondary);
            font-size: 1.5rem;
            margin-top: 0.25rem;
        }

        .curriculum-item h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .curriculum-item p {
            color: var(--gray);
            line-height: 1.6;
        }

        .meta-slide {
            text-align: center;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
            margin-top: 4rem;
        }

        .meta-box {
            padding: 3rem;
            background: #f8fafc;
            border-radius: 20px;
        }

        .meta-box i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .meta-box h3 {
            margin-bottom: 1rem;
        }

        .price-tag {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
        }

        .controls {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
            z-index: 100;
        }

        .print-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @media print {
            .presentation-container {
                margin: 0;
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }

            .controls {
                display: none;
            }

            body {
                background: white;
            }
        }
    </style>
</head>

<body>

    <div class="presentation-container">
        <!-- Slide 1: Welcome -->
        <div class="slide intro-slide">
            <span class="brand">Advanced Training Program</span>
            <h1>{{ $course->title }}</h1>
            <p style="font-size: 1.5rem; margin-top: 2rem; opacity: 0.8;">Professional Development & Certification</p>
            <div style="margin-top: 4rem;">
                <i class="fas fa-chevron-down" style="font-size: 2rem; animation: bounce 2s infinite;"></i>
            </div>
        </div>

        <!-- Slide 2: Overview -->
        <div class="slide">
            <div class="slide-header">
                <span class="brand">The Future of Tech</span>
                <h2>Course Overview</h2>
            </div>
            <p style="font-size: 1.5rem; line-height: 1.8; color: var(--gray);">
                {{ $course->description }}
            </p>
        </div>

        <!-- Slide 3: Curriculum -->
        <div class="slide">
            <div class="slide-header">
                <span class="brand">What You'll Learn</span>
                <h2>Curriculum Roadmap</h2>
            </div>
            <div class="curriculum-grid">
                @foreach ($course->content as $index => $topic)
                    <div class="curriculum-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Module 0{{ $index + 1 }}</h4>
                            <p>{{ $topic }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Slide 4: Benefits -->
        <div class="slide">
            <div class="slide-header">
                <span class="brand">Why Choose Us</span>
                <h2>Key Benefits</h2>
            </div>
            <div class="curriculum-grid">
                <div class="curriculum-item">
                    <i class="fas fa-users-cog"></i>
                    <div>
                        <h4>Mentorship</h4>
                        <p>One-on-one sessions with industry professionals who are currently working in top tech
                            companies.</p>
                    </div>
                </div>
                <div class="curriculum-item">
                    <i class="fas fa-laptop-code"></i>
                    <div>
                        <h4>Live Projects</h4>
                        <p>Work on actual client projects to gain real experience and build a portfolio that stands out.
                        </p>
                    </div>
                </div>
                <div class="curriculum-item">
                    <i class="fas fa-certificate"></i>
                    <div>
                        <h4>Certification</h4>
                        <p>Receive a recognized certification upon successful completion of the course and project.</p>
                    </div>
                </div>
                <div class="curriculum-item">
                    <i class="fas fa-briefcase"></i>
                    <div>
                        <h4>Job Assistance</h4>
                        <p>Get exclusive access to our partner network and help with resume building and interviews.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 5: Details & Investment -->
        <div class="slide meta-slide">
            <div class="slide-header">
                <span class="brand">Get Started</span>
                <h2>Course Investment</h2>
            </div>
            <div class="meta-grid">
                <div class="meta-box">
                    <i class="far fa-clock"></i>
                    <h3>Duration</h3>
                    <p style="font-size: 1.25rem; font-weight: 700;">{{ $course->duration }}</p>
                </div>
                <div class="meta-box">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Location</h3>
                    <p style="font-size: 1.25rem; font-weight: 700;">Office Studio</p>
                </div>
                <div class="meta-box">
                    <i class="fas fa-wallet"></i>
                    <h3>Total Fee</h3>
                    <div class="price-tag">${{ number_format($course->price, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Slide 6: Final Call -->
        <div class="slide intro-slide">
            <h1>Ready to Begin?</h1>
            <p style="margin-top: 1.5rem; font-size: 1.25rem;">Scan the QR code or visit our website to secure your
                spot.</p>
            <div style="margin-top: 3rem;">
                <a href="{{ route('courses.register', $course->slug) }}"
                    style="color: white; border: 2px solid var(--secondary); padding: 1rem 3rem; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.25rem;">Regiter
                    Now</a>
            </div>
        </div>
    </div>

    <div class="controls">
        <button onclick="window.print()" class="print-btn">
            <i class="fas fa-download"></i> Download as PDF
        </button>
        <a href="{{ route('courses.show', $course->slug) }}"
            style="text-decoration: none; background: white; color: var(--dark); padding: 1rem 2rem; border-radius: 50px; font-weight: 700; border: 1px solid #e2e8f0;">Back
            to Course</a>
    </div>

</body>

</html>
