<?php

namespace Stats\Storage;

use Elasticsearch\ClientBuilder;

/**
 *	ElasticSearch repository
 *	@author Roman Nehrulenko <roman@agently.io> 
 */
class ElasticSearch extends Base
{
	public function __construct($type = '')
	{
		$hosts = config('database.connections.elasticsearch.http');
		$index = config('database.connections.elasticsearch.index');

		$this->client = ClientBuilder::create()
			->setHosts(explode(';', $hosts))
			->build();

		$this->addParam('index', $index);
		$this->addParam('type', $type);
	}


	/**
	 * Insert data
	 * @param  string  $eventType
	 * @param  array   $fields   
	 * @return mixed
	 */
	public function insert($eventType, $timestamp, array $fields = [])
	{
		$timestamp = $timestamp ?: time();

		$this->addParam('time', $timestamp, 'body');
		$this->addParam('type', $eventType);
		
		foreach ($fields as $k => $v) 
		{
			$this->addParam($k, $v, 'body');
		}

		$rs = $this->client->index($this->getParams());

		return $rs['_id'];
	}

	/**
	 * Get count
	 * @param  string  	$event 		Event type / Measurement
	 * @param  integer 	$from 		Period from in miliseconds  
	 * @param  integer 	$to    		Period to in miliseconds
	 * @param  array 	$filters    
	 * @return integer         
	 */
	public function count($event): int
	{
		$this->addParam('type', $event);

		$this->refresh();

		$this->params['body'] = [];
		$this->params['body']['size'] = 0;
		
		if ($this->from)
		{
			$this->params['body']['query']['bool']['must'][]['range']['time']['from'] = $this->from;
		}

		if ($this->to)
		{
			$this->params['body']['query']['bool']['must'][]['range']['time']['to'] = $this->to;
		}

		if ($this->filters)
		{
			foreach ($this->filters as $field => $value) 
			{
				$this->params['body']['query']['bool']['must'][] = ['term' => [$field => $value]];
			}
		}

		$result = $this->getClient()->count($this->getParams());

    	return (int)$result['count'];
	}


	/**
	 * Get histogram by the given interval
	 * @param  string  $event 		Event type / Measurement
	 * @param  string  $interval    Available expressions for interval: year, quarter, month, week, day, hour, minute, second 
     * Check https://www.elastic.co/guide/en/elasticsearch/reference/current/common-options.html#time-units for extra intervals
	 * @return integer         
	 */
	public function histogram($event, $interval): array
	{
    	$this->addParam('type', $event);

    	$this->refresh();
		
		$this->params['body'] = [];
		$this->params['body']['size'] = 0;
		
		if ($this->from)
		{
			$this->params['body']['query']['bool']['must'][]['range']['time']['from'] = $this->from;
		}

		if ($this->to)
		{
			$this->params['body']['query']['bool']['must'][]['range']['time']['to'] = $this->to;
		}

		if ($this->filters)
		{
			foreach ($this->filters as $field => $value) 
			{
				$this->params['body']['query']['bool']['must'][] = ['term' => [$field => $value]];
			}
		}

		$this->params['body']['aggs'][$interval]['date_histogram'] = ['field' => 'time', 'interval' => $interval];

		$result = $this->getClient()->search($this->getParams());

		if (empty($result['aggregations'][$interval]['buckets']))
		{
			return [];
		}

		return $result['aggregations'][$interval]['buckets'];
	}

	/**
	 * Refresh index
	 * @return
	 */
	public function refresh()
	{
		$this->getClient()
			->indices()
			->refresh([
				'index' => $this->getParams()['index']
			]);
	}

	/**
	 * Truncate index type
	 * @param  string $type
	 * @return bool      
	 */
	public function truncate($type)
	{
		$this->addParam('type', $type);

		$this->params['body']['query']['match_all'] = [];

		$res = $this->getClient()->deleteByQuery($this->getParams());

		$this->refresh();

		return $res;	
	}


}
