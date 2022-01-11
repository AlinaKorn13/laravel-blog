<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_can_access_create_post_page()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->actingAs($user)->get('/admin/posts/new');

        $response->assertStatus(200);
    }

    public function test_can_store_new_posts()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->actingAs($user)->post('/admin/posts/new',
            [
                'title' => 'Title',
                'slug' => 'slug',
                'excerpt' => 'Test excerpt',
                'body' => 'Test body',
                'category_id' => Category::factory()->create()->id,
                'user_id' => $user->id,
                'thumbnail' => ''
            ]);

        $response->assertStatus(302);
    }

    public function test_can_access_edit_post_page()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get('/admin/posts/' . $post->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_can_update_new_posts()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $post = Post::factory()->create();
        $response = $this->actingAs($user)->patch('/admin/posts/' . $post->id . '/edit',
            [
                'title' => 'Title',
            ]);

        $response->assertStatus(302);
    }

    public function test_can_delete_post()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->delete('/admin/posts/' . $post->id);

        $response->assertStatus(302);
    }
}
