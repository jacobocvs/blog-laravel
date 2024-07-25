<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images');
                Image:create([
                    'post_id'=> $post->id,
                    'path' => $imagePath
                ]);
            }
        }

        if($request->hasfile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $video->store('videos');
                Video:create::create([
                    'post_id'=>$post->id,
                    'path' => $videoPath
                ]);
            }
        }

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimes:mp4,webm,ogg,mpga,avi'
        ]);
    }
}
