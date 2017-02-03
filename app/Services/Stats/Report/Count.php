<?php

namespace Stats\Report;

use \Stats\Report\Base;

/**
* Count report
* @author Roman N. <roman@agently.io>
*/
class Count extends Base
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