<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;

abstract class DuskTestCase extends BaseTestCase
{
	use CreatesApplication;
	
	public function setUp() {
		parent::setUp();
		$this->artisan('db:seed');
	}
	
    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
		$options = (new ChromeOptions)->addArguments([
			// '--disable-gpu',
			// '--headless', 
			'--window-size=1400,800'
		]); 
	
		return RemoteWebDriver::create(
			'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
				ChromeOptions::CAPABILITY, $options
			)
		);
	}
}
