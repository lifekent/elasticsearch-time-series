<?php

class LoggerTest extends TestCase
{

	public function provide_successful_pulse()
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
	 * @dataProvider provide_successful_pulse
	 */
	public function test_successful_pulse($input)
	{
		$logger = new \Stats\Logger;

		$res = $logger->pulse($input);

		$this->assertEquals($input['event'], $res['event']);
		$this->assertEquals($input['domain'], $res['domain']);
		$this->assertEquals($input['url'], $res['url']);
	}


	public function provide_create_event()
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
	 * @dataProvider provide_create_event
	 */
	public function test_create_event($input)
	{
		$logger = new \Stats\Logger;

		$event = $logger->createEvent($input);

		$this->assertEquals($input['event'], $event['event']);
		$this->assertEquals($input['domain'], $event['domain']);
		$this->assertEquals($input['url'], $event['url']);
		
		$this->assertArrayHasKey('session', $event);
	}


}