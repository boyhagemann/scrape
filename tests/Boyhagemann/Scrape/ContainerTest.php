<?php

namespace Boyhagemann\Scrape;

use Mockery as m;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @var Container
    */
    protected $container;

    public function setUp()
    {
        $this->container = new Container;
    }
    
    public function testBuildPage()
    {
        $this->assertTrue(true);
    }

}