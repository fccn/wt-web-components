<?php

/**
* Singleton class with a collection of utilities for compressing urls and web content
*/

namespace Fccn\Lib;

use Fccn\Lib\SiteConfig as SiteConfig;
use Fccn\Lib\FileLogger;

class UrlUtils
{
    private static $instance;


    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*
    * Initializes the Compression utilities
    */
    public function __construct()
    {
    }

    /**
    * compresses an array of parameters into a single token for page load requests
    * @param Array $params an associative array of parameters in the form 'param_name' => 'param_value'
    * @return String a token representation of the parameters
    */
    public function compressParams($params){
      return $this->base64UrlEncode(gzcompress(json_encode($params,JSON_UNESCAPED_UNICODE),9));
    }


    /**
    * decompresses a previously compressed array of parameters back into an array of parameters
    * @param String $token the token to decompress
    */
    public function decompressParams($token){
      return json_decode(gzuncompress($this->base64UrlDecode($token)),true);
    }


    /**
    * Encodes a string in base64 URL safe
    * @param String $string the string to encode
    * @return String the base64 encoded string
    */
    public function base64UrlEncode($string) {
      $data = base64_encode($string);
      $data = str_replace(array('+','/','='),array('-','_',''),$data);
      return $data;
    }

    /**
    * Decodes a base64 string
    * @param string $string the base64 string to decode
    * @return string the decoded string
    */
    public function base64UrlDecode($string) {
      $data = str_replace(array('-','_'),array('+','/'),$string);
      $mod4 = strlen($data) % 4;
      if ($mod4) {
          $data .= substr('====', $mod4);
      }
      return base64_decode($data);
    }

    /**
    * Encodes a string to UTF-8 if not already in UTF-8
    * @param String $str the string to encode
    */
    public function toUtf8($str){
    	if(!mb_detect_encoding($str, 'UTF-8', true)){
    		$str = utf8_encode($str);
    	}
    	return $str;
    }

  }
