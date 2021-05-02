<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DatabaseTest;

class ReadThreadsTest extends DatabaseTest
{
    use RefreshDatabase;
    
    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get(route('threads.index'))
             ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get(route('threads.show', [$this->thread->channel, $this->thread]))
             ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get(route('threads.show', [$this->thread->channel, $this->thread]))
             ->assertSee($reply->body);
    }
}
