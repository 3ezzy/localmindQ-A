@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('questions.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Questions
            </a>
        </div>

        <!-- Question Details -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $question->title }}</h1>
                
                <div class="prose max-w-none text-gray-700 mb-6">
                    {{ $question->body }}
                </div>

                <!-- Question Metadata -->
                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                    <div class="flex items-center space-x-2">
                        <span>Asked by: {{ $question->user->name }}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if($question->tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full">
                                {{ $question->tag->name }}
                            </span>
                        @endif
                        <span>{{ $question->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Answers Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ $answers->count() }} {{ Str::plural('Answer', $answers->count()) }}
            </h2>

            <!-- Answers List -->
            @foreach($answers as $answer)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                    <div class="p-6">
                        <div class="prose max-w-none text-gray-700 mb-4">
                            {{ $answer->body }}
                        </div>

                        <!-- Answer Metadata -->
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                            <div class="flex items-center space-x-2">
                                <span>Answered by: {{ $answer->user->name }}</span>
                            </div>
                            <span>{{ $answer->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Answer Form -->
        @auth
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Your Answer</h3>
                    
                    <form action="{{ route('answers.store', ['question' => $question->id]) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <textarea 
                                name="body" 
                                rows="4" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('body') border-red-500 @enderror"
                                placeholder="Write your answer here..."
                                required
                            >{{ old('body') }}</textarea>
                            
                            @error('body')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <!-- Add a hidden input for question_id -->
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        
                        <button type="submit" 
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg">
                            Post Your Answer
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <p class="text-gray-600">
                        Please <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">login</a> 
                        to post an answer.
                    </p>
                </div>
            </div>
        @endauth
    </div>
</div>
@endsection