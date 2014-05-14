<?php namespace Boyhagemann\Scrape;

use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Closure;

class Page {

    /**
     *
     * @var Client 
     */
	protected $client;
    
    /**
     *
     * @var string 
     */
	protected $uri;
    
    /**
     *
     * @var Closure 
     */
	protected $callback;

    /**
     * 
     * @param Client $client
     * @param Crawler $crawler
     */
	public function __construct(Client $client, Crawler $crawler)
	{
		$this->client = $client;
		$this->crawler = $crawler;
	}

	/**
	 * @param $uri
	 * @return \Guzzle\Http\EntityBodyInterface|string
	 */
	public function getContents($uri)
	{
		$request = $this->client->get($uri);
		$response = $this->client->send($request);
		return $response->getBody(true);
	}

    /**
     * The code inside the closure is used after the
     * page is scanned. You have a Crawler instance
     * at your disposal with the DOM of the page.
     * 
     * @param Closure $callback
     */
	public function analyze(Closure $callback)
	{
		$this->callback = $callback;
	}

	/**
     * Scan the page with the given uri
     * 
	 * @param $uri
	 */
	public function scan($uri)
	{
		$html = $this->getContents($uri);
		$this->crawler->addContent($html);

		call_user_func_array($this->callback, array($this->crawler));
	}
}
