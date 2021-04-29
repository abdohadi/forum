<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInThreadsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }
    /** @test */
    public function an_unauthenticated_user_may_not_add_replies_to_a_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = Thread::factory()->create();
            
        $this->post(route('threads.replies.store', $thread->id), []);
    }

    /** @test */
    public function an_authenticated_user_can_add_replies_to_a_thread()
    {
        $this->signIn();
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->post(route('threads.replies.store', $thread->id), $reply->toArray());

        $this->get(route('threads.show', $thread->id))
             ->assertSee($reply->body);
    }
}
