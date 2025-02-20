<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask a Question - LocalMind Q&A</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SimpleMDE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        /* Custom styling for SimpleMDE */
        .editor-toolbar {
            border-radius: 0.5rem 0.5rem 0 0;
            border-color: #e5e7eb;
        }
        .CodeMirror {
            border-radius: 0 0 0.5rem 0.5rem;
            border-color: #e5e7eb;
        }
        .editor-toolbar button.active, .editor-toolbar button:hover {
            background: #f3f4f6;
            border-color: #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="glass-effect fixed w-full z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-500">
                        LocalMind
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <img src="https://api.dicebear.com/6.x/avatars/svg?seed=3ezzy" alt="avatar" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700">3ezzy</span>
                
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Ask a Question</h1>

                    <form class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Question Title
                            </label>
                            <input type="text" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 transition"
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
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
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
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="notify" 
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="notify" class="text-sm text-gray-600">
                                    Notify me when someone answers
                                </label>
                            </div>
                            <button type="submit" 
                                class="px-6 py-3 rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                                Post Your Question
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="mt-6 bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Writing a good question</h2>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Summarize your problem in a one-line title</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Describe what you've tried and what you expected to happen</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Use code blocks (```) for any code snippets</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Add relevant tags to help others find your question</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
</body>
</html>