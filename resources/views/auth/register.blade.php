<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join LocalMind Q&A</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .input-focused {
            transition: all 0.3s ease;
        }
        .input-focused:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full animate-fade-in">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Join LocalMind</h1>
            <p class="text-gray-200">Create an account and start sharing knowledge</p>
        </div>

        <!-- Registration Form -->
        <div class="glass-effect rounded-xl shadow-xl overflow-hidden">
            <div class="px-8 py-10">
                <form class="space-y-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" required 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 input-focused"
                                    placeholder="Enter your full name">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" required 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 input-focused"
                                    placeholder="Enter your email">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" required 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 input-focused"
                                    placeholder="Create a password">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" required 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 input-focused"
                                    placeholder="Confirm your password">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" required class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-700">
                            I agree to the <a href="#" class="text-purple-600 hover:text-purple-500">Terms of Service</a> and <a href="#" class="text-purple-600 hover:text-purple-500">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" 
                        class="w-full py-3 px-4 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                        Create Account
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="/login" class="font-medium text-purple-600 hover:text-purple-500">
                            Sign in instead
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>