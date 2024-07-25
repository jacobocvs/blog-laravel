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
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data" id="postForm">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" required />
            <x-form.input name="slug" :value="old('slug', $post->slug)" required />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>

                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.textarea name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.edit-editor name="body" />
            <div class="outline-none border border-gray-200 p-2 w-full rounded" style="max-width: 650px; margin: auto" id="editor">
                {!! old('body', $post->body) !!}
{{--                {{ old('body', $post->body) }}--}}
            </div>
            <input type="hidden" name="body" id="body-input">


            <x-form.field>
                <x-form.label name="category"/>

                <select name="category_id" id="category_id" required>
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category"/>
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        modules: {
            syntax: true,
            toolbar: '#body'
        },
        theme: 'snow'
    });

    // Set up the form submission
    document.querySelector('#postForm').onsubmit = function () {
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
