@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-600">LocalMind Q&A</h1>
                <p class="mt-2 text-gray-600">Share your knowledge, ask questions, find answers</p>
            </div>

            <!-- Replace your Ask Question button with this -->
            <div class="mb-8">
                <a href="{{ route('questions.create') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    Ask a Question
                </a>
            </div>
            <!-- Questions List -->
            <div class="space-y-6">
                @foreach ($questions as $question)
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-bold text-gray-800 hover:text-indigo-600">
                                    <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                                </h2>
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                                    {{ $question->answers_count ?? 0 }} answers
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($question->content, 200) }}</p>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if ($question->tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                        {{ $question->tag->name }}
                                    </span>
                                @endif
                            </div>
                            <!-- Question Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <span>Created for : </span>
                                    <span>{{ $question->user->name }}</span>
                                </div>
                                <span>{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleQuestionForm() {
            const form = document.getElementById('questionForm');
            form.classList.toggle('hidden');
        }
    </script>
@endpush

@push('styles')
    <style>
        .question-card {
            transition: transform 0.2s ease-in-out;
        }

        .question-card:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

