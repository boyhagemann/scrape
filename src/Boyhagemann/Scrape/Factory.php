<?php namespace Boyhagemann\Scrape;

use Closure;

class Factory
{
	protected $container;
	protected $build;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}
}
