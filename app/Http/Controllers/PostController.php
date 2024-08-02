<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Session;

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

        return to_route('posts.my_posts')->with('status', ['Post Has been created successfully']);
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

        return to_route('posts.show', [$post->id])->with('status', 'Post Updated Successfully');
    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();

        return to_route($request->route('redirect'))->with('status', 'Post has been deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::where('title', 'like', "%$search%")->paginate(5);

        return view('posts.search-results', ['posts' => $posts]);
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
