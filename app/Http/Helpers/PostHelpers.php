<?php

namespace App\Http\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostHelpers
{
    /**
     * Gets a list of all posts
     * 
     * @return Post
     */
    public static function getAllPosts(string $search = null)
    {
        return Post::select(['id', 'title', 'short_body', 'user_id'])
            ->with(['user:id,name'])
            ->when($search, function($query) use ($search) {
                return $query->where('title', 'like', "%$search%")
                    ->orwhere('body', 'like', "%$search%");
            })            
            ->paginate(10)
            ->appends(['search' => $search]);
    }
}