<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;

class CreateThreadsTest extends DatabaseTest
{
    /** @test */
    public function guests_may_not_create_threads()
    {   
        $this->withExceptionHandling()
             ->get(route('threads.create'))
             ->assertRedirect('login');

        $this->post(route('threads.store'))
             ->assertRedirect('login');
    }

    /** @test */
    public function guests_can_not_see_create_page()
    {
        $this->withExceptionHandling()
             ->get(route('threads.create'))
             ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_thread()
    {
        $this->signIn();
        $thread = Thread::factory()->make();

        $this->get(route('threads.create'))
             ->assertStatus(200);

        $this->post(route('threads.store'), $thread->toArray());

        $this->get(route('threads.show', [$thread->channel, 1]))
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_channel_id()
    {
        Thread::factory(2)->create();

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = Thread::factory()->make($overrides);

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
