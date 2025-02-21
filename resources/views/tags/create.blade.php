@extends('layouts.app')

@section('title', 'Create New Tag')

@section('content')
<div class="min-h-screen py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Main Container -->
        <div class="glass-effect rounded-xl shadow-xl overflow-hidden animate-fade-in">
            <!-- Header Section -->
            <div class="p-6 border-b border-gray-200/30 bg-white/40">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Create New Tag</h1>
                    <a href="{{ route('tags.index') }}" 
                       class="text-sm text-gray-600 hover:text-gray-900 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Tags
                    </a>
                </div>
            </div>

            <!-- Form Section -->
            <div class="p-6 bg-white/80">
                <form action="{{ route('tags.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Tag Name
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 
                                      focus:ring-purple-500 focus:border-purple-500 transition
                                      @error('name') border-red-500 @enderror"
                               placeholder="Enter tag name"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                        <a href="{{ route('tags.index') }}" 
                           class="px-4 py-2 rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 
                                  transition transform hover:scale-105 text-center">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 
                                       hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 
                                       focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>
                            Create Tag
                        </button>
                    </div>
                </form>
            </div>
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
@endsection