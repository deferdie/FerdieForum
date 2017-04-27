<?php

namespace App\Filters;

use App\User;

class ThreadFilter extends Filters
{

	protected $filters = ['byUser', 'popular'];

	protected function byUser($username)
	{
		$user = User::where('name', $username)->firstOrFail();

		return $this->builder->where('user_id', $user->id);
	}

	protected function popular()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}