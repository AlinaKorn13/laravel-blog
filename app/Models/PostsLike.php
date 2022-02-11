<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostsLike extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public static function likes()
    {
        return self::select(
            DB::raw('count(post_id) as `likes`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
            DB::raw('max(created_at) as createdAt')
        )
            ->whereIn("post_id", Post::where('user_id', auth()->id())->get()->pluck('id')->toArray())
            ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->orderBy('createdAt', 'desc')
            ->groupBy('months')
            ->get();
    }
}
