<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /*
     * View posts on main page
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->paginate(6),
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    /*
     * View single post
     */
    public function show(Post $post)
    {
        $post->increment('views', 1);

        return view('posts.show', ['post' => $post]);
    }
}
