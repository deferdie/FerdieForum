<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
    	$user = ($user == null) ? create('App\User') : $user = $user; 

    	$this->actingAs($user);

    	return $this;
    }

}
