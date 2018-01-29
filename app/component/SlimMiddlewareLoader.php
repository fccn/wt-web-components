<?php
/*
* Helper class to load middlewares on your Slim3 application.
* The middlewares to load can be defined in the configuration file using the
* slim_middlewares property.
*/

namespace Fccn\WebComponents;

class SlimMiddlewareLoader
{
    private $middlewares;
    private $app;

    public function __construct($app)
    {
        $config = \Fccn\Lib\SiteConfig::getInstance();
        //load middleware classes from config file
        $this->middlewares = $config->get('slim_middlewares');
        $this->app = $app;
    }

    /*
    * loads a specific middleware in the application
    */
    public function load($middleware_name)
    {
        if (isset($this->middlewares[$middleware_name])) {
            $middleware = $this->middlewares[$middleware_name];
            if (!empty($middleware)) {
                $this->app->add($middleware);
                return true;
            }
            \Fccn\Lib\FileLogger::debug("SlimMiddlewareLoader::load middleware [$middleware_name] is not valid");
        } else {
            \Fccn\Lib\FileLogger::debug("SlimMiddlewareLoader::load there is no record for middleware [$middleware_name]");
        }
        return false;
    }

    /*
    * loads all middlewares preset in the configuration file
    */
    public function loadAll()
    {
        foreach ($this->middlewares as $name => $middleware) {
            $this->load($name);
        }
    }
}
