## Scrape

With this awesome Laravel 4 package you can:
- scrape any contents from a page
- follow specific link paths to get to that content
- use closures for optimum usability

### How to install

Use Composer to install with all the dependencies:
`composer require boyhagemann/scrape *`

Then you add the ServiceProvider to the application config:
```php
'Boyhagemann\Scrape\ScrapeServiceProvider'
``` 

You can optionally add the alias:
```php
'Scraper' => 'Boyhagemann\Scrape\Facades\Container'
```

## How does it work?
Scrape uses two components for scraping pages:

##### Container
The container is the single class you will use in most cases.
It registers a name and a closure with information how to scrape the page.

##### Page
A page is a template that is used for many urls. 
An example would be a news item page. 
It can have many urls, but it has one page template.
With Scrape you can define how to deal with the content on that page.

### Add pages
The first thing you want to do is to add a page to the container.

```php
Scraper::add('my-first-page', function() {

    // Start scraping...

});
```

If you don't use the facade, you can do something like this:

```php
$container = App::make('Boyhagemann\Scrape\Container');
$container->add('my-second-page', function($crawler) {

    // Your magic scraping starts here...

});
```

## Now start scraping!
After you defined all pages, you are ready to scrape some content!
This is done very easily, like this:

```php
Scraper::scrape('my-first-page', 'http://theurl.toscrape.com');
```

### How the use the Crawler
Scrape uses the Symfony DomCrawler component to crawl the html from a url.
You can check out there documention for full details.
In order to use autocomplete in your IDE, it is useful to type hint the $crawler variable:

```php
use Symfony\Component\DomCrawler\Crawler;

Scraper::add('page-name', function(Crawler $crawler) {
    
    // You have autocompletion on the $crawler instance...

});
```

## Crawling strategies
Most of the time, you don't know exactly all urls to the desired content. 
If you have thousands of urls to crawl, it is impossible to manage this manually.
You can use Scrape to follow links to get to the desired content.

### Chain pages together
You can have crawl multiple pages after each other with great ease:

```php

// Add a page that has links to your content
Scraper::add('page-1', function($crawler) {

    $crawler->filter('.your-link')->each(function($node) {
        Scraper::scrape('page-2', $node->attr('href'));
    });
});

// Add the page with all the content
Scraper::add('page-2', function($crawler) {

    $crawler->filter('.your-content')->each(function($node) {
        
        // Get the content and do a little dance!
        
    });
});
```
### No more time outs!
Chained processes can consume lots of time and resources, so don't go mental on chaining everything.
You can use the Laravel Queue or a database in conjunction with cron jobs to manage all page crawls.
This will save you from the nasty requrest time outs!


```php
Scraper::add('page-1', function($crawler) {

    $crawler->filter('.link')->each(function($node) {
    
        // Put the next crawl on a queue
        Queue::push(function($job) use ($node) {
            
            // Scrape this page!
            Scraper::scrape('page-2', $node->attr('href'));
        
            // Delete the queue job once finished
            $job->delete();
        });
    
    });

});
```
