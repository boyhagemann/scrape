<?php namespace Boyhagemann\Scrape;

use Illuminate\Support\ServiceProvider;
use Boyhagemann\Scrape\Container;

class ScrapeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{        
        $this->package('boyhagemann/scrape');
    }
    
    public function boot()
    {
		/**
		 * Create a singleton of the container to reuse all pages within
		 * the application.
		 */
		$this->app->singleton('Boyhagemann\Scrape\Container', function($app) {

			$container = new Container;
			$container->buildPage(function() use ($app) {
				return $app->make('Boyhagemann\Scrape\Page');
			});

			return $container;
		});
        
		// Create an alias for the scraper container class
		$this->app->alias('Boyhagemann\Scrape\Container', 'scraper');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('scraper');
	}

}
