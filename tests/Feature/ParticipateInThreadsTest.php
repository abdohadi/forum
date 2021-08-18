<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;

class ParticipateInThreadsTest extends DatabaseTest
{
    /** @test */
    public function an_unauthenticated_user_may_not_add_replies_to_a_thread()
    {
        $thread = Thread::factory()->create();
            
        $this->withExceptionHandling()
             ->post(route('threads.replies.store', $thread), [])
             ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_add_replies_to_a_thread()
    {
        $this->signIn();
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->post(route('threads.replies.store', $thread), $reply->toArray());

        $this->get(route('threads.show', [$thread->channel, $thread]))
             ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();
        
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make(['body' => null]);
        
        $this->post(route('threads.replies.store', $thread), $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_a_reply()
    {
        $this->withExceptionHandling();

        $reply = Reply::factory()->create();

        $this->delete(route('replies.destroy', $reply))
            ->assertRedirect(route('login'));

        $this->signIn();

        $this->delete(route('replies.destroy', $reply))
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_their_replies()
    {
        $reply = Reply::factory()->create();
        $this->signIn($reply->owner);

        $this->delete(route('replies.destroy', $reply))
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function unauthorized_users_cannot_update_a_reply()
    {
        $this->withExceptionHandling();

        $reply = Reply::factory()->create();

        $attributes = ['body' => 'updated'];
        $this->patch(route('replies.update', $reply), $attributes)
            ->assertRedirect(route('login'));

        $this->signIn();

        $this->patch(route('replies.update', $reply), $attributes)
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_update_replies()
    {
        $reply = Reply::factory()->create();
        $this->signIn($reply->owner);
        
        $this->patch(route('replies.update', $reply), ['body' => 'updated body'])
            ->assertJson(['isSuccessful' => true]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => 'updated body']);
    }
}
