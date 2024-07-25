<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" required />
            <x-form.input name="slug" required />
            <x-form.input name="thumbnail" type="file" required />
            <x-form.textarea name="excerpt" required />
            <x-form.post-textarea name="body" required />

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

{{--<x-layout>--}}
{{--    <x-setting :heading="'Edit Post: ' . $post->title">--}}
{{--        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}

{{--            <x-form.input name="title" :value="old('title', $post->title)" required />--}}
{{--            <x-form.input name="slug" :value="old('slug', $post->slug)" required />--}}

{{--            <div class="flex mt-6">--}}
{{--                <div class="flex-1">--}}
{{--                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />--}}
{{--                </div>--}}

{{--                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">--}}
{{--            </div>--}}

{{--            <div class="flex mt-6">--}}
{{--                <div class="flex-1">--}}
{{--                    <x-form.input name="images[]" type="file" multiple />--}}
{{--                </div>--}}
{{--                @foreach ($post->images as $image)--}}
{{--                    <img src="{{ asset('storage/' . $image->path) }}" alt="" class="rounded-xl ml-6" width="100">--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <div class="flex mt-6">--}}
{{--                <div class="flex-1">--}}
{{--                    <x-form.input name="videos[]" type="file" multiple />--}}
{{--                </div>--}}
{{--                @foreach ($post->videos as $video)--}}
{{--                    <video width="320" height="240" controls class="rounded-xl ml-6">--}}
{{--                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">--}}
{{--                        Your browser does not support the video tag.--}}
{{--                    </video>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <x-form.textarea name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>--}}
{{--            <x-form.textarea name="body" required>{{ old('body', $post->body) }}</x-form.textarea>--}}

{{--            <x-form.field>--}}
{{--                <x-form.label name="category"/>--}}

{{--                <select name="category_id" id="category_id" required>--}}
{{--                    @foreach (\App\Models\Category::all() as $category)--}}
{{--                        <option--}}
{{--                            value="{{ $category->id }}"--}}
{{--                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}--}}
{{--                        >{{ ucwords($category->name) }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                <x-form.error name="category"/>--}}
{{--            </x-form.field>--}}

{{--            <x-form.button>Update</x-form.button>--}}
{{--        </form>--}}
{{--    </x-setting>--}}
{{--</x-layout>--}}

