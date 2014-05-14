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

