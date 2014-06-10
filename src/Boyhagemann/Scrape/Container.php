<?php 

namespace Boyhagemann\Scrape;

use Closure, StdClass;

class Container
{
    /**
     * A collection of Pages
     *
     * @var Page[]
     */
	protected $pages = array();

	/**
	 * Models that are used for interacting with the scrape data
	 *
	 * @var StdClass[]
	 */
	protected $models = array();

    /**
     * You can define the Page object with a closure
     *
     * @var Closure 
     */
	protected $build;

	/**
	 * Set an object to use with the scraped data
	 *
	 * @param string   $name
	 * @param StdClass $model
	 */
	public function setModel($name, StdClass $model)
	{
		$this->models[$name] = $model;
	}

	/**
	 * Get the model to use with the scraped data
	 *
	 * @param $name
	 * @return StdClass
	 */
	public function getModel($name)
	{
		return $this->model[$name];
	}

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
