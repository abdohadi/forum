<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
	use RefreshDatabase;

    public function setUp(): void
    {
    	parent::setUp();

        $this->withoutExceptionHandling();
    }
}