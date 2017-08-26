<?php

namespace Tests\Unit;

use Tests\TestCase;

class ReplyTest extends TestCase
{
    /** @test */
    public function it_has_an_owner()
    {
        $reply = create('App\Reply');
        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
