<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Welcome to Courseify') }}
        </h2>
    </x-slot>

    <style>
        .transition-all {
            transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .hover\:text-indigo-600:hover {
            color: #4c51bf;
        }

        .hover\:bg-gray-200:hover {
            background-color: #edf2f7;
        }

        .hidden-card {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .visible-card {
            opacity: 1;
            transform: translateY(0);
        }

        .footer {
            background-color: #1a202c;
            color: #cbd5e0;
            padding: 2rem 0;
        }

        .footer a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            text-decoration: underline;
            color: #4c51bf;
        }

        .footer .footer-logo {
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer .footer-logo:hover {
            color: #4c51bf;
        }

        .footer .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer .footer-socials a {
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }

        .footer .footer-socials a:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible-card');
                        entry.target.classList.remove('hidden-card');
                    }
                });
            });

            document.querySelectorAll('.card').forEach(card => {
                card.classList.add('hidden-card');
                observer.observe(card);
            });
        });
    </script>

    <div class="py-12">
        <div class="mx-auto space-y-12 max-w-7xl sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="relative bg-cover bg-center h-[400px] rounded-lg shadow-lg" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="px-4 space-y-4 text-center text-white sm:px-6 lg:px-8">
                        <h1 class="text-4xl font-bold">Learn at Your Own Pace with <span class="text-indigo-600">Courseify</span></h1>
                        <p class="text-lg">The ultimate platform for mastering new skills through expertly designed tracks and flexible online learning.</p>
                        <br>
                        <a href="#features" class="px-6 py-3 text-lg font-semibold transition bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Discover Features
                        </a>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="flex flex-col items-center px-4 space-y-6 md:flex-row md:space-y-0 md:space-x-6 sm:px-6 lg:px-8">
                <img src="{{ asset('logo.png') }}" alt="About Courseify" class="w-full rounded-lg shadow-md md:w-1/3">
                <div class="space-y-4 text-gray-800 dark:text-gray-200">
                    <h2 class="text-2xl font-bold">Who We Are</h2>
                    <p>
                        Courseify is a modern e-learning platform dedicated to helping individuals achieve their personal and professional goals. With a user-friendly interface, personalized learning tracks, and a community of experts, we make learning accessible to everyone.
                    </p>
                    <p>
                        Whether you're looking to gain new skills, enhance your career, or explore your passions, Courseify is here to guide you every step of the way.
                    </p>
                </div>
            </div>

            <!-- Features Section -->
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Our Features</h2>
            <div id="features" class="grid grid-cols-1 gap-6 px-4 md:grid-cols-2 lg:grid-cols-3 sm:px-6 lg:px-8">
                <!-- Feature 1 -->
                <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <img src="{{ asset('logo.png') }}" alt="Flexible Learning" class="mx-auto mb-4 w-1/1 h-1/2">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Flexible Learning</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Access your courses anytime, anywhere, and learn at your own pace with complete flexibility.
                        </p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <img src="{{ asset('logo.png') }}" alt="Expert Guidance" class="mx-auto mb-4 w-1/1 h-1/2">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Expert Guidance</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Learn from industry experts and certified professionals to achieve your career goals.
                        </p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <img src="{{ asset('Gptimage.png') }}" alt="Community Support" class="mx-auto mb-4 w-1/1 h-1/2">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Community Support</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Connect with like-minded learners and share your progress through our active community.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Popular Courses Section -->
<div class="px-4 space-y-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Popular Courses</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        
        <!-- Course 1: Web Development -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/web-development.jpg') }}" alt="Web Development" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Web Development Bootcamp</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Learn HTML, CSS, JavaScript, and modern frameworks like React to build professional web applications.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

        <!-- Course 2: Data Science -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/data-science.jpg') }}" alt="Data Science" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Data Science with Python</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Master data analysis, machine learning, and AI using Python, Pandas, and TensorFlow.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

        <!-- Course 3: Digital Marketing -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/digital-marketing.jpg') }}" alt="Digital Marketing" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Digital Marketing Mastery</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Learn SEO, social media marketing, Google Ads, and content strategy to grow any business online.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

        <!-- Course 4: UI/UX Design -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/ui-ux-design.jpg') }}" alt="UI/UX Design" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">UI/UX Design Fundamentals</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Master Figma, wireframing, prototyping, and user research to design intuitive user experiences.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

        <!-- Course 5: Cybersecurity -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/cybersecurity.jpg') }}" alt="Cybersecurity" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Cybersecurity Essentials</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Learn ethical hacking, network security, and threat detection to protect systems from cyber attacks.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

        <!-- Course 6: Business Analytics -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/business-analytics.jpg') }}" alt="Business Analytics" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Business Analytics with Excel</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Gain expertise in data visualization, forecasting, and Excel analytics for better business decision-making.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Enroll Now</a>
        </div>

    </div>
</div>


            <!-- Instructors Section -->
<div class="px-4 space-y-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Meet Our Instructors</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        <!-- Instructor 1 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/instructor-john.jpg') }}" alt="John Doe" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">John Doe</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                A senior web developer with 10+ years of experience in full-stack development, specializing in JavaScript and Laravel.
            </p>
        </div>

        <!-- Instructor 2 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/instructor-sarah.jpg') }}" alt="Sarah Smith" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Sarah Smith</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                A UI/UX designer and front-end expert with a passion for creating intuitive user experiences using Figma and React.
            </p>
        </div>

        <!-- Instructor 3 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/instructor-michael.jpg') }}" alt="Michael Brown" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Michael Brown</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                A cybersecurity expert with 8+ years in ethical hacking, helping students secure web applications and networks.
            </p>
        </div>

    </div>
