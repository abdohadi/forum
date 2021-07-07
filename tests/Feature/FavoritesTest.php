<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;

class FavoritesTest extends DatabaseTest
{
    /** @test */
    public function an_unauthenticated_user_cannot_favorite_a_reply()
    {
        $this->withExceptionHandling();

        $reply = Reply::factory()->create();

        $this->post(route('replies.favorite', $reply))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_favorite_a_reply()
    {
        $this->signIn();

        $reply = Reply::factory()->create();

        $this->post(route('replies.favorite', $reply));
        
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = Reply::factory()->create();

        $this->post(route('replies.favorite', $reply));
        $this->post(route('replies.favorite', $reply));
        
        $this->assertCount(1, $reply->favorites);
    }
}
