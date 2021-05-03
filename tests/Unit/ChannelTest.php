<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use PHPUnit\Framework\TestCase;
use Tests\DatabaseTest;

class ChannelTest extends DatabaseTest
{
    /** @test */
    public function it_consists_of_threads()
    {
    	$channel = Channel::factory()->create();
    	$thread = Thread::factory()->create(['channel_id' => $channel->id]);

    	$this->assertTrue($channel->threads->contains($thread));
    }
}
