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
             ->assertRedirect('login');
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
}
