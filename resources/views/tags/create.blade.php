@extends('layouts.app')

@section('title', 'Create New Tag')

@section('content')
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Create New Tag</h1>

        <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                              @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('tags.index') }}" class="bg-gray-200 py-2 px-4 rounded-md text-gray-700 hover:bg-gray-300 mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 py-2 px-4 rounded-md text-white hover:bg-indigo-700">
                    Create Tag
                </button>
            </div>
        </form>
    </div>
@endsection