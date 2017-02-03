<?php

namespace Stats;

/**
* Events logger
* @author Roman Nehrulenko <roman@agently.io>
*/
class Logger
{
	protected $timestamp, $strg;

	public function __construct(Storage\Base $strg = null)
	{
		$this->strg = $strg ?: \Stats\Storage\Factory::make();
	}
	
	/**
	 * Issues an event into the event log
	 * @param  string 		$eventType
	 * @param  array 		$fields
	 * @return stdClass|bool    In case of success returns response data, otherwise returns false
	 */
	public function pulse(array $input)
	{
		return $this->write($this->createEvent($input));
	}

	/**
	 * Factory method. Creates events.
	 * @param  string 		$eventType
	 * @param  array 		$fields
	 * @return Stats\Event
	 */
	public function createEvent(array $fields)
	{
		$e = new Event($fields);
			
		return $e->prepare();
	}

	/**
	 * Set timestamp
	 * Mainly used for testing
	 * @param integer $seconds
	 */
	public function setTimestamp($seconds)
	{
		$this->timestamp = $seconds;
	}


	/**
	 * Save an event
	 * @param  Stats\Event  $event A prepared event
	 * @return array|bool
	 */
	private final function write(array $eventData)
	{
		$timestamp = $this->timestamp ?: time();

		$res = $this->strg->insert($eventData['event'], $timestamp, $eventData);

		if ($res)
		{
			$eventData['_id'] = $res;
			
			return $eventData; 
		}
		
		return false;
	}

}
