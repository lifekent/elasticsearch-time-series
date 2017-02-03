<?php

namespace Stats\Storage;

/**
 * Stats storage interface
 * @author Roman Nehrulenko <roman@agently.io>
 */
interface IStorage
{
	/**
	 * Get client
	 * @return mixed
	 */
	public function getClient();
	
	/**
	 * Write data to the storage
	 * @param  string 	$event
	 * @param  array  	$timestamp 		Event timestamp
	 * @param  array  	$fields     	Event fields
	 * @return bool           
	 */
	public function insert($event, $timestamp, array $fields = []);

	/**
	 * Get total number of events
	 * @param  string 	$event 
	 * @param  integer 	$from  
	 * @param  integer 	$to    
	 * @param  array 	$filters 	Filter events by given parameters
	 * @return integer        
	 */
	public function count($event);

	/**
	 * Truncate type
	 * Available only with the "delete-by-query" plugin
	 * @param  string $type
	 * @return bool
	 */
	public function truncate($type);

	/**
	 * Get a histogram report by the given event/interval/filters
	 * @param  string 	$event 
	 * @param  string 	$interval 		 
	 * @param  integer 	$from  
	 * @param  integer 	$to    
	 * @param  array 	$filters 	Filter events by given parameters
	 * @return array        
	 */
	public function histogram($event, $interval);

}