<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalMind Q&A - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/" class="flex items-center py-4">
                            <span class="font-semibold text-gray-800 text-lg">LocalMind Q&A</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 px-4 text-gray-500 hover:text-gray-700">Login</a>
                        <a href="{{ route('register') }}" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Register</a>
                    @else
                        <a href="{{ route('questions.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Ask Question</a>
                        <div class="relative">
                            <button class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
                                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                            </button>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto py-6 px-4">
        @yield('content')
    </main>

    <footer class="bg-white mt-8 py-4">
        <div class="max-w-6xl mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} LocalMind Q&A. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 