<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    // use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }
    /** @test */
    public function a_user_can_view_all_threads()
    {
        // $thread = factory('App\Thread')->create();
        $this->get('/threads')
        ->assertSee($this->thread->title);
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
}
