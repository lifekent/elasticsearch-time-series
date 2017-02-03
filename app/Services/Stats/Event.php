<?php 

namespace Stats;

/**
 * Event class
 * @author Roman Nehrulenko <roman@agently.io>
 */
class Event
{
    
    /**
     * Input data must be validated in the controller
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Prepare event to save
     * @return array
     */
    public function prepare()
    {
        $this->fields['session'] = @ $this->fields['session'] ?: uniqid();

        return $this->fields;
    }
    
}