</div>


            <!-- Blog/News Section -->
<div class="px-4 space-y-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Latest News & Articles</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        <!-- News 1: New Courses Added -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/news1.jpg') }}" alt="New Courses Added" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">New Courses Added to Coursify!</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                We have added 10+ new courses in Web Development, Data Science, and Cybersecurity. Enroll now to boost your skills!
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Read More</a>
        </div>

        <!-- News 2: Partnership Announcement -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/news2.jpg') }}" alt="New Partnership" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Coursify Partners with Top Universities</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                We are excited to announce our partnership with leading universities to bring certified online courses to learners worldwide.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Read More</a>
        </div>

        <!-- News 3: Mobile App Launch -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/news3.jpg') }}" alt="Mobile App Launch" class="object-cover w-full h-48 mb-4 rounded-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Coursify Mobile App is Now Available!</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Learning on the go is now easier! Download our new mobile app on iOS and Android to access courses anytime, anywhere.
            </p>
            <a href="#" class="inline-block px-4 py-2 mt-4 text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">Read More</a>
        </div>

    </div>
</div>


            <!-- Call to Action Section -->
            <div class="px-4 py-12 text-white bg-indigo-600 rounded-lg shadow-lg sm:px-6 lg:px-8">
                <div class="space-y-4 text-center">
                    <h2 class="text-3xl font-bold">Ready to Start Learning?</h2>
                    <p class="text-lg">Join thousands of learners who have already transformed their lives with Courseify.</p>
                    <a href="#" class="inline-block px-6 py-3 font-semibold text-indigo-600 transition bg-white rounded-md hover:bg-gray-100">Sign Up Now</a>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="px-4 space-y-6 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Our Impact</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="p-6 text-center transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                        <h3 class="text-4xl font-bold text-indigo-600">{{ $count_users }}+</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Happy Learners</p>
                    </div>
                    <div class="p-6 text-center transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                        <h3 class="text-4xl font-bold text-indigo-600">{{ $count_course }}+</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Courses Available</p>
                    </div>
                    <div class="p-6 text-center transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                        <h3 class="text-4xl font-bold text-indigo-600">95%</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Satisfaction Rate</p>
                    </div>
                </div>
            </div>

            <!-- FAQs Section -->
<div class="px-4 space-y-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">Frequently Asked Questions</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Question 1 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">What is Coursify?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Coursify is an online platform that allows users to enroll in a variety of courses, track their progress, and learn at their own pace.
            </p>
        </div>

        <!-- Question 2 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">How do I enroll in a course?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                You can enroll in a course by browsing the available courses, selecting the one you’re interested in, and clicking the "Enroll" button. Some courses may require payment.
            </p>
        </div>

        <!-- Question 3 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Is there a certificate upon course completion?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Yes! After successfully completing a course, you will receive a digital certificate that you can download or share on LinkedIn.
            </p>
        </div>

        <!-- Question 4 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Can I access the courses on mobile devices?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Absolutely! Coursify is fully responsive and works on desktops, tablets, and smartphones for a seamless learning experience.
            </p>
        </div>

        <!-- Question 5 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Are the courses free?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Coursify offers both free and paid courses. You can check the course details to see if there is a fee before enrolling.
            </p>
        </div>

        <!-- Question 6 -->
        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">How can I become an instructor on Coursify?</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                If you have expertise in a subject, you can apply to become an instructor by filling out the instructor application form in your dashboard.
            </p>
        </div>
    </div>
</div>



            <!-- Testimonials Section -->
            <div class="px-4 space-y-6 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200">What Our Learners Say</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="p-6 transition-all bg-gray-100 rounded-lg shadow-md card dark:bg-gray-700 hover:scale-105 hover:shadow-lg">
                            <p class="italic text-gray-600 dark:text-gray-400">
                                "Courseify helped me achieve my career goals. The flexible tracks and expert guidance made all the difference!"
                            </p>
                            <div class="mt-4 text-right text-gray-800 dark:text-gray-200">
                                — Learner {{ $i }}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container px-6 mx-auto">
            <div class="flex flex-wrap justify-between">
                <!-- Logo and Description -->
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <div class="text-2xl text-indigo-600 footer-logo">
                        Courseify
                    </div>
                    <p class="mt-4 text-gray-400">
                        Empowering you to master new skills with flexible, expertly designed courses. Learn, grow, and succeed with Courseify.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h4 class="mb-4 text-lg font-semibold text-white">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#" class="transition hover:text-indigo-400">Home</a></li>
                        <li><a href="#" class="transition hover:text-indigo-400">About</a></li>
                        <li><a href="#" class="transition hover:text-indigo-400">Courses</a></li>
                        <li><a href="#" class="transition hover:text-indigo-400">Contact</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="w-full md:w-1/3">
                    <h4 class="mb-4 text-lg font-semibold text-white">Follow Us</h4>
                    <div class="flex space-x-4 footer-socials">
                        <a href="#" class="text-indigo-400 transition hover:text-indigo-600">
                            <i class="text-2xl fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-indigo-400 transition hover:text-indigo-600">
                            <i class="text-2xl fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-indigo-400 transition hover:text-indigo-600">
                            <i class="text-2xl fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-indigo-400 transition hover:text-indigo-600">
                            <i class="text-2xl fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
</x-app-layout>