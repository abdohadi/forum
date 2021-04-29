<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
    	$user = $user ? $user : User::factory()->create();

    	$this->be($user);

    	return $user;
    }
}
