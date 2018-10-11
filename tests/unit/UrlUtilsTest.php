<?php

/**
* Tests the UrlUtils singleton
*/

class UrlUtilsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $config;
    private $params;
    private $url;

    protected function _before()
    {
        $this->config = \Fccn\Lib\SiteConfig::getInstance();
        $this->params = array("param1" => true, "param2" => 'textparam', "param3" => 10 );
        $this->url = "http://my.test.url/some/path";
    }

    protected function _after()
    {
    }

    // tests
    public function testGetInstance()
    {
      $instance = \Fccn\Lib\UrlUtils::getInstance();
      $this->assertNotNull($instance);
    }

    public function testCompressParams()
    {
      $instance = \Fccn\Lib\UrlUtils::getInstance();
      $this->assertNotNull($instance);
      $compressed = $instance->compressParams($this->params);
      $this->assertNotNull($compressed);
      $this->assertTrue(is_string($compressed));
      $uncompressed = $instance->decompressParams($compressed);
      $this->assertNotNull($uncompressed);
      $this->assertTrue(is_array($uncompressed));
      $this->assertTrue(sizeof($uncompressed) == sizeof($this->params));
      $this->assertTrue(isset($uncompressed['param1']));
      $this->assertTrue($uncompressed['param1'] == $this->params['param1']);
    }

    public function testBase64Encode()
    {
      $instance = \Fccn\Lib\UrlUtils::getInstance();
      $this->assertNotNull($instance);
      $encoded = $instance->base64UrlEncode($this->url);
      $this->assertNotNull($encoded);
      $this->assertTrue(is_string($encoded));
      $decoded = $instance->base64UrlDecode($encoded);
      $this->assertNotNull($decoded);
      $this->assertTrue(is_string($decoded));
      $this->assertTrue($decoded == $this->url);
    }

}
