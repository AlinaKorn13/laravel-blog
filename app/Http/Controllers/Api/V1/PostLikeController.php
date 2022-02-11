<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\PostLikeResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends \App\Http\Controllers\Controller
{
    /*
     * Set view to post and update views count
     */
    public function update(Request $request)
    {
        $post = Post::find($request->id);

        $post->increment('likes', 1);

        return $post->likes;
    }
}
