<?php 

namespace Boyhagemann\Scrape;

use Closure;

class Container
{
    /**
     * A collection of Pages
     *
     * @var Page[]
     */
	protected $pages = array();

    /**
     * You can define the Page object with a closure
     *
     * @var Closure 
     */
	protected $build;

    /**
     * Define how the Page object is setup
     * 
     * @param Closure $callback
     */
	public function buildPage(Closure $callback)
	{
		$this->build = $callback;
	}

	/**
     * Add a page to the container
     * 
	 * @param string  $name
	 * @param Closure $callback
	 * @return Page
	 */
	public function add($name, Closure $callback)
	{
		$page = call_user_func($this->build);
		$page->analyze($callback);

		$this->pages[$name] = $page;

		return $page;
	}

	/**
     * Get a page from the container
     * 
	 * @param $name
	 * @return Page
	 */
	public function get($name)
	{
		return $this->pages[$name];
	}
    
    /**
     * Get a page from the container and start scraping
     * 
     * @param string $name
     * @param string $uri
     */
    public function scrape($name, $uri)
    {        
		$this->get($name)->scan($uri);
    }

}
