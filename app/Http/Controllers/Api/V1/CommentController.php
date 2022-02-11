<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Return the comments for the post.
     */
    public function index(Request $request)
    {
        return CommentResource::collection(
            Comment::where('post_id', $request->id)->paginate($request->input('limit', 20))
        );
    }
}
