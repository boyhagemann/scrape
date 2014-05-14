<?php namespace Boyhagemann\Scrape;

use Closure;

class Container
{
	protected $pages = array();

	protected $build;

	public function buildPage($callback)
	{
		$this->build = $callback;
	}

	/**
	 * @param         $name
	 * @param Closure $callback
	 * @return mixed
	 */
	public function addPage($name, Closure $callback)
	{
		$page = call_user_func($this->build);
		$page->analyze($callback);

		$this->pages[$name] = $page;

		return $page;
	}

	/**
	 * @param $name
	 * @return Page
	 */
	public function getPage($name)
	{
		return $this->pages[$name];
	}
}
