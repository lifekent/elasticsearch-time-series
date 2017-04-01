<?php

class LoggerTest extends TestCase
{

	public function provideSuccessfulPulse()
	{
		$input = [
			'event' 	=> 'ad.start',
			'domain' 	=> 'agently.io',
			'url' 		=> 'agently.io/apps/insta',
		];

		return [
			[$input]
		];
	}


	/**
	 * @dataProvider provideSuccessfulPulse
	 */
	public function testSuccessfulPulse($input)
	{
		$logger = new \Stats\Logger;

		$res = $logger->pulse($input);

		$this->assertEquals($input['event'], $res['event']);
		$this->assertEquals($input['domain'], $res['domain']);
		$this->assertEquals($input['url'], $res['url']);
	}


	public function provideCreateEvent()
	{
		$input = [
			'event' 	=> 'ad.close',
			'domain' 	=> 'agently.io',
			'url' 		=> 'agently.io/apps/insta',
		];

		return [
			[$input]
		];
	}


	/**
	 * @dataProvider provideCreateEvent
	 */
	public function testCreateEvent($input)
	{
		$logger = new \Stats\Logger;

		$event = $logger->createEvent($input);

		$this->assertEquals($input['event'], $event['event']);
		$this->assertEquals($input['domain'], $event['domain']);
		$this->assertEquals($input['url'], $event['url']);
		
		$this->assertArrayHasKey('session', $event);
	}


}