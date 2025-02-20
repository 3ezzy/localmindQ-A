<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LocalMind Q&A</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Login Form -->
    <div class="max-w-md w-full animate-fade-in">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-2">LocalMind</h1>
            <p class="text-base sm:text-lg text-gray-200">Welcome back! Let's get you signed in.</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-xl shadow-xl overflow-hidden w-full">
            <div class="px-4 sm:px-8 py-6 sm:py-10">
                <form class="space-y-4 sm:space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email address
                        </label>
                        <input type="email" required 
                            class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition"
                            placeholder="Enter your email">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input type="password" required 
                            class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition"
                            placeholder="Enter your password">
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-2 sm:space-y-0">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" 
                        class="w-full py-2 sm:py-3 px-4 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                        Sign in
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="/register" class="font-medium text-purple-600 hover:text-purple-500">
                            Create one now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>