<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Full Stack Web Development',
                'description' => 'Master both frontend and backend technologies to build modern, scalable web applications.',
                'content' => [
                    'HTML5, CSS3, and Modern JavaScript',
                    'React.js and Frontend Frameworks',
                    'Backend with Node.js and Express',
                    'Database Management (MongoDB & SQL)',
                    'Deployment and DevOps Basics'
                ],
                'duration' => '6 Months',
                'price' => 1200.00,
                'icon' => 'fas fa-code',
                'order' => 1
            ],
            [
                'title' => 'UI/UX Design Masterclass',
                'description' => 'Learn the principles of user-centric design and master industry-standard tools like Figma.',
                'content' => [
                    'Design Thinking Process',
                    'Typography and Color Theory',
                    'Wireframing and Prototyping',
                    'User Research and Testing',
                    'Portfolio Building with Figma'
                ],
                'duration' => '3 Months',
                'price' => 800.00,
                'icon' => 'fas fa-paint-brush',
                'order' => 2
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Build cross-platform mobile applications for iOS and Android using Flutter or React Native.',
                'content' => [
                    'Dart Programming Basics',
                    'Flutter UI Components',
                    'State Management',
                    'API Integration',
                    'App Store & Play Store Publishing'
                ],
                'duration' => '4 Months',
                'price' => 1000.00,
                'icon' => 'fas fa-mobile-alt',
                'order' => 3
            ]
        ];

        foreach ($courses as $course) {
            $course['slug'] = Str::slug($course['title']);
            Course::create($course);
        }
    }
}
