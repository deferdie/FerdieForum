<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function guests_may_not_create_threads()
	{

		$thread = make('App\Thread');
    	
    	$this->post('/threads', $thread->toArray())->assertSee('/login');
	}

    /** @test */
    public function guests_cannot_see_the_create_thread_page()
    {
        $this->get('/threads/create')->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
    	// Given we have a logged in user
    	$this->signIn();
    	// When we hit the endpoint to create a new thread
    	$thread = make('App\Thread');

    	$response = $this->post('/threads', $thread->toArray());
    	// Then when we vsit the thread page
    	$this->get($response->headers->get('Location'))->assertSee($thread->title);
    	
    }


    // Test the validation
    /** @test */
    public function a_thread_requires_a_title()
    {

        $this->publishThread(['title'=> null])
            ->assertSessionHasErrors('title');

    }

    // Test the validation
    /** @test */
    public function a_thread_requires_a_body()
    {

        $this->publishThread(['body'=> null])
            ->assertSessionHasErrors('body');

    }

    // Test the validation
    /** @test */
    public function a_thread_requires_a_valid_cannel()
    {

        factory('App\Channel', 2)->create();


        $this->publishThread(['channel_id'=> null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=> 999])
            ->assertSessionHasErrors('channel_id');

    }

    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}