<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public bool $isLikedByUser = false;

    protected $guarded = [];

    protected $with = ['category', 'author', 'comments', 'likes'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%'. $search .'%')
                ->orWhere('body', 'like', '%'. $search .'%');
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(PostsLike::class);
    }

    public static function getLikes(int $id)
    {
        return self::find($id)->first()->likes()->get()->count();
    }

    public function isLikedByUser($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->get()->toArray();
    }

    public static function months()
    {
        return self::select(
            DB::raw('count(id) as `posts`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
            DB::raw('max(created_at) as createdAt')
        )
            ->where("user_id", auth()->id())
            ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->orderBy('createdAt', 'desc')
            ->groupBy('months')
            ->get();
    }
}
