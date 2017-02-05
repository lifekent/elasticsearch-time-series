<?php

namespace Stats\Report;

/**
* Histogram report
* @author Roman N. <roman@agently.io>
*/
class Histogram extends AbstractBase
{

    /**
     * Get a histogram for the given interval
     * @param  string  $event
     * @param  string  $interval    Available expressions for interval: year, quarter, month, week, day, hour, minute, second 
     * @return array         
     */
    public function get($event, $interval = 'hour')
    {
        return $this->storage->histogram($event, $interval);
    }

}