<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'post_id',
    ];

    public function rules()
    {
        return [
            'ip_address' => ['unique', 'required'],
            'post_id' => ['required', 'default:0'],
        ];
    }

    public static function addVisitor($ip, $post_id)
    {
        return self::firstOrCreate(['post_id' => $post_id, 'ip_address' => $ip]);
    }

    public static function views()
    {
        return self::select(
            DB::raw('count(post_id) as `views`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
            DB::raw('max(created_at) as createdAt')
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->orderBy('createdAt', 'desc')
            ->groupBy('months')
            ->get();
    }
}
