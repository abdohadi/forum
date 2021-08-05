<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;
use App\Models\User;
use App\Models\Thread;

class ProfilesTest extends DatabaseTest
{
    /** @test */
    public function a_user_has_a_profile()
    {
        $user = User::factory()->create();

        $this->get(route('profile', $user))
            ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create(['user_id' => $user->id]);

        $this->get(route('profile', $user))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
