## Scrape

With this Laravel 4 package you can:
- scrape any contents from a page
- follow specific link paths to get to that content
- use closures for optimum usability

### How to install

Use Composer to install with all the dependencies:
`composer require boyhagemann/scrape *`

Then you add the ServiceProvider to the application config:
`'Boyhagemann\Scrape\ScrapeServiceProvider'`

You can optionally add the alias:
`'Scrape' => 'Boyhagemann\Scrape\Facade\Container'`

## How to use
Scrape uses two components for scraping pages:

#### Container
The container is the single class you will use in most cases.
It registers a name and a closure with information how to scrape the page.

#### Page
A page is a template that is used for many urls. 
An example would be a news item page. 
It can have many urls, but it has one page template.
With Scrape you can define how to deal with the content on that page.

### Add pages
The first thing you want to do is to add a page to the container.

```php
// Using the Laravel Facade
Scraper::add('my-first-page', function() {

    // Start scraping...

});

// Without the Facade
$container = App::make('Boyhagemann\Scrape\Container');
$container->add('my-second-page', function($crawler) {

    // Your magic scraping starts here...

});
```

### Scrape a url
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
