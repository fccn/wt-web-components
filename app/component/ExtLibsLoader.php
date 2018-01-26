<?php
/*
* Singleton class to load external web resources located in vendor and node modules folders
*/

namespace Fccn\WebComponents;

class ExtLibsLoader
{
    private static $instance;
    private $libraries;

    public function __construct()
    {
        $config = \Fccn\Lib\SiteConfig::getInstance();
        //load library paths from config file
        $this->libraries = $config->get('ext_libs');
    }

    public static function getInstance()
    {
        if (!ExtLibsLoader::$instance instanceof self) {
            ExtLibsLoader::$instance = new self();
        }

        return ExtLibsLoader::$instance;
    }

    /*
    * checks if library is registered and file exists
    */
    public function exists($lib_name)
    {
        if (isset($this->libraries[$lib_name])) {
            $path = $this->libraries[$lib_name];
            \Fccn\Lib\FileLogger::debug("ExtLibsLoader::exists there is a record for library [$lib_name], located in: $path");
            return file_exists($path);
        }
        return false;
    }

    public function load($lib_name)
    {
        if ($this->exists($lib_name)) {
            return file_get_contents($this->libraries[$lib_name]);
        }
        return false;
    }

    public function add($lib_name, $path)
    {
        if (!file_exists($path)) {
            \Fccn\Lib\FileLogger::error("ExtLibsLoader::add - Could not find library - $lib_name - in path: $path");
        }
        $this->libraries[$lib_name] = $path;
    }
}
