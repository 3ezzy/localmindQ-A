@extends('layouts.app')

@section('title', 'Ask a Question - LocalMind Q&A')

@section('content')
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">Ask a Question</h1>

            <form class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Title
                    </label>
                    <input type="text" 
                        class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition"
                        placeholder="Be specific and imagine you're asking a question to another person">
                    <p class="mt-2 text-sm text-gray-500">
                        Your title should summarize the problem you're trying to solve
                    </p>
                </div>

                <!-- Markdown Editor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Question Details
                    </label>
                    <textarea id="markdown-editor"></textarea>
                    <p class="mt-2 text-sm text-gray-500">
                        Tip: Use Markdown to format your question. You can include code blocks using ```
                    </p>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tags
                    </label>
                    <input type="text" id="tags" 
                        class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Add up to 5 tags to describe what your question is about">
                    <p class="mt-2 text-sm text-gray-500">
                        Add tags to help others find your question
                    </p>
                </div>

                <!-- Preview -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-700">Preview</h3>
                        <button type="button" id="toggle-preview" 
                            class="text-sm text-purple-600 hover:text-purple-500">
                            Show/Hide Preview
                        </button>
                    </div>
                    <div id="preview" class="prose max-w-none hidden">
                        <!-- Preview content will be displayed here -->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="notify" 
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
    new Tagify(document.querySelector('#tags'), {
        maxTags: 5,
        whitelist: ["php", "laravel", "javascript", "mysql", "html", "css", "vue.js", "react", "node.js"],
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
</script>
@endpush