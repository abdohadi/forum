<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;

class CreateThreadsTest extends DatabaseTest
{
    use RefreshDatabase;

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
}
