@extends('layouts.app')

@section('title', 'Ask a Question - LocalMind Q&A')

@section('content')
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">Ask a Question</h1>

            <form class="space-y-6" method="POST" action="{{ route('questions.store') }}">
                @csrf
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Title
                    </label>
                    <input type="text" 
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition @error('title') border-red-500 @enderror"
                        placeholder="Be specific and imagine you're asking a question to another person">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Your title should summarize the problem you're trying to solve
                    </p>
                </div>

                <!-- Markdown Editor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Details
                    </label>
                    <textarea id="markdown-editor" name="body">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Tip: Use Markdown to format your question. You can include code blocks using ```
                    </p>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tags
                    </label>
                    <select name="tag_id" 
                        class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 @error('tag_id') border-red-500 @enderror">
                        <option value="">Select a tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tag_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Add tags to help others find your question
                    </p>
                </div>

                

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" 
                            name="notify" 
                            id="notify" 
                            value="1"
                            {{ old('notify') ? 'checked' : '' }}
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="notify" class="text-sm text-gray-600">
                            Notify me when someone answers
                        </label>
                    </div>
                    <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2 sm:py-3 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                        Post Your Question
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Please check the form for errors.</span>
        </div>
    @endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
    // Initialize SimpleMDE
    const simplemde = new SimpleMDE({
        element: document.getElementById("markdown-editor"),
        spellChecker: false,
        autofocus: true,
        placeholder: "Describe your question in detail...\nInclude any relevant code, error messages, or context.",
        toolbar: [
            "bold", "italic", "heading", "|",
            "code", "quote", "|",
            "unordered-list", "ordered-list", "|",
            "link", "image", "|",
            "preview", "side-by-side", "fullscreen", "|",
            "guide"
        ]
    });

    // Initialize Tagify
    const tags = {!! json_encode($tags->pluck('name')) !!};
    new Tagify(document.querySelector('#tags'), {
        maxTags: 5,
        whitelist: tags,
        dropdown: {
            maxItems: 20,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false
        }
    });

    // Toggle Preview
    document.getElementById('toggle-preview').addEventListener('click', function() {
        const preview = document.getElementById('preview');
        preview.classList.toggle('hidden');
        if (!preview.classList.contains('hidden')) {
            preview.innerHTML = simplemde.markdown(simplemde.value());
        }
    });

    // Auto-save form data to localStorage
    const form = document.querySelector('form');
    const formInputs = form.querySelectorAll('input, textarea, select');
    
    // Load saved data
    formInputs.forEach(input => {
        const savedValue = localStorage.getItem(`question_${input.name}`);
        if (savedValue && !input.value) {
            if (input.type === 'checkbox') {
                input.checked = savedValue === 'true';
            } else {
                input.value = savedValue;
            }
        }
    });

    // Save data on input change
    formInputs.forEach(input => {
        input.addEventListener('change', () => {
            const value = input.type === 'checkbox' ? input.checked : input.value;
            localStorage.setItem(`question_${input.name}`, value);
        });
    });

    // Clear localStorage on form submit
    form.addEventListener('submit', () => {
        formInputs.forEach(input => {
            localStorage.removeItem(`question_${input.name}`);
        });
    });
</script>
@endpush