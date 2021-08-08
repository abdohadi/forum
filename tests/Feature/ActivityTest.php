<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DatabaseTest;

class ActivityTest extends DatabaseTest
{
    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $user = $this->signIn();
        $thread = Thread::factory()->create();

        $this->assertDatabaseHas('activities', [
            'user_id' => $user->id,
            'type' => 'created_thread',
            'subject_id' => $thread->id,
            'subject_type' => 'App\Models\Thread'
        ]);

        $activity = Activity::first();
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();
        $reply = Reply::factory()->create();

        $this->assertEquals(2, Activity::count());
    }
}
