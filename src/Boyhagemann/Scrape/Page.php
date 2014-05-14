<?php namespace Boyhagemann\Scrape;

use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Closure;

class Page {

	protected $client;
	protected $uri;
	protected $callback;

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

	public function analyze(Closure $callback)
	{
		$this->callback = $callback;
	}

	/**
	 * @param $uri
	 */
	public function scan($uri)
	{
		$html = $this->getContents($uri);
		$this->crawler->addContent($html);

		call_user_func_array($this->callback, array($this->crawler));
	}
}
