@extends('layouts.app')

@push('styles')
    <style>
        /* Modern Glassmorphic Design */
        body {
            background: linear-gradient(135deg, #f6f8f9 0%, #e5ebee 100%);
            background-attachment: fixed;
        }

        .card-container {
            perspective: 1000px;
        }

        .question-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .question-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .gradient-text {
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Responsive Grid */
        .questions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* Animated Hover Effect */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hover-float {
            transition: all 0.3s ease;
        }

        .hover-float:hover {
            animation: float 2s ease infinite;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-text mb-4">
                LocalMind Community
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Discover, Learn, and Share Knowledge with Our Vibrant Community
            </p>
        </div>


        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-4 md:space-y-0">
            <div class="flex space-x-4 w-full">
                <!-- Ask Question Button -->
                <a href="{{ route('questions.create') }}"
                    class="inline-flex items-center px-6 py-3 
                  bg-gradient-to-r from-purple-600 to-blue-500 
                  text-white font-semibold 
                  rounded-full 
                  hover:from-purple-700 hover:to-blue-600 
                  transition duration-300 
                  transform hover:-translate-y-1 
                  hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i> Ask a Question
                </a>

                <!-- Add Tag Button -->
                <a href="{{ route('tags.create') }}"
                    class="inline-flex items-center px-6 py-3 
               bg-gradient-to-r from-green-500 to-teal-500 
               text-white font-semibold 
               rounded-full 
               hover:from-green-600 hover:to-teal-600 
               transition duration-300 
               transform hover:-translate-y-1 
               hover:shadow-lg">
                    <i class="fas fa-tags mr-2"></i> Add Tag
                </a>

            </div>

            <!-- Tag Filter -->
            <form action="{{ route('questions.index') }}" method="GET" class="w-full md:w-auto">
                <div class="relative">
                    <select name="tag_id" onchange="this.form.submit()"
                        class="w-full md:w-64 
                           px-4 py-2 
                           border border-gray-300 
                           rounded-full 
                           text-gray-700 
                           focus:ring-2 
                           focus:ring-blue-500 
                           focus:border-transparent">
                        <option value="">All Topics</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Tag Modal -->
        <div x-data="{ showTagModal: false }" x-show="showTagModal"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            x-cloak>
            <div class="relative w-auto max-w-3xl mx-auto my-6">
                <div
                    class="relative flex flex-col w-full bg-white border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                    <!-- Modal Header -->
                    <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-blueGray-200">
                        <h3 class="text-3xl font-semibold">
                            Create New Tag
                        </h3>
                        <button @click="showTagModal = false"
                            class="float-right p-1 ml-auto text-3xl font-semibold leading-none text-black bg-transparent border-0 outline-none opacity-5 focus:outline-none">
                            <span class="block w-6 h-6 text-2xl text-black opacity-5 focus:outline-none">
                                ×
                            </span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ route('tags.store') }}" method="POST" class="relative flex-auto p-6">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description
                                (Optional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="color" class="block text-sm font-medium text-gray-700">Tag Color</label>
                            <input type="color" name="color" id="color" value="#3B82F6"
                                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm">
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-blueGray-200">
                            <button @click="showTagModal = false" type="button"
                                class="px-6 py-2 mb-1 mr-4 text-sm font-bold text-gray-600 uppercase transition-all duration-150 ease-linear bg-gray-200 rounded-lg hover:bg-gray-300">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 mb-1 text-sm font-bold text-white uppercase transition-all duration-150 ease-linear bg-green-500 rounded-lg hover:bg-green-600">
                                Create Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
            <script>
                // Optional: Add any additional JavaScript for tag creation
            </script>
        @endpush

        <!-- Questions Grid -->
        <div class="questions-grid">
            @forelse ($questions as $question)
                <div class="card-container">
                    <div class="question-card hover-float p-6">
                        <!-- Question Title -->
                        <a href="{{ route('questions.show', $question->id) }}"
                            class="block text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition">
                            {{ Str::limit($question->title, 50) }}
                        </a>

                        <!-- Question Excerpt -->
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($question->body, 100) }}
                        </p>

                        <!-- Question Metadata -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t">
                            <!-- User Info -->
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 
                                        flex items-center justify-center text-white font-bold">
                                    {{ substr($question->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ $question->user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $question->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Answers Count -->
                            <div class="bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-xs">
                                {{ $question->answers_count ?? 0 }}
                                {{ Str::plural('Answer', $question->answers_count ?? 0) }}
                            </div>
                        </div>

                        <!-- Tags -->
                        @if ($question->tag)
                            <div class="mt-4">
                                <span
                                    class="inline-block bg-gray-100 text-gray-700 
                                         rounded-full px-3 py-1 text-xs">
                                    #{{ $question->tag->name }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-16">
                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <i class="fas fa-question-circle text-6xl text-gray-300 mb-6"></i>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">No Questions Yet</h2>
                        <p class="text-gray-600 mb-6">
                            Be the first to start a conversation in our community!
                        </p>
                        <a href="{{ route('questions.create') }}"
                            class="inline-block bg-gradient-to-r from-purple-600 to-blue-500 
                              text-white font-bold py-3 px-6 rounded-full 
                              hover:from-purple-700 hover:to-blue-600 
                              transition duration-300">
                            Start the Discussion
                        </a>
                    </div>
                </div>
            @endforelse
        </div>


        <!-- Pagination -->
        @if ($questions->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $questions->links() }}
            </div>
        @endif
    </div>
@endsection
