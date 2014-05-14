<?php namespace Boyhagemann\Scrape;


class Scanner {

	protected $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

}
