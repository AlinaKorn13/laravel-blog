<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewsletterTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_subscribe()
    {
        $user = User::factory()->create();

        $response = $this->post('/newsletter', [
            'email' => $user->email,
        ]);

        $response->assertStatus(302);
    }

    public function test_user_can_unsubscribe()
    {
        $user = User::factory()->create();

        $response = $this->get('/unsubscribe', [
            'email' => $user->email,
        ]);

        $response->assertStatus(302);
    }
}
