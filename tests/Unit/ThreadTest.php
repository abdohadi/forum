<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DatabaseTest;

class ThreadTest extends DatabaseTest
{
    use RefreshDatabase;

    protected $thread;

    public function setUp(): void
    {
    	parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function it_can_have_replies()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);
        
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function it_has_a_creator()
    {	
    	$this->assertInstanceOf('App\Models\User', $this->thread->creator);	
    }

    /** @test */
    public function it_can_add_a_reply()
    {
    	$this->thread->addReply([
    		'body' => 'body',
    		'user_id' => 1
    	]);

    	$this->assertCount(1, $this->thread->replies);
    }
}
