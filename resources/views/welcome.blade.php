<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalMind Q&A - Share Knowledge, Get Answers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(120deg, #4F46E5, #7C3AED);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        /* Hide the mobile menu by default */
        #mobile-menu {
            display: none;
        }
        /* Show the mobile menu when the burger button is clicked */
        #mobile-menu.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navigation -->
    <nav class="glass-effect fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <span class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-500 text-transparent bg-clip-text">
                        LocalMind
                    </span>
                </div>
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors">Dashboard</a>
                        
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transition-all transform hover:scale-105">
                            Join Now
                        </a>
                    @endauth
                </div>
                <!-- Burger Button for Mobile -->
                <div class="md:hidden flex items-center">
                    <button id="burger-button" class="text-gray-300 hover:text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden bg-gray-800">
            <div class="px-4 py-2 space-y-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-gray-300 hover:text-white transition-colors">Dashboard</a>
                   
                @else
                    <a href="{{ route('login') }}" class="block text-gray-300 hover:text-white transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transition-all transform hover:scale-105 text-center">
                        Join Now
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    

    <!-- Hero Section -->
    <div class="gradient-bg min-h-screen pt-20 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute transform rotate-45 -right-1/4 -top-1/4 w-1/2 h-1/2 bg-purple-500 opacity-10 rounded-full"></div>
            <div class="absolute transform -rotate-45 -left-1/4 -bottom-1/4 w-1/2 h-1/2 bg-pink-500 opacity-10 rounded-full"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-32 relative">
            <div class="text-center space-y-6 md:space-y-8">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                    Get Expert Answers to Your
                    <span class="bg-gradient-to-r from-purple-400 to-pink-500 text-transparent bg-clip-text">
                        Questions
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                    Join our vibrant community of experts and enthusiasts. Share knowledge, learn, and grow together.
                </p>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                    <a href="/register" class="px-6 py-3 md:px-8 md:py-4 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-lg font-medium hover:from-purple-600 hover:to-pink-600 transition-all transform hover:scale-105 shadow-lg">
                        Get Started
                    </a>
                    <a href="#explore" class="px-6 py-3 md:px-8 md:py-4 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 text-lg font-medium transition-all">
                        Explore Questions
                    </a>
                </div>
                
                <div class="mt-12 md:mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 text-center">
                    <div class="p-6 glass-effect rounded-2xl card-hover">
                        <div class="text-4xl mb-4 text-purple-400">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Active Community</h3>
                        <p class="text-gray-400 mt-2">Join thousands of passionate developers</p>
                    </div>
                    <div class="p-6 glass-effect rounded-2xl card-hover">
                        <div class="text-4xl mb-4 text-pink-400">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Quick Answers</h3>
                        <p class="text-gray-400 mt-2">Get solutions in minutes, not hours</p>
                    </div>
                    <div class="p-6 glass-effect rounded-2xl card-hover">
                        <div class="text-4xl mb-4 text-purple-400">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Expert Knowledge</h3>
                        <p class="text-gray-400 mt-2">Learn from top contributors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Section -->
    <div id="explore" class="py-12 md:py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-500 text-transparent bg-clip-text">
                    Popular Questions
                </h2>
            </div>
            
            <div class="grid gap-6 md:gap-8">
                <!-- Question Card -->
                <div class="glass-effect p-6 rounded-2xl card-hover">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="flex items-center space-x-4 mb-4 md:mb-0">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                                <i class="fas fa-question text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold hover:text-purple-400 transition-colors">
                                    How to implement real-time features in Laravel?
                                </h3>
                                <div class="flex items-center mt-2 space-x-4 text-sm text-gray-400">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-2"></i>
                                        John Doe
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        2 hours ago
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-purple-400">42</span>
                                <span class="text-sm text-gray-400">answers</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-pink-400">1.2k</span>
                                <span class="text-sm text-gray-400">views</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full text-sm bg-purple-500 bg-opacity-20 text-purple-300">
                            Laravel
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm bg-pink-500 bg-opacity-20 text-pink-300">
                            Real-time
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm bg-purple-500 bg-opacity-20 text-purple-300">
                            WebSockets
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Toggle Mobile Menu -->
    <script>
        const burgerButton = document.getElementById('burger-button');
        const mobileMenu = document.getElementById('mobile-menu');

        burgerButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });
    </script>
</body>
</html>