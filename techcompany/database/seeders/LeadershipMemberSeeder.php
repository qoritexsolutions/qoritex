<?php

namespace Database\Seeders;

use App\Models\LeadershipMember;
use Illuminate\Database\Seeder;

class LeadershipMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaders = [
            [
                'name' => 'Robert Anderson',
                'position' => 'Chief Executive Officer (CEO)',
                'bio' => 'With over 20 years of experience in technology and business leadership, Robert founded TechCompany with a vision to democratize access to cutting-edge technology solutions. His strategic thinking and passion for innovation have been instrumental in growing the company from a small startup to a global technology partner.',
                'quote' => 'Our mission is simple: empower businesses with technology that truly transforms how they operate and compete in the digital age.',
                'icon' => 'fas fa-user-tie',
                'linkedin' => 'https://linkedin.com/in/robertanderson',
                'twitter' => 'https://twitter.com/robertanderson',
                'email' => 'robert@techcompany.com',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Sarah Mitchell',
                'position' => 'Chief Technology Officer (CTO)',
                'bio' => 'A PhD in Computer Science from MIT, Sarah leads our technical vision and innovation strategy. She brings 15+ years of experience in AI, cloud architecture, and software development to drive our technology roadmap.',
                'quote' => null,
                'icon' => 'fas fa-laptop-code',
                'linkedin' => 'https://linkedin.com/in/sarahmitchell',
                'twitter' => 'https://twitter.com/sarahmitchell',
                'github' => 'https://github.com/sarahmitchell',
                'order' => 2,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Michael Thompson',
                'position' => 'Chief Financial Officer (CFO)',
                'bio' => 'Michael brings 18 years of financial expertise from Fortune 500 companies. He oversees our financial strategy, ensuring sustainable growth while maximizing value for our clients and stakeholders.',
                'quote' => null,
                'icon' => 'fas fa-chart-line',
                'linkedin' => 'https://linkedin.com/in/michaelthompson',
                'email' => 'michael@techcompany.com',
                'order' => 3,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Jennifer Williams',
                'position' => 'Chief Operating Officer (COO)',
                'bio' => 'Jennifer ensures operational excellence across all departments. With her background in project management and business operations, she has streamlined our processes to deliver exceptional results.',
                'quote' => null,
                'icon' => 'fas fa-cogs',
                'linkedin' => 'https://linkedin.com/in/jenniferwilliams',
                'twitter' => 'https://twitter.com/jennwilliams',
                'order' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'David Park',
                'position' => 'VP of Engineering',
                'bio' => 'David leads our engineering teams with a focus on code quality, scalability, and innovation. Former Google engineer with expertise in building high-performance distributed systems.',
                'quote' => null,
                'icon' => 'fas fa-code',
                'linkedin' => 'https://linkedin.com/in/davidpark',
                'github' => 'https://github.com/davidpark',
                'order' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Amanda Roberts',
                'position' => 'VP of Sales & Partnerships',
                'bio' => 'Amanda drives our business development initiatives and builds strategic partnerships. Her client-first approach has helped us expand into 15+ countries worldwide.',
                'quote' => null,
                'icon' => 'fas fa-handshake',
                'linkedin' => 'https://linkedin.com/in/amandaroberts',
                'twitter' => 'https://twitter.com/amandaroberts',
                'order' => 6,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($leaders as $leader) {
            LeadershipMember::create($leader);
        }
    }
}
