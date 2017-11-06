<?php


class ExtLibsLoaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $config;

    protected function _before()
    {
        $this->config = \Fccn\Lib\SiteConfig::getInstance();
    }

    protected function _after()
    {
    }

    // tests
    public function testGetInstance()
    {
        $loader = Fccn\WebComponents\ExtLibsLoader::getInstance();
        $this->assertFalse(empty($loader));
    }

    public function testExists()
    {
        $this->assertTrue(Fccn\WebComponents\ExtLibsLoader::getInstance()->exists('my_lib'));
    }

    public function testLoad()
    {
        $lib_js_src = Fccn\WebComponents\ExtLibsLoader::getInstance()->load('my_lib');
        $this->assertFalse(empty($lib_js_src));
        $this->assertTrue(strpos($lib_js_src, 'myFunction()') !== false);
    }

    public function testAdd()
    {
        $this->assertFalse(Fccn\WebComponents\ExtLibsLoader::getInstance()->exists('another_lib'));
        Fccn\WebComponents\ExtLibsLoader::getInstance()->add('another_lib', Fccn\Lib\SiteConfig::getInstance()->get('install_path').'/vendor/test/another_lib.js');
        $this->assertTrue(Fccn\WebComponents\ExtLibsLoader::getInstance()->exists('another_lib'));
        $lib_js_src = Fccn\WebComponents\ExtLibsLoader::getInstance()->load('another_lib');
        $this->assertTrue(strpos($lib_js_src, 'say_hello()') !== false);
    }
}
