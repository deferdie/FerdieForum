<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

	use DatabaseMigrations;

	/** @test */
	public function unauthenticated_users_may_not_add_replies()
	{    	
    	$this->post('/threads/some-channel/1/replies', [])
        ->assertRedirect('/login');
	}

    /** @test */
    public function an_authenticated_user_may_participate_in_forume_threads()
    {
    	$this->signIn(create('App\User'));

    	$thread = create('App\Thread');

		$reply = make('App\Reply');
		
    	$this->post($thread->path().'/replies', $reply->toArray());

    	$this->get($thread->path())
    		->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

}