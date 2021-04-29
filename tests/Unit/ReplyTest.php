<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    /** @test */
    public function it_can_have_an_owner()
    {
        $reply = Reply::factory()->create();
    	
    	$this->assertInstanceOf(User::class, $reply->owner);
    }
}
