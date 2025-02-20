@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Edit Tag</h1>
                <div class="text-sm text-gray-500">
                    {{ now()->format('Y-m-d H:i:s') }} UTC
                </div>
            </div>
            <p class="mt-1 text-sm text-gray-500">
                Editing tag: <span class="font-medium">{{ $tag->name }}</span>
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('tags.update', $tag) }}" method="POST" class="p-6">
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
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 
                              @error('name') border-red-500 @enderror"
                       required
                       autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Metadata -->
            <div class="mt-6 bg-gray-50 rounded-md p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Tag Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm text-gray-500">
                    <div>
                        <p>Created by: <span class="font-medium">{{ auth()->user()->name ?? '3ezzy' }}</span></p>
                        <p>Created at: <span class="font-medium">{{ $tag->created_at->format('Y-m-d H:i:s') }}</span></p>
                    </div>
                    <div>
                        <p>Last updated: <span class="font-medium">{{ $tag->updated_at->format('Y-m-d H:i:s') }}</span></p>
                        <p>ID: <span class="font-medium">{{ $tag->id }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('tags.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Tags
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i>
                    Update Tag
                </button>
            </div>
        </form>

        <!-- Delete Section -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">Danger Zone</h3>
                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            onclick="return confirm('Are you sure you want to delete this tag? This action cannot be undone.')">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Tag
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" role="alert">
        {{ session('success') }}
    </div>
@endif
@endsection

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