<?php

namespace Stats\Storage;

/**
 * Base storage class
 * @author Roman Nehrulenko <roman@agently.io>
 */
abstract class Base implements IStorage
{
    public $from, $to, $filters;

    protected $client;

    /**
     * Query parameters
     * @var array
     */
    protected $params;

	/**
	 * Get the client instance
	 * @return mixed
	 */
	public function getClient()
	{
		return $this->client;
	}

    /**
     * Add query parameter
     * @param string    $field
     * @param mixed     $value
     */
    protected function addParam($field, $value, $nested = '')
    {
        if ($nested)
        {
            $this->params[$nested][$field] = $value;
        }
        else
        {
            $this->params[$field] = $value;
        }
    }

    /**
     * Get query parameters
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }
}