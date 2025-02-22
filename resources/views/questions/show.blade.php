@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back, Edit, and Delete Buttons -->
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('questions.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white bg-opacity-70 backdrop-blur-md 
                    rounded-full text-indigo-600 hover:bg-opacity-80 transition-all duration-300 shadow-lg 
                    hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Questions
                </a>

                @if (auth()->id() === $question->user_id)
    <div class="flex items-center space-x-3">
        <!-- Edit Button -->
        <a href="{{ route('questions.edit', $question->id) }}"
           class="inline-flex items-center px-3 py-2 
                  bg-indigo-50 text-indigo-600 
                  hover:bg-indigo-100 
                  rounded-lg 
                  transition-colors 
                  duration-300 
                  text-sm 
                  font-medium 
                  border border-indigo-100 
                  hover:border-indigo-200">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-4 w-4 mr-2" 
                 viewBox="0 0 20 20" 
                 fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" clip-rule="evenodd" />
            </svg>
            Edit
        </a>

        <!-- Delete Button -->
        <form action="{{ route('questions.destroy', $question->id) }}" 
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this question?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center px-3 py-2 
                           bg-red-50 text-red-600 
                           hover:bg-red-100 
                           rounded-lg 
                           transition-colors 
                           duration-300 
                           text-sm 
                           font-medium 
                           border border-red-100 
                           hover:border-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-4 w-4 mr-2" 
                     viewBox="0 0 20 20" 
                     fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Delete
            </button>
        </form>
    </div>
@endif


            </div>

            <!-- Question Details -->
            <div
                class="bg-white rounded-xl shadow-2xl overflow-hidden mb-8 border-t-4 border-indigo-500 transition-all 
                duration-300 hover:shadow-3xl hover:-translate-y-1">
                <div class="p-8">
                    <h1
                        class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 
                        to-purple-600 mb-6">
                        {{ $question->title }}
                    </h1>

                    <div
                        class="prose max-w-none text-gray-700 mb-6 leading-relaxed border-l-4 border-indigo-200 
                        pl-4 text-lg">
                        {{ $question->body }}
                    </div>

                    <!-- Metadata -->
                    <div class="flex flex-wrap items-center justify-between text-sm text-gray-500 border-t pt-6 mt-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-indigo-500 mr-2"></i>
                                <span class="font-medium">{{ $question->user->name }}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if ($question->tag)
                                <span
                                    class="px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 
                                    text-indigo-700 rounded-full text-xs font-semibold">
                                    {{ $question->tag->name }}
                                </span>
                            @endif
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-400 mr-2"></i>
                                <span>{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answers Section -->
            <div class="mb-8">
                <h2
                    class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 
                    to-purple-600 mb-8">
                    {{ $answers->count() }} {{ Str::plural('Answer', $answers->count()) }}
                </h2>

                @foreach ($answers as $answer)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 hover:shadow-xl transition-all 
                        duration-300 hover:-translate-y-1">
                        <div class="p-6">
                            <div class="prose max-w-none text-gray-700 mb-4 border-l-4 border-purple-200 pl-4 text-lg">
                                {{ $answer->body }}
                            </div>

                            <!-- Answer Metadata -->
                            <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-circle text-purple-500 mr-2"></i>
                                        <span class="font-medium">{{ $answer->user->name }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-gray-400 mr-2"></i>
                                    <span>{{ $answer->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Answer Form -->
            @auth
                <div
                    class="bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-purple-500 transition-all 
                    duration-300 hover:-translate-y-1 hover:shadow-3xl">
                    <div class="p-8">
                        <h3
                            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 
                            to-indigo-600 mb-8">
                            Your Answer
                        </h3>

                        <form action="{{ route('answers.store', ['question' => $question->id]) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <textarea name="body" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 
                                    focus:ring-purple-500 focus:border-transparent @error('body') border-red-500 @enderror"
                                    placeholder="Write your answer here..." required>{{ old('body') }}</textarea>

                                @error('body')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 
                                hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition 
                                duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                                Post Your Answer
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden text-center p-8 transition-all 
                    duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <p class="text-gray-600 text-lg">
                        Please <a href="{{ route('login') }}"
                            class="text-purple-600 hover:text-purple-800 font-semibold transition-all duration-300">
                            login
                        </a> to post an answer.
                    </p>
                </div>
            @endauth
        </div>
    </div>
@endsection
