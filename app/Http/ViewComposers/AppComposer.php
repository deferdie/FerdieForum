<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

use App\Channel;

class AppComposer
{
	protected $channel;

	public function __construct(Channel $channel)
	{
		$this->channel = $channel;
	}

	public function compose(View $view)
	{
		$view->with('channels', $this->channel->all());
	}
}
