<?php
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

/*
* Container to use on tests
*/

$container = new Container([
    App::class => function (ContainerInterface $c) {
        $app = new App($c);

        //setup slim logs with file logger
        $c['logger'] = function ($cnt) {
            $logger = \Fccn\Lib\FileLogger::getInstance();
            $logger->pushProcessor(new Monolog\Processor\UidProcessor());
            $logger->pushHandler(new Monolog\Handler\StreamHandler(\Fccn\Lib\SiteConfig::getInstance()->get('logfile_path'), \Fccn\Lib\SiteConfig::getInstance()->get('logfile_level')));
            return $logger;
        };

        //setup ext libs loader
        $cnt_name = \Fccn\Lib\SiteConfig::getInstance()->get('ext_libs_loader_service_name');
        $c[$cnt_name] = function ($cnt) {
            $loader = \Fccn\WebComponents\ExtLibsLoader::getInstance();
            return $loader;
        };

        // routes and middlewares here

        #load library action
        $app->get('/script/lib/{libname}', Fccn\WebComponents\LoadExternalJsAction::class)->setName('ext_libs');

        return $app;
    }
]);

return $container;
