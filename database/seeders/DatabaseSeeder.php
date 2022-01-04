<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        // \App\Models\User::factory(10)->create();
         \App\Models\Post::factory(10)->create();
    }
}
