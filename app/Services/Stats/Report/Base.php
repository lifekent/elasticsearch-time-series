<?php

namespace Stats\Report;

/**
 * Base stats report class
 * @author Roman N. <roman@agently.io>
 */
abstract class Base
{
	public $from, $to, $filters;

	protected $storage;

	public function __construct()
	{
		$this->storage = \Stats\Storage\Factory::make();
	}

	/**
	 * Period from
	 * @param  integer $from
	 * @return void
	 */
	public function from($from)
	{
		$this->storage->from = $from;
	}

	/**
	 * Period to
	 * @param  integer $to
	 * @return void
	 */
	public function to($to)
	{
		$this->storage->to = $to;
	}


	/**
	 * Events filters
	 * @param  array $filters
	 * @return void
	 */
	public function filter($filters)
	{
		$this->storage->filters = $filters;
	}

}