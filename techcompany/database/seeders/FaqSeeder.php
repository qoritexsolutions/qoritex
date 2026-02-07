<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // General
            [
                'question' => 'How can I start a project with TechCompany?',
                'answer' => 'You can start by filling out our contact form or booking a free consultation through our website. Our team will get back to you within 24 hours to discuss your requirements.',
                'category' => 'General',
                'order' => 1,
            ],
            [
                'question' => 'Where is your office located?',
                'answer' => 'Our main office is located in the downtown technology hub. We also have remote teams working across different time zones to provide 24/7 support.',
                'category' => 'General',
                'order' => 2,
            ],
            // Services
            [
                'question' => 'What technologies do you use for web development?',
                'answer' => 'We specialize in modern stacks including Laravel, React, Vue.js, Node.js, and Python. We choose the best technology based on your project requirements for scalability and performance.',
                'category' => 'Services',
                'order' => 1,
            ],
            [
                'question' => 'Do you provide maintenance and support after project launch?',
                'answer' => 'Yes, we offer various support and maintenance packages to ensure your application remains up-to-date, secure, and performant.',
                'category' => 'Services',
                'order' => 2,
            ],
            // Technical
            [
                'question' => 'What is your software development methodology?',
                'answer' => 'We primarily use Agile and Scrum methodologies. This allows for iterative development, frequent updates, and the flexibility to adapt to changing requirements.',
                'category' => 'Technical',
                'order' => 1,
            ],
            [
                'question' => 'How do you ensure the security of our data?',
                'answer' => 'We follow industry-standard security practices, including data encryption (at rest and in transit), regular security audits, and secure coding standards.',
                'category' => 'Technical',
                'order' => 2,
            ],
            // Products
            [
                'question' => 'Can your products be customized for my specific business needs?',
                'answer' => 'Absolutely! All our software products and platforms are designed to be modular and highly customizable to fit your unique business processes.',
                'category' => 'Products',
                'order' => 1,
            ],
            [
                'question' => 'Are your courses suitable for beginners?',
                'answer' => 'Yes, we offer courses ranging from Beginner to Advanced levels. Our instructors provide hands-on training to help you build a solid foundation from scratch.',
                'category' => 'Products',
                'order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
