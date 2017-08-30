<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }
    /** @test */
    public function a_user_can_view_all_threads()
    {
        // $thread = factory('App\Thread')->create();
        $this->get('/threads')
        ->assertSee($this->thread->title)
        ->assertSee($this->thread->body);
    }
    /** @test */
    public function a_user_can_read_signle_thread()
    {
        // $thread = factory('App\Thread')->create();
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }
    /** @test */
    public function a_user_can_read_replies_that_are_assosiated_with_threads()
    {
        $reply = factory('App\Reply')->create([ 'thread_id' => $this->thread->id ]);
        $this->get($this->thread->path())
        ->assertSee($reply->body);
    }
    /** @test */
    public function a_user_can_filter_threads_by_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id ]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);
    }
    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe' ]));

        $threadByJhon = create('App\Thread', ['user_id' => auth()->id() ]);

        $threadnotByJhon = create('App\Thread');

        $this->get('threads?by=JohnDoe')
        ->assertSee($threadByJhon->title)
        ->assertDontSee($threadnotByJhon->title);
    }
}
