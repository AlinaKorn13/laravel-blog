<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /*
     * Get admin posts in the dashboard
     */
    public function index()
    {
        return view('dashboard.index', [
            'posts' => Post::orderByDesc('updated_at')->paginate(6)
        ]);
    }

    /*
     * Return create post view
     */
    public function create()
    {
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

        return redirect('/admin/dashboard');
    }

    /*
     * Return edit post view
     */
    public function edit(Post $post)
    {
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

        return redirect('/admin/dashboard');
    }

    /*
     * Delete post
     */
    public function destroy(Post $post)
    {
        $post->delete();

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
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
