<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish New Post</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data" id="postForm">
            @csrf

            <x-form.input name="title" required />
            <x-form.input name="slug" required />
            <x-form.input name="thumbnail" type="file" required />
            <x-form.textarea name="excerpt" required />

            <!-- Replace the textarea for 'body' with a div for Quill -->
            <div id="editor-container" style="height: 400px;"></div>
            <input type="hidden" name="body" id="body-input">

            <x-form.field>
                <x-form.label name="category_id"/>

                <select name="category_id" id="category_id" required>
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category"/>
            </x-form.field>

            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Initialize Quill editor
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    // Set up the form submission
    document.querySelector('#postForm').onsubmit = function() {
        // Populate hidden input with Quill content before submitting
        var bodyInput = document.querySelector('#body-input');
        bodyInput.value = quill.root.innerHTML;

        // Additional check to ensure the body is populated
        if (bodyInput.value.trim() === "") {
            alert("Post body cannot be empty!");
            return false;
        }
    };
</script>
</body>
</html>
