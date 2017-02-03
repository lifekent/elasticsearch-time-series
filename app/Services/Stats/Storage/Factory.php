<?php

namespace Stats\Storage;

/**
* Stats storage factory
* @author Roman Nehrulenko <roman@agently.io>
*/
class Factory
{
	/**
     * Return storage instance
     * @param  string $type                     Elasticsearch type
     * @return \Stats\Storage\ElasticSearch
     */
	public static function make($type = '')
	{
		return new \Stats\Storage\ElasticSearch($type);
	}
	
}