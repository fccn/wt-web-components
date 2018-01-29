<?php


class SlimMiddlewareLoaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $config;

    protected function _before()
    {
        $this->config = \Fccn\Lib\SiteConfig::getInstance();
        $this->app = new Slim\App();
    }

    // tests
    public function testLoad()
    {
        $loader = new \Fccn\WebComponents\SlimMiddlewareLoader($this->app);
        $this->assertTrue($loader->load('my_test_middleware'));
    }
}
