<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Sentinel;
abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	protected static $migrationsRun = false;
	protected function loginUser($i) {
		$user = Sentinel::findById($i);
		Sentinel::login($user);
	}

	public function setUp() {
		parent::setUp();
		$this->withoutExceptionHandling();
		if (!static::$migrationsRun) {
			Artisan::call('migrate');
			static::$migrationsRun = true;
		}
		$this->artisan('db:seed');
		
		$user = Sentinel::findById(1);
		Sentinel::login($user, true);
		
	}
}
