<?php

namespace Stats\Report;

/**
* Count report
* @author Roman N. <roman@agently.io>
*/
class Count extends AbstractBase
{

	/**
	 * Get total number of events
	 * @param  string  $event
	 * @return array         
	 */
	public function get($event)
	{
		return $this->storage->count($event);
	}

		
}