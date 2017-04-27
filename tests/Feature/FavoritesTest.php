<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoritesTest extends TestCase
{
	use DatabaseMigrations;

	public function an_authenticated_user_can_favorite_any_reply()
	{
		$reply = create('App\Reply');

		// If post to a favorite endpoint
		$this->post('/replies/'.$reply->id.'/favorites');
		// It should be recorded into db
		$this->assertCount(1, $reply->favorites);
	}
}