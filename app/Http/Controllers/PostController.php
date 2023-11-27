<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::all();

        return Inertia::render('Admin/Posts/Index', [
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(CreatePostRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return to_route('posts.index');
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post)
        ]);
    }

    public function update(CreatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        return to_route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return back();
    }
}
