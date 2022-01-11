<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_a_user_can_browse_posts()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_a_user_can_access_post()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/' . $post->slug);
        $response->assertOk();
    }

    public function test_unauthorized_user_can_comment_post()
    {
        $post = Post::factory()->create();

        $response = $this->post('comments/'. $post->slug .'/create', ['body' => 'Some text']);
        $this->assertGuest();
    }

    public function test_authorized_user_can_comment_post()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $post = Post::factory()->create();
        $response = $this->actingAs($user)->post('comments/'. $post->slug .'/create',
            [
                'body' => 'Some text',
                'user_id' => $user->id
            ]);
        $response->assertStatus(302);
    }
}
