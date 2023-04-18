<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
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
        Visitor::addVisitor(request()->ip(), $post->id);

        $post->views = Visitor::all()->count();

        if ($post->isLikedByUser(auth()->id())) {
            $post->isLikedByUser = true;
        }

        return view('posts.show', ['post' => $post]);
    }
}
