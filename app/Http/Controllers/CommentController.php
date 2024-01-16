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

use App\Models\Comment;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\DestroyRequest;

class CommentController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request, Comment $comment)
    {
        $comment->update([
            'body' => $request->comment_body ?? $comment->body,
        ]);
    }

    /**
     * Store the Post form.
     */
    public function store(StoreRequest $request)
    {
        Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);
    }

    public function destroy(DestroyRequest $request, Comment $comment)
    {
        $comment->delete();
    }
}
