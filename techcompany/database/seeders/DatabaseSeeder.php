<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@techcompany.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create services
        $this->call(ServiceSeeder::class);

        // Create team members
        $team = [
            [
                'name' => 'John Smith',
                'position' => 'CEO & Founder',
                'bio' => 'Visionary leader with 15+ years of experience in technology and business development.',
                'linkedin' => 'https://linkedin.com',
                'twitter' => 'https://twitter.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'position' => 'Lead Developer',
                'bio' => 'Full-stack developer passionate about clean code and best practices.',
                'linkedin' => 'https://linkedin.com',
                'github' => 'https://github.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Mike Chen',
                'position' => 'UX Designer',
                'bio' => 'Creating beautiful and intuitive user experiences for over 8 years.',
                'linkedin' => 'https://linkedin.com',
                'twitter' => 'https://twitter.com',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Emily Davis',
                'position' => 'Project Manager',
                'bio' => 'Expert in agile methodologies, ensuring projects are delivered on time and within budget.',
                'linkedin' => 'https://linkedin.com',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::create($member);
        }

        // Create projects
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'description' => 'A fully-featured e-commerce platform with inventory management, payment processing, and analytics dashboard. Built with Laravel and Vue.js.',
                'category' => 'Web Development',
                'client' => 'RetailMax Inc.',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Healthcare Mobile App',
                'description' => 'A mobile application for patients to book appointments, access medical records, and communicate with healthcare providers.',
                'category' => 'Mobile Development',
                'client' => 'MediCare Health',
                'technologies' => ['React Native', 'Node.js', 'MongoDB'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'AI Chatbot Solution',
                'description' => 'An intelligent customer service chatbot that handles inquiries, processes orders, and escalates complex issues to human agents.',
                'category' => 'AI & Machine Learning',
                'client' => 'TechSupport Pro',
                'technologies' => ['Python', 'TensorFlow', 'AWS Lambda'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Cloud Migration Project',
                'description' => 'Complete migration of on-premise infrastructure to AWS, including database migration and application modernization.',
                'category' => 'Cloud Solutions',
                'client' => 'Enterprise Corp',
                'technologies' => ['AWS', 'Docker', 'Kubernetes', 'Terraform'],
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Financial Dashboard',
                'description' => 'A real-time financial analytics dashboard with data visualization, reporting, and predictive analytics features.',
                'category' => 'Web Development',
                'client' => 'FinanceHub',
                'technologies' => ['React', 'D3.js', 'Python', 'PostgreSQL'],
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Brand Identity Redesign',
                'description' => 'Complete brand identity redesign including logo, color palette, typography, and comprehensive style guide.',
                'category' => 'UI/UX Design',
                'client' => 'StartupXYZ',
                'technologies' => ['Figma', 'Adobe Illustrator', 'Adobe XD'],
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Create testimonials
        $testimonials = [
            [
                'client_name' => 'David Wilson',
                'client_position' => 'CEO',
                'client_company' => 'RetailMax Inc.',
                'content' => 'TechCompany delivered an exceptional e-commerce platform that exceeded our expectations. Their team was professional, responsive, and truly understood our business needs.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'client_name' => 'Jennifer Lee',
                'client_position' => 'CTO',
                'client_company' => 'MediCare Health',
                'content' => 'The mobile app they built for us has transformed how we interact with our patients. The user experience is fantastic and our patient satisfaction scores have improved significantly.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'client_name' => 'Robert Martinez',
                'client_position' => 'Director of IT',
                'client_company' => 'Enterprise Corp',
                'content' => 'Their cloud migration expertise saved us time and money. The project was completed on schedule and our infrastructure is now more robust than ever.',
                'rating' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Create settings
        $settings = [
            ['key' => 'site_name', 'value' => 'TechCompany', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Innovating Tomorrow, Today', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Leading technology company providing innovative digital solutions', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'hello@techcompany.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+1 (234) 567-8900', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => '123 Tech Street, Silicon Valley, CA 94000', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_github', 'value' => 'https://github.com', 'type' => 'url', 'group' => 'social'],
            ['key' => 'footer_text', 'value' => '© 2024 TechCompany. All rights reserved.', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
