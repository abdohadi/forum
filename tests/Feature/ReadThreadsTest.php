<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DatabaseTest;

class ReadThreadsTest extends DatabaseTest
{
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

    /** @test */
    public function a_user_can_view_all_threads_related_to_a_channel()
    {
        $channel = Channel::factory()->create();
        $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
        $threadNotInChannel = Thread::factory()->create();
        
        $this->get(route('threads.channel', $channel))
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $john = $this->signIn(User::factory()->create(['name' => 'john']));
        $threadByJohn = Thread::factory()->create(['user_id' => $john->id]);
        $threadNotByJohn = Thread::factory()->create();

        $this->get(route('threads.index', ['by' => 'john']))
             ->assertSee($threadByJohn->title)
             ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithThreeReplies = Thread::factory()->create();
        Reply::factory(3)->create(['thread_id' => $threadWithThreeReplies->id]);
        $threadWithTwoReplies = Thread::factory()->create();
        Reply::factory(2)->create(['thread_id' => $threadWithTwoReplies->id]);
        $threadWithNoReplies = $this->thread;

        $response = $this->getJson(route("threads.index", ['popular' => 1]))->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
