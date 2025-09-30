<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Complete Web Development Bootcamp',
                'description' => 'Learn HTML, CSS, JavaScript, React, Node.js, and MongoDB. Build real-world projects and become a full-stack developer.',
                'category' => 'Web Development',
                'price' => 599000,
                'rating' => 4.8,
                'total_reviews' => 1250,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Python for Data Science',
                'description' => 'Master Python programming for data analysis, visualization, and machine learning. Includes NumPy, Pandas, and Matplotlib.',
                'category' => 'Data Science',
                'price' => 499000,
                'rating' => 4.7,
                'total_reviews' => 890,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Masterclass',
                'description' => 'Learn SEO, social media marketing, Google Ads, email marketing, and analytics to grow your business online.',
                'category' => 'Marketing',
                'price' => 399000,
                'rating' => 4.6,
                'total_reviews' => 567,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development with React Native',
                'description' => 'Build cross-platform mobile apps for iOS and Android using React Native. Deploy to app stores.',
                'category' => 'Mobile Development',
                'price' => 699000,
                'rating' => 4.9,
                'total_reviews' => 432,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Design Fundamentals',
                'description' => 'Learn user interface and user experience design principles. Master Figma, Adobe XD, and design thinking.',
                'category' => 'Design',
                'price' => 449000,
                'rating' => 4.5,
                'total_reviews' => 678,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Machine Learning with TensorFlow',
                'description' => 'Deep dive into machine learning and artificial intelligence using TensorFlow and Keras frameworks.',
                'category' => 'Data Science',
                'price' => 799000,
                'rating' => 4.8,
                'total_reviews' => 345,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'AWS Cloud Practitioner',
                'description' => 'Get certified in Amazon Web Services. Learn cloud computing, EC2, S3, RDS, and deployment strategies.',
                'category' => 'Cloud Computing',
                'price' => 549000,
                'rating' => 4.7,
                'total_reviews' => 789,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Cybersecurity Essentials',
                'description' => 'Learn network security, ethical hacking, penetration testing, and how to protect systems from cyber threats.',
                'category' => 'Cybersecurity',
                'price' => 649000,
                'rating' => 4.6,
                'total_reviews' => 456,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Blockchain Development',
                'description' => 'Build decentralized applications (DApps) and smart contracts using Ethereum, Solidity, and Web3.js.',
                'category' => 'Blockchain',
                'price' => 899000,
                'rating' => 4.4,
                'total_reviews' => 234,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Photography Masterclass',
                'description' => 'Learn professional photography techniques, composition, lighting, and photo editing with Lightroom and Photoshop.',
                'category' => 'Photography',
                'price' => 349000,
                'rating' => 4.7,
                'total_reviews' => 892,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Laravel PHP Framework',
                'description' => 'Master Laravel framework for building modern web applications. Includes authentication, APIs, and deployment.',
                'category' => 'Web Development',
                'price' => 529000,
                'rating' => 4.8,
                'total_reviews' => 567,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Excel Data Analysis',
                'description' => 'Advanced Excel techniques for data analysis, pivot tables, macros, and business intelligence dashboards.',
                'category' => 'Business',
                'price' => 299000,
                'rating' => 4.5,
                'total_reviews' => 1123,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Game Development with Unity',
                'description' => 'Create 2D and 3D games using Unity engine and C#. Publish games to multiple platforms.',
                'category' => 'Game Development',
                'price' => 749000,
                'rating' => 4.6,
                'total_reviews' => 389,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Content Writing & Copywriting',
                'description' => 'Learn to write compelling content for websites, blogs, social media, and marketing campaigns.',
                'category' => 'Writing',
                'price' => 249000,
                'rating' => 4.4,
                'total_reviews' => 678,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'DevOps with Docker & Kubernetes',
                'description' => 'Master containerization and orchestration. Learn CI/CD pipelines, monitoring, and cloud deployment.',
                'category' => 'DevOps',
                'price' => 699000,
                'rating' => 4.7,
                'total_reviews' => 445,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Financial Planning & Investment',
                'description' => 'Learn personal finance, investment strategies, stock market analysis, and retirement planning.',
                'category' => 'Finance',
                'price' => 399000,
                'rating' => 4.5,
                'total_reviews' => 567,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Graphic Design with Adobe Creative Suite',
                'description' => 'Master Photoshop, Illustrator, and InDesign for professional graphic design and branding projects.',
                'category' => 'Design',
                'price' => 479000,
                'rating' => 4.6,
                'total_reviews' => 723,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Public Speaking & Presentation Skills',
                'description' => 'Overcome fear of public speaking and deliver powerful presentations that engage and persuade audiences.',
                'category' => 'Personal Development',
                'price' => 199000,
                'rating' => 4.7,
                'total_reviews' => 934,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'Video Editing with Premiere Pro',
                'description' => 'Learn professional video editing, color grading, audio mixing, and motion graphics with Adobe Premiere Pro.',
                'category' => 'Video Production',
                'price' => 429000,
                'rating' => 4.8,
                'total_reviews' => 456,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
            [
                'title' => 'E-commerce Business Setup',
                'description' => 'Start and scale your online business. Learn Shopify, product sourcing, marketing, and customer service.',
                'category' => 'Business',
                'price' => 549000,
                'rating' => 4.5,
                'total_reviews' => 612,
                'image' => '/placeholder.svg?height=300&width=400',
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        // Create some inactive courses for testing
        Course::create([
            'title' => 'Inactive Course Example',
            'description' => 'This course is not active and should not appear in listings.',
            'category' => 'Test',
            'price' => 100000,
            'rating' => 3.0,
            'total_reviews' => 10,
            'image' => '/placeholder.svg?height=300&width=400',
            'is_active' => false,
        ]);
    }
}