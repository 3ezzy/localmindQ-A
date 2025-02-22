@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button with Enhanced Glassmorphic Design -->
            <div class="mb-8">
                <a href="{{ route('questions.index') }}"
                    class="inline-flex items-center 
                      px-4 py-2 
                      bg-white bg-opacity-70 
                      backdrop-blur-md 
                      rounded-full 
                      text-indigo-600 
                      hover:bg-opacity-80 
                      transition-all 
                      duration-300 
                      shadow-lg 
                      hover:shadow-xl 
                      hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Questions
                </a>
            </div>

            <!-- Question Details with Enhanced Card Design -->
            <div
                class="bg-white 
                    rounded-xl 
                    shadow-2xl 
                    overflow-hidden 
                    mb-8 
                    border-t-4 
                    border-indigo-500 
                    transition-all 
                    duration-300 
                    hover:shadow-3xl 
                    hover:-translate-y-1">
                <div class="p-8">
                    <h1
                        class="text-4xl font-extrabold 
                           text-transparent 
                           bg-clip-text 
                           bg-gradient-to-r 
                           from-indigo-600 
                           to-purple-600 
                           mb-6">
                        {{ $question->title }}
                    </h1>

                    <div
                        class="prose max-w-none 
                            text-gray-700 
                            mb-6 
                            leading-relaxed 
                            border-l-4 
                            border-indigo-200 
                            pl-4 
                            text-lg">
                        {{ $question->body }}
                    </div>

                    <!-- Question Metadata with Modern Design -->
                    <div
                        class="flex flex-wrap 
                            items-center 
                            justify-between 
                            text-sm 
                            text-gray-500 
                            border-t 
                            pt-6 
                            mt-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-indigo-500 mr-2"></i>
                                <span class="font-medium">{{ $question->user->name }}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if ($question->tag)
                                <span
                                    class="px-3 py-1 
                                       bg-gradient-to-r 
                                       from-indigo-100 
                                       to-purple-100 
                                       text-indigo-700 
                                       rounded-full 
                                       text-xs 
                                       font-semibold">
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
                    class="text-3xl 
                       font-bold 
                       text-transparent 
                       bg-clip-text 
                       bg-gradient-to-r 
                       from-indigo-600 
                       to-purple-600 
                       mb-8">
                    {{ $answers->count() }} {{ Str::plural('Answer', $answers->count()) }}
                </h2>

                <!-- Answers List -->
                @foreach ($answers as $answer)
                    <div
                        class="bg-white 
                            rounded-xl 
                            shadow-lg 
                            overflow-hidden 
                            mb-6 
                            hover:shadow-xl 
                            transition-all 
                            duration-300 
                            hover:-translate-y-1">
                        <div class="p-6">
                            <div
                                class="prose 
                                    max-w-none 
                                    text-gray-700 
                                    mb-4 
                                    border-l-4 
                                    border-purple-200 
                                    pl-4 
                                    text-lg">
                                {{ $answer->body }}
                            </div>

                            <!-- Answer Metadata -->
                            <div
                                class="flex 
                                    items-center 
                                    justify-between 
                                    text-sm 
                                    text-gray-500 
                                    border-t 
                                    pt-4">
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
                    class="bg-white 
                        rounded-xl 
                        shadow-2xl 
                        overflow-hidden 
                        border-t-4 
                        border-purple-500 
                        transition-all 
                        duration-300 
                        hover:-translate-y-1 
                        hover:shadow-3xl">
                    <div class="p-8">
                        <h3
                            class="text-3xl 
                               font-bold 
                               text-transparent 
                               bg-clip-text 
                               bg-gradient-to-r 
                               from-purple-600 
                               to-indigo-600 
                               mb-8">
                            Your Answer
                        </h3>

                        <form action="{{ route('answers.store', ['question' => $question->id]) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <textarea name="body" rows="5"
                                    class="w-full 
                                       px-4 
                                       py-3 
                                       border 
                                       border-gray-300 
                                       rounded-lg 
                                       focus:ring-2 
                                       focus:ring-purple-500 
                                       focus:border-transparent 
                                       @error('body') border-red-500 @enderror"
                                    placeholder="Write your answer here..." required>{{ old('body') }}</textarea>

                                @error('body')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                            <button type="submit"
                                class="w-full 
                                       bg-gradient-to-r 
                                       from-purple-600 
                                       to-indigo-600 
                                       hover:from-purple-700 
                                       hover:to-indigo-700 
                                       text-white 
                                       font-semibold 
                                       py-3 
                                       px-4 
                                       rounded-lg 
                                       transition 
                                       duration-300 
                                       transform 
                                       hover:-translate-y-1 
                                       hover:shadow-lg">
                                Post Your Answer
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div
                    class="bg-white 
                        rounded-xl 
                        shadow-lg 
                        overflow-hidden 
                        text-center 
                        p-8 
                        transition-all 
                        duration-300 
                        hover:-translate-y-1 
                        hover:shadow-xl">
                    <p class="text-gray-600 text-lg">
                        Please <a href="{{ route('login') }}"
                            class="text-purple-600 
                                     hover:text-purple-800 
                                     font-semibold 
                                     transition-all 
                                     duration-300">
                            login
                        </a> to post an answer.
                    </p>
                </div>
            @endauth
        </div>
    </div>
@endsection
