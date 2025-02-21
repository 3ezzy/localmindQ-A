<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side - Brand -->
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-gray-800">LocalMind</a>
            </div>

            <!-- Right side - Dropdown -->
            <div class="flex items-center">
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-md shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>

                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                        <!-- Current UTC Time -->
                        <div class="px-4 py-2 text-xs text-gray-500 border-t">
                            {{ now()->timezone('Africa/Casablanca')->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>