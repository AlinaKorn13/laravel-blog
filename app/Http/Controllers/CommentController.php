<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    /*
     * Save user comment
     */
    public function store(Post $post)
    {
        request()->validate([
            'body' => 'required'
        ]);

        $comment = $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        return view('posts.comment', compact('comment'))->render();
    }

}
