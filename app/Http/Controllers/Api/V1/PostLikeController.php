<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostLikeResource;
use App\Models\Post;
use App\Models\PostsLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

{
    /*
     * Set view to post and update views count
     */

    public function store(Request $request)
    {
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

        $likes = Post::getLikes($request->id);

        return $likes;

}
