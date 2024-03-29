<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Post;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\DestroyRequest;

class PostController extends Controller
{
    public function index(Request $request, Post $post)
    {
        return Inertia::render('Post/Show', [
            'post' => $post->load(['comments:id,user_id,post_id,body', 'comments.user:id,name']),
        ]);
    }

    /**
     * Display the Post form.
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store the Post form.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->post_title,
            'short_body' => substr($request->post_body, 0, 100),
            'body' => $request->post_body,
        ]);

        return Redirect::route('index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->post_title ?? $post->title,
            'short_body' => substr($request->post_body ?? $post->body, 0, 100) ,
            'body' => $request->post_body ?? $post->body,
        ]);
    }

    public function destroy(DestroyRequest $request, Post $post): RedirectResponse
    {
        $post->delete();

        return Redirect::route('index');
    }
}
