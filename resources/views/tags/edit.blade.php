@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="min-h-screen py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Main Container -->
        <div class="glass-effect rounded-xl shadow-xl overflow-hidden animate-fade-in">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200/30 bg-white/40">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit Tag</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Editing tag: <span class="font-medium text-purple-600">{{ $tag->name }}</span>
                        </p>
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ now()->format('Y-m-d H:i:s') }} UTC
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-6 bg-white/80">
                <form action="{{ route('tags.update', $tag) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $tag->name) }}" 
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 
                                      focus:ring-purple-500 focus:border-purple-500 transition
                                      @error('name') border-red-500 @enderror"
                               required
                               autofocus>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Metadata -->
                    <div class="mt-6 bg-gray-50/80 backdrop-blur-sm rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Tag Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="space-y-2">
                                <p>Created by: <span class="font-medium text-gray-900">{{ auth()->user()->name ?? '3ezzy' }}</span></p>
                                <p>Created at: <span class="font-medium text-gray-900">{{ $tag->created_at->format('Y-m-d H:i:s') }}</span></p>
                            </div>
                            <div class="space-y-2">
                                <p>Last updated: <span class="font-medium text-gray-900">{{ $tag->updated_at->format('Y-m-d H:i:s') }}</span></p>
                                <p>ID: <span class="font-medium text-gray-900">{{ $tag->id }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                        <a href="{{ route('tags.index') }}" 
                           class="px-4 py-2 rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 
                                  transition transform hover:scale-105 inline-flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Tags
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 
                                       hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 
                                       focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105
                                       inline-flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Update Tag
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Section -->
            <div class="px-6 py-4 bg-red-50/80 border-t border-gray-200/30">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <h3 class="text-sm font-medium text-red-800">Danger Zone</h3>
                    <form action="{{ route('tags.destroy', $tag) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-red-600 to-red-500 
                                       hover:from-red-700 hover:to-red-600 focus:outline-none focus:ring-2 
                                       focus:ring-offset-2 focus:ring-red-500 transition transform hover:scale-105
                                       inline-flex items-center justify-center"
                                onclick="return confirm('Are you sure you want to delete this tag? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Tag
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 animate-fade-in glass-effect bg-green-500/90 text-white px-6 py-3 rounded-lg shadow-lg" 
         role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
@endif

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