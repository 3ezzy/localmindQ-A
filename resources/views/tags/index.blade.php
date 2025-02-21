@extends('layouts.app')

@section('title', 'Manage Tags')

@section('content')
<div class="min-h-screen py-6 px-4 sm:px-6 lg:px-8">
    <!-- Main Container -->
    <div class="glass-effect rounded-xl shadow-xl overflow-hidden animate-fade-in">
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-200/30 bg-white/40">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <h1 class="text-2xl font-bold text-gray-800">Tags Management</h1>
                <a href="{{ route('tags.create') }}" 
                   class="inline-flex items-center px-4 py-2 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Create New Tag
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100/90 border-l-4 border-green-500 text-green-700 p-4 m-4 backdrop-blur-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="p-4 bg-white/30 border-b border-gray-200/30">
            <form action="{{ route('tags.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search tags..." 
                           class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition">
                </div>
                <button type="submit" 
                        class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </form>
        </div>

        <!-- Tags Table -->
        <div class="overflow-x-auto bg-white/80">
            <table class="min-w-full divide-y divide-gray-200/50">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/50">
                    @forelse($tags as $tag)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tag->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tag->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $tag->created_at->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $tag->updated_at->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('tags.edit', $tag) }}" 
                                       class="text-purple-600 hover:text-purple-900 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tags.destroy', $tag) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 bg-white/50">
                                No tags found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white/30 px-4 py-3 border-t border-gray-200/30 sm:px-6">
            {{ $tags->links() }}
        </div>
    </div>
</div>

@push('styles')
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
@endpush

@push('scripts')
<script>
    // Fade out flash messages after 3 seconds
    setTimeout(function() {
        const flashMessage = document.querySelector('[role="alert"]');
        if (flashMessage) {
            flashMessage.style.transition = 'opacity 0.5s';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 500);
        }
    }, 3000);
</script>
@endpush
@endsection