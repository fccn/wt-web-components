<?php
/*
* Slim invokable controller to load external javascript files given a library name
* Requires Slim container to have an ExtLibsLoader service
*/

namespace Fccn\WebComponents;

use Psr\Container\ContainerInterface;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Fccn\Lib\SiteConfig as SiteConfig;
use Fccn\Lib\FileLogger as FileLogger;
use Fccn\Lib\Locale as Locale;

class LoadExternalJsAction
{
    protected $container;
    protected $verbose_debug;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->verbose_debug = SiteConfig::getInstance()->get("verbose_debug", false);
        if($this->verbose_debug){
          FileLogger::debug("LoadExternalJsAction - initialization");
        }
    }

    #loads javascript given a name
    public function __invoke(Request $request, Response $response, $args)
    {
        if($this->verbose_debug){
          FileLogger::debug("LoadExternalJsAction - call to invoke with args: ".json_encode($args));
        }
        $loader_srv_name = \Fccn\Lib\SiteConfig::getInstance()->get('ext_libs_loader_service_name');
        if (empty($this->container[$loader_srv_name])) {
            \Fccn\Lib\FileLogger::error("GET script/lib - no loader service found");
            //send not found
            return $response->withStatus(404);
        }
        $contents = $this->container[$loader_srv_name]->load($args['libname']);
        $new_resp = $response->withHeader('Content-type', 'application/javascript');
        $body = $new_resp->getBody();
        if (!empty($contents)) {
            #$this->logger->debug("GET script/lib - writing contents to response body");
            $body->write($contents);
        } else {
            \Fccn\Lib\FileLogger::error("GET script/lib - library <$args[libname]> not found");
            //send not found
            return $new_resp->withStatus(404);
        }
        return $new_resp;
    }
}
