<?php


namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        if (auth()->guest()) return abort(401);

        try {
            $data = [
                'post_id' => $request->id,
                'user_id' => auth()->id()
            ];

            if (!empty(Post::find($request->id)->isLikedByUser(auth()->id()))) {
                Post::find($request->id)->likes()->where('user_id', auth()->id())->delete();
            } else {
                Post::find($request->id)->likes()->create($data);
            }

        } catch (\Exception $e) {

        }

        return Post::getLikes($request->id);
    }

}
