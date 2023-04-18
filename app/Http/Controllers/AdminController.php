<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostsLike;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /*
     * Get admin posts in the dashboard
     */
    public function index()
    {
        Log::channel('custom-logger')->info('Dashboard page opened by user id: '. auth()->id());

        return view('dashboard.index', [
            'posts' => Post::where('user_id', auth()->id())->orderByDesc('updated_at')->paginate(6)
        ]);
    }

    /*
     * Get admin statistics in the dashboard
     */
    public function stats()
    {
        Log::channel('custom-logger')->info('Stats page opened by user id: '. auth()->id());

        $data = Post::months();

        $dataLikes = PostsLike::likes();

        $views = Visitor::views();

        $comments = Comment::comments();

        return view('dashboard.stats', [
            'months' => $data->pluck('months'),
            'posts' => $data->pluck('posts'),
            'likes' => $dataLikes->pluck('likes'),
            'views' => $views->pluck('views'),
            'comments' => $comments->pluck('comments'),
        ]);
    }

    /*
     * Return create post view
     */
    public function create()
    {
        Log::channel('custom-logger')->info('Create page opened by user id: '. auth()->id());

        return view('dashboard.create');
    }

    /*
     * Save new validated post
     */
    public function store()
    {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        Log::channel('custom-logger')->info('Post was created by user id: '. auth()->id());

        return redirect('/admin/dashboard')->with('info', 'Your post has been created.');
    }

    /*
     * Return edit post view
     */
    public function edit(Post $post)
    {
        Log::channel('custom-logger')->info('Edit page opened by user id: '. auth()->id());

        return view('dashboard.edit', ['post' => $post]);
    }

    /*
     * Update validated post
     */
    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        Log::channel('custom-logger')->info('Post was updated by user id: '. auth()->id());

        return redirect('/admin/dashboard')->with('info', 'Your post has been updated.');;
    }

    /*
     * Delete post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Log::channel('custom-logger')->info('Post was removed by user id: '. auth()->id());

        session()->flash('info', 'Your post has been removed.');

        return back();
    }

    /*
     * Validate post fields while create/update post
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'video_src' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
