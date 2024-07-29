<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    public function latestPosts()
    {
        $posts = Post::latest()->paginate(5);

        return view('home', ['posts' => $posts]);
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', '=', auth()->user()->id)->latest()->paginate(5);

        return view('posts.my-posts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->safe()->except('img'));

        if ($request->hasFile('img')) {
            $post->addMediaFromRequest('img')
                ->withResponsiveImages()
                ->usingName($post->title)
                ->toMediaCollection('imgs');
        }

        return to_route('posts.my_posts')->with('status', 'Post Has been created successfully');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $post->update($request->safe()->except('img'));

        if ($request->hasFile('img')) {
            $post->clearMediaCollection('imgs');

            $post->addMediaFromRequest('img')
                ->withResponsiveImages()
                ->usingName($post->title)
                ->toMediaCollection('imgs');
        }

        return to_route('posts.show', [$post->id]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return to_route(request()->route('redirect'))->with('status', 'Post has been deleted successfully');
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:Create Post', only: ['create', 'store']),
            new Middleware('permission:Edit Post', only: ['edit', 'update']),
            new Middleware('permission:Delete Post', only: ['destroy']),
        ];
    }
}

/*
    - Laravel Blade files naming convention:

      * While there is no strict naming convention for Blade files you can notice the following:
        - It's very common for a view file to have the same name as the function it calls it.
        - It's very common also to have route name in the form (resource.function).
        - and function names are in camelCase so it's good to have your views named in it, so
          your naming will be more consistent across your project.
        - Spatie recommends this approach.

      * You can also stick with Laravel's default naming convention for blade files which
        is kebab-case (see Breeze scaffolding, this is what Taylor does anyway!).


*/