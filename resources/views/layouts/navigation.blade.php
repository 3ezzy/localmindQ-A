<nav class="fixed top-0 left-0 right-0 z-50 bg-opacity-70 backdrop-blur-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left side - Brand with Gradient -->
            <div class="flex items-center">
                <a href="/" class="text-2xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">
                    LocalMind
                </a>
            </div>

            <!-- Right side - Modern Dropdown -->
            <div class="flex items-center">
                <div class="relative group">
                    <button class="flex items-center space-x-2 
                        text-gray-700 hover:text-gray-900 
                        bg-white bg-opacity-20 
                        hover:bg-opacity-40 
                        px-4 py-2 
                        rounded-full 
                        transition-all duration-300 
                        shadow-sm hover:shadow-md 
                        border border-gray-100">
                        <i class="fas fa-user mr-2 text-purple-500"></i>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <i class="fas fa-caret-down ml-1 text-gray-500"></i>
                    </button>

                    <!-- Enhanced Dropdown Menu -->
                    <div class="absolute right-0 w-64 mt-3 
                        bg-white bg-opacity-80 
                        rounded-xl 
                        shadow-2xl 
                        border border-gray-100 
                        backdrop-blur-lg 
                        opacity-0 invisible 
                        group-hover:opacity-100 
                        group-hover:visible 
                        transition-all duration-300 
                        transform origin-top-right 
                        scale-95 group-hover:scale-100 
                        overflow-hidden">
                        
                        <!-- Profile Option -->
                        <a href="{{ route('profile.edit') }}" 
                           class="block px-4 py-3 
                           text-gray-800 
                           hover:bg-gradient-to-r 
                           from-purple-50 to-blue-50 
                           hover:text-purple-700 
                           transition duration-200 
                           flex items-center">
                            <i class="fas fa-user-circle mr-3 text-purple-500"></i>
                            Profile
                        </a>

                        <!-- Logout Option -->
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left 
                                    px-4 py-3 
                                    text-gray-800 
                                    hover:bg-gradient-to-r 
                                    from-red-50 to-pink-50 
                                    hover:text-red-700 
                                    transition duration-200 
                                    flex items-center">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i>
                                Log Out
                            </button>
                        </form>

                        <!-- Time Display with Gradient -->
                        <div class="px-4 py-2 
                            text-xs 
                            text-center 
                            bg-gray-100 
                            bg-opacity-50 
                            border-t 
                            text-gray-600 
                            font-mono">
                            {{ now()->timezone('Africa/Casablanca')->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Optional: Add some additional styling -->
<style>
    body {
        padding-top: 4rem; /* Adjust for fixed navbar */
    }
</style>
