<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Http\Helpers\PostHelpers;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query->get('search') ?? '';

        return Inertia::render('Blog/Index', [
            'canLogin' => Route::has('login'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'posts' => PostHelpers::getAllPosts($search),
            'search' => $search
        ]);
    }
